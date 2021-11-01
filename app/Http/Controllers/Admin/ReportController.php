<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Payment;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::latest()->with(['member', "technician"])
            ->filter(request(["date", "search"]))->paginate(25)->withQueryString();
        return  view("admin.report.index", ["title" => "Report", "reports" => $reports]);
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
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        $teknisi = $request->technician_id;
        $msg = $request->message;
        $dataReport["status"] = "success";
        $alert = "Report has been received!";
        if ($teknisi) {
            $dataReport["technician_id"] = $teknisi;
            $dataReport["status"] = "process";
            $alert = "The report will be processed by the technician!";
        }
        if ($msg) {
            Message::create([
                "name" => $msg,
                "type" => "notification",
                "user_id" => $report->member_id
            ]);
            $alert .= " dan pesan telah dikirim!";
        }
        $report->update($dataReport);
        return  redirect("/admin/report")->with("success", $alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        $report->delete();
        return redirect("/admin/report")->with("success", "Report successfully deleted!");
    }
}
