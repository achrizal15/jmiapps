<?php

namespace App\Http\Controllers\Admin;

use App\Models\Finance;
use App\Models\Payment;

use App\Models\Installation;
use Illuminate\Http\Request;
use App\Exports\PaymentExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class PaymentController extends Controller
{
    public function index()
    {
        $payment =  Payment::latest();
        return view("admin.payment.index", [
            "title" => "Payment",
            "payments" => $payment->with(['member', "installations.package"])->filters(request(['date', 'search']))
                ->paginate(10)->withQueryString()
        ]);
    }

    public function update(Request $request, Payment $payment)
    {
        $status = $request->status;
        $member_id = $payment->member_id;
        $payment = $payment->load(["installations.package","member"]);
        $payment->update(["status" => $status]);
        if ($status == "rejected") {
            return redirect()->back()->with("error", "Pembayaran telah " . $status . " silahkan kirim pesan ke member untuk memberi informasi!");
        }
        $ins = Installation::where("user_id", "=", $member_id)->first();
        $ins->update(["expired" => date("Y-m-d", strtotime("+1 month now")), "status" => "installed"]);
        Finance::create([
            'type' => 'pemasukan',
            'category' => 'Pembayaran bulanan',
            'detail' => "Pembayaran bulanan oleh " . $payment->member->name. " pada tanggal ". $payment->created_at,
            'balance' => $payment->installations->package->price
        ]);
        return redirect()->back()->with("success", "Pembayaran telah " . $status . " silahkan cek kembali!");
    }
    public function destroy(Payment $payment)
    {
        $payment->delete();
    }
    public function export()
    {
        return  Excel::download(new PaymentExport(request("date")), "PEMBAYARAN-" . request("date") . ".xlsx");
    }
}
