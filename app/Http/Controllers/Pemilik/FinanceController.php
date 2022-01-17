<?php

namespace App\Http\Controllers\Pemilik;

use App\Exports\KeuanganExport;
use App\Models\Finance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class FinanceController extends Controller
{
    public function index()
    {
        $items = new  Finance;
        return view('pemilik.finance.index', ['title' => 'KEUANGAN', "items" => $items->latest()->filter(request(['search', 'date']))->paginate(10)->withQueryString()]);
    }
    public function export()
    {
                return Excel::download(new KeuanganExport(request("date")), "KEUANGAN.xlsx");
    }
}
