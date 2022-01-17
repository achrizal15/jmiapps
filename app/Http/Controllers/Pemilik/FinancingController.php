<?php

namespace App\Http\Controllers\Pemilik;

use App\Exports\ExpenditureExport;
use App\Models\Finance;
use App\Models\Inventory;
use App\Models\Expenditure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class FinancingController extends Controller
{
    public function index()
    {
        return view(
            'pemilik.financing.index',
            [
                'title' => "Financing",
                'items' => Expenditure::orderBy('status', 'desc')
                    ->filter(request(['search', 'date']))
                    ->paginate(10)
                    ->withQueryString()
            ]
        );
    }
    public function update(Request $request, Expenditure $expenditure)
    {
        $expenditure->update(['status' => $request->status]);
        if ($request->status == 'accept') {
            Finance::create([
                'type' => 'pengeluaran',
                'category' => 'Pembelanjaan inventory',
                'detail' => "Pembelian " . $expenditure->name_product . " di " . $expenditure->name_suplier . " jumlah stock " . $expenditure->stock,
                'balance' => $expenditure->balance
            ]);
            Inventory::create([
                "name" => $expenditure->name_product,
                "status" => "ready",
                "stock" => $expenditure->stock,
                "price" => $expenditure->price
            ]);
        }
        // $expendit->update($status);
        return redirect("pemilik/agreement")->with("success","Permintaan diterima!");
    }
    public function export(){
        return Excel::download(new ExpenditureExport(request("date")),"PEMBELIAN-".request("date").".xlsx");
    }
}
