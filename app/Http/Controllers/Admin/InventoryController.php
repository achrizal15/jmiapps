<?php

namespace App\Http\Controllers\Admin;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    public function index()
    {
        $collection = new Inventory;
        return view('admin.inventory.index', [
            'title' => "Inventory",
            "collection" => $collection->latest()->filter(request(['date', 'search']))->paginate(10)->withQueryString()
        ]);
    }
    public function store(Request $request)
    {
        $validate = $request->validate(["name" => "required", "stock" => "required", "price" => "required"]);
        $validate["status"] = $request->status;
        Inventory::create($validate);
        return redirect("/admin/product")->with('success', "Data berhasil di input, lakukan pembelanjaan jika stock habis!");
    }
    public function edit(Inventory $inventory)
    {

        return  $inventory->find(request('id'));
    }
    public function update(Request $request, Inventory $inventory)
    {
        $validate = $request->validate([
            "name" => 'required',
            "price" => 'required',
            "stock" => "required",
            "status" => "required"
        ]);
        $inventory->update($validate);
        return redirect("/admin/product")->with('success', "Data berhasil diupdate, lakukan pembelanjaan jika stock habis!");
    }
    public function destroy(Inventory $product)
    {
        Inventory::find($product->id)->delete();
        // or
        // Inventory::destroy($inventory->id);
        return redirect('/admin/product')->with('success', "Barang berhasil dihapus!");
    }
}
