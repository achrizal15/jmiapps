<?php

namespace App\Http\Controllers\Pelanggan;

use App\Models\Report;
use App\Models\Message;
use App\Models\Payment;
use App\Models\Installation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transfer = Payment::latest()->where("member_id", auth()->user()->id);
        $msg = Message::latest()->where("user_id", auth()->user()->id)->get();
        $install =  Installation::with(['package'])
            ->where("user_id", auth()->user()->id)
            ->where("status", "installed");
        $myPackage = [
            "package_name" => "Anda belum memiliki paket",
            "tagihan" => 0
        ];
        if ($install->first() != null) {
            if ($install->first()->expired <= date("Y-m-d")&&$install->first()->expired!=null) {
                $myPackage = [
                    "package_name" => $install->first()->package->name,
                    "tagihan" => $install->first()->package->price
                ];
            } else {
                $myPackage["package_name"] =  $install->first()->package->name;
            }
        }

        return view("pelanggan.payment.index", [
            'title' => "Payment",
            "myPackage" => $myPackage,
            "message"=>$msg,
            "transfer" => $transfer
                ->with("installations.package")
                ->paginate(10)
                ->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            "transfer_img" => "required|image|file|max:1024"
        ]);
        $user_id = auth()->user()->id;
        $validate['member_id'] = $user_id;
        $installation_id = Installation::where("user_id", $user_id)->get();
        $validate['transfer_img'] = $request->file("transfer_img")->store("transfer-images");
        if (!count($installation_id)) {
            return redirect("/pelanggan/payment")->with("error", "Anda belum memiliki paket saat ini untuk dibayarkan!");
        }
        if ($request->tagihan < 1) {
            return redirect("/pelanggan/payment")->with("error", "Belum ada tagihan untuk bulan ini!");
        }
        $validate['installation_id'] = $installation_id[0]->id;
        Payment::create($validate);
        return redirect("/pelanggan/payment")->with("success", "Pembayaran bulanan anda sedang di proses admin silahkan tunggu!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
