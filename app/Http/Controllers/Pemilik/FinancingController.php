<?php

namespace App\Http\Controllers\Pemilik;

use App\Models\Finance;
use App\Models\Inventory;
use App\Models\Expenditure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FinancingController extends Controller
{
    public function index()
    {
        return view(
            'pemilik.financing.index',
            [
                'title' => "Financing",
                'items' => Expenditure::latest()
                    ->filter(request(['search', 'date']))
                    ->where('status', 'pending')
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
        return $request->status;
    }
}

