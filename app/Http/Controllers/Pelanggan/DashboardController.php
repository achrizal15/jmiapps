<?php

namespace App\Http\Controllers\Pelanggan;

use App\Models\Report;
use App\Models\Package;
use App\Models\Installation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = auth()->user();
        $package = Package::latest()->get();
        $msg = Message::latest()->where("user_id", $users->id)->get();
        $pelanggan = implode(array_slice(explode(" ", $users->name), 0, 1));
        $hasPackage = false;
        if (count(Installation::where('user_id', $users->id)->get()) != 0) {
            $hasPackage = true;
        }
        return view("pelanggan.index", [
            'title' => "Dashboard",
            "packages" => $package,
            "message" => $msg,
            "pelanggan" => $pelanggan,
            "hasPackage" => $hasPackage
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $package = Package::find($request->package_id);
        $member = auth()->user();
        Installation::create([
            "package_id" => $package->id,
            "user_id" => $member->id,
            "status" => "request"
        ]);
        return redirect("/pelanggan")->with("success", "Terimakasih " . $member->name . " permintaan anda akan segera di proses!");
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
    public function report(Request $request)
    {
        $report = new Report;
        $idMember = auth()->user()->id;
        $validate = $request->validate([
            "constraint" => "required",
            "detail" => "required|min:5"
        ], ["detail.required" => "Tidak boleh kosong!"]);
        $validate['member_id'] =  $idMember;
        if (count($report->where("member_id", $idMember)->whereDay("created_at", "=", date('d'))->get())) {
            return redirect("/pelanggan")->with("error", "Anda hanya dapat mengirim laporan 1x per hari ini!");
        }
        $report->create($validate);
        return redirect("/pelanggan")->with("success", "Laporan anda berhasil dikirim, saat ini sedang menunggu admin memeriksa!");
    }
    public function report_destroy(User $user){
        Message::where("user_id",$user->id)->delete();
        return redirect("/pelanggan")->with("success", "Semua notifikasi telah dihapus!");
    }
}
