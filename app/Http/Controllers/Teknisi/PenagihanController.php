<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use App\Models\Installation;
use App\Models\Payment;
use App\Models\Salary;
use Illuminate\Http\Request;

class PenagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tagihan = Installation::latest()->with(['user', 'package', "bloks"])
            ->whereHas("bloks", function ($query) {
                $query->where("collector_id", auth()->user()->id);
            })
            ->where([["expired", "!=", null]])->get();
        return view("teknisi.penagihan.index", ["title" => "Penagihan", "tagihan" => $tagihan]);
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
        $validate = $request->validate([
            "transfer_img" => "required|image|file|max:1024",
            "message" => "nullable"
        ]);
        $installation = Installation::find($request->installation_id);
        $validate['member_id'] =  $request->member_id;
        $validate["status"] = "Telah di tagih teknisi";
        $validate['installation_id'] = $request->installation_id;
        $validate['transfer_img'] = $request->file("transfer_img")->store("transfer-images");
        Payment::create($validate);
        $installation->update(["status"=>"waiting"]);
        return   redirect("/teknisi/penagihan")->with("success", "Penagihan berhasil dilakukan segera stor ke admin!");
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
    public function destroy($id)
    {
        //
    }
}
