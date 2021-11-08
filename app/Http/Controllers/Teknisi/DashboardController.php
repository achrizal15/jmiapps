<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use App\Models\Installation;
use App\Models\Inventory;
use DateTime;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technician_id = auth()->user()->id;
        return view("teknisi.index", [
            "title" => "Dashboard",
            "teknisi" => auth()->user()->name,
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
        //
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
    public function edit(Installation $teknisi)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Installation $teknisi)
    {

        $validate = $request->validate([
            "username" => "required",
            "installation_costs" => "required",
            "discount" => "nullable",
            "number_modem" => "required",
            "port" => "required",
        ]);
        $validate['status'] = "installed";
        $validate['expired'] = date("Y-m-d",strtotime("+1 month"));
        if (isset($request->inventory)) {
            $nameInven = [];
            $inventory = [];
            foreach ($request->inventory as $i) {
                $nameInven[] = preg_replace(['/[0-9]+/', '/[^A-Za-z0-9]/'], "", $i['name']);
                $inventory[preg_replace('/[^0-9]/', '', $i['name'])] = preg_replace('/[^0-9]/', '', $i['stock']);
            }
            $stock = collect($inventory)->map(function ($stock) {
                return ['stock' => $stock];
            });
            $idInventory = (array_keys($inventory));
            $checkAvaible = Inventory::whereIn("name", $nameInven)->whereIn('id', $idInventory)->where("stock", ">", 0);
            if (!count($checkAvaible->get()) || count(array_keys($inventory)) != count($checkAvaible->get())) {
                return redirect('/teknisi')->with("error", "Product tidak ditemukan atau salah satu product habis, cek inventory anda!");
            }
            $ix = 0;
            foreach ($stock as $key) {
                $produck = Inventory::find($idInventory[$ix]);
                $newStock = $produck->stock - $key['stock'];
                if ($newStock < 0) {
                    return "Stok ada yang kosong";
                } else {
                    $produck->update(["stock" => $newStock]);
                }
                $ix++;
            }
            $teknisi->update($validate);
            $teknisi->inventorys()->sync($stock);
            return redirect('/teknisi')->with("success", "Berhasil dipasang dengan memakai inventory, cek inventory anda!");
        }
        $teknisi->update($validate);
        return redirect('/teknisi')->with("success", "Berhasil dipasang!");
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
    public function selectquery()
    {
        return Inventory::get();
    }
}
