<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Report;
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
        $notif = Report::latest()->where("member_id", '=', auth()->user()->id)->where("message","!=",null);
        return view('pelanggan.information.index', ['title' => "Information", "notif" => $notif->get()]);
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
        $report = new Report;
        $idMember = auth()->user()->id;
        $validate = $request->validate([
            "constraint" => "required",
            "detail" => "required|min:5"
        ], ["detail.required" => "Tidak boleh kosong!"]);
        $validate['member_id'] =  $idMember;
        if (count($report->where("member_id", $idMember)->whereDay("created_at", "=", date('d'))->get())) {
            return redirect("/pelanggan/information")->with("error", "Anda hanya dapat mengirim laporan 1x per hari ini!");
        }
        $report->create($validate);
        return redirect("/pelanggan/information")->with("success", "Laporan anda berhasil dikirim, saat ini sedang menunggu admin memeriksa!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        Report::where("member_id",'=',$report->member_id)->delete();
      return redirect()->back();
    }
}
