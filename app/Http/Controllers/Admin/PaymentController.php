<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Installation;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payment =  Payment::latest();
        return view("admin.payment.index", ["title" => "index", "payments" => $payment->with(['member', "installations.package"])->paginate(25)->withQueryString()]);
    }
    public function update(Request $request, Payment $payment)
    {
        $status=$request->status;
        $member_id=$payment->member_id;
        $payment->update(["status"=>$status]);
        if($status=="rejected"){
            return redirect()->back()->with("error", "Pembayaran telah ".$status." silahkan kirim pesan ke member untuk memberi informasi!");
        }
        $ins=Installation::where("user_id","=",$member_id);
        $ins->first()->update(["expired"=>date("Y-m-d",strtotime("+1 month",strtotime($ins->first()->expired)))]);
        return redirect()->back()->with("success", "Pembayaran telah ".$status." silahkan cek kembali!");
    }
}
