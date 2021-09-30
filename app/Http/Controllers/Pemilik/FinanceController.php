<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Finance;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
        $items = new  Finance;
        return view('pemilik.finance/index', ['title' => 'Keuangan', "items" => $items->latest()->paginate(10)->withQueryString()]);
    }
}
