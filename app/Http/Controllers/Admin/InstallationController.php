<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blok;
use App\Models\Installation;
use App\Models\Inventory;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;

class InstallationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $psb = Installation::latest();
        $blok = Blok::latest()->get();
        return view('admin.installation.index', [
            'title' => "Pasang Baru",
            "blok" => $blok,
            "collection" => $psb->with(['user', 'package', 'technician', "bloks.collectors"])
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
        $package = Package::latest()->get();
        return view('admin.installation.create', ['title' => "Installation", "packages" => $package]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => "required",
            "package_id" => "required",
            "detail" => "nullable",
            "inventory" => "required"
        ]);
        $idInven = [];
        $nameInven = [];
        $stockInven = [];
        $memberName = preg_replace('/[^0-9]/', '', $request->user_id);
        foreach ($request->inventory as $i) {
            $idInven[] = preg_replace('/[^0-9]/', '', $i['name']);
            $nameInven[] = preg_replace(['/[0-9]+/', '/[^A-Za-z0-9]/'], "", $i['name']);
            $stockInven[] =  preg_replace('/[^0-9]/', '', $i['stock']);
        }
        $checkAvaible = Inventory::whereIn("name", $nameInven)->whereIn('id', $idInven);
        if (!count($checkAvaible->get()) || count($idInven) != count($checkAvaible->get())) {
            return redirect('/admin/installation/create')->with("error", "Product tidak ditemukan, cek inventory anda!");
        }

        $stok =  Installation::create([
            "package_id" => $request->package_id,
            "user_id" => $memberName,
            "detail" => $request->detail,
            "status" => "accept"
        ]);
        $stok->inventorys()->attach($idInven);
    }
    public function pause(Installation $installation)
    {
        $type = request()->type;
        $status = "paused";
        $time = null;
        $message = "Pelanggan telah ditetapkan untuk berhenti sementara tagihan tidak akan masuk!";
        if ($type == "continue") {
            $status = "installed";
            $time = date("Y-m-d", strtotime("+1 month", strtotime("now")));
            $message = "Langganan telah dilanjutkan tagihan akan muncul bulan berikutnya!";
        }
        $installation->update(["expired" => $time, "status" => $status]);
        return redirect('/admin/installation')->with("success", $message);
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
    public function update(Request $request, Installation $installation)
    {
        $request->validate(["blok" => "required"]);
        $technician = preg_replace('/[^0-9]/', '', $request->name);
        $technician_id = User::where("phone", $technician)->get();
        if (!count($technician_id)) {
            return redirect('/admin/installation')->with("error", "Gagal teknisi tidak ditemukan silahkan cek kembali!");
        }

        $update = [
            "technician_id" => $technician_id[0]->id,
            "status" => "process",
            "blok_id" => $request->blok
        ];
        $installation->update($update);
        return redirect('/admin/installation')->with("success", "Permintaan berhasil di proses!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Installation $installation)
    {
        $installation->delete();
       return redirect("/admin/installation")->with("success","Telah terhapus selamanya!");
    }
    public function selectJquery()
    {
        if (isset(request()->search) ? request(['search']) : false) {
            $user = User::where("role_id", request('search'));
            return $user->get();
        }
        if (isset(request()->inventory) ? request(['inventory']) : false) {
            $inv = Inventory::latest();
            return $inv->get();
        }
    }
}