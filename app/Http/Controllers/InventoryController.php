<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $collection = Inventory::all();
        return view('admin.inventory.barang', ['title' => "Inventory", "collection" => $collection]);
    }
    public function store(Request $request)
    {
        $validate = $request->validate(["name" => "required", "qty" => "required", "harga" => "required"]);
        $validate["status"] = "ready";
        $pengeluaran = $validate['qty'] * $validate['harga'];
        Inventory::create($validate);
        Finance::create([
            "jenis" => "pengeluaran", "category" => "Inventory", "detail" => "Melakukan pembelian barang " . $validate['name'], "saldo" => $pengeluaran
        ]);
        return redirect("/admin/barang")->with('success', "Data berhasil di input, saldo keluar $pengeluaran masuk ke table keuangan!");
    }
    public function destroy(Inventory $inventory)
    {
        Inventory::find($inventory->id)->delete();
        // or
        // Inventory::destroy($inventory->id);
        return redirect('/admin/barang')->with('success', "Barang berhasil dihapus!");
    }
    public function edit(Inventory $inventory)
    {
        return $inventory->id;
    }
}
