<?php

namespace App\Http\Controllers\Teknisi;

use App\Models\Report;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inventory;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $report = Report::latest()->where("technician_id", auth()->user()->id)->with(["member", "technician"])->get();
        return view("teknisi.report.index", ["title" => "Report", "reports" => $report]);
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
    public function edit(Report $report)
    {
        $inventories = Inventory::latest()->where("status", "ready")->where("stock", ">", 0)->get();
        if ($report->status != "process") {
            abort(403, "Data yang anda minta sudah selesai diperbaiki...");
        }
        return view("teknisi.report.repair", [
            "title" => "Repair",
            "inventories" => $inventories,
            "report" => $report->load(["member", "technician"])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        $type = strtolower($request->type);
        if ($type == "no_inventory") {
            $report->update(["status" => "success"]);
            $request->session()->flash("success", "Berhasil bug telah diperbaiki!");
            echo "/teknisi/report";
        }
        if ($type == "with_inventory") {
            $inventory = collect(request()->input("inventory", []))
                ->mapWithKeys(function ($i) {
                    $stock_inventory = Inventory::find($i[0]);
                    $stock = $stock_inventory->stock - $i[1];
                    $stock_inventory->update(["stock" => $stock, "status" => $stock <= 0 ? "sold" : "ready"]);
                    return [$i[0] => ["stock" => $i[1]]];
                });
            $report->inventories()->sync($inventory);
            $report->update(["status" => "success"]);
            $request->session()->flash("success", "Berhasil bug telah diperbaiki,menggunakan inventori!");
        }
        Message::create([
            "name" => "Laporan anda telah diperbaiki!",
            "type" => "notification",
            "user_id" => $report->member_id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
