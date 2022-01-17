<?php

namespace App\Http\Controllers\Pemilik;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Exports\PaymentExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class PembayaranController extends Controller
{
    public function index(){
        $payment = Payment::latest();
        return view("pemilik.payment.index", [
            "title" => "Payment",
            "payments" => $payment->with(['member', "installations.package"])->filters(request(['date', 'search']))
                ->paginate(10)->withQueryString()
        ]);
    }
    public function export()
    {
        return  Excel::download(new PaymentExport(request("date")), "PEMBAYARAN-" . request("date") . ".xlsx");
    }
}
