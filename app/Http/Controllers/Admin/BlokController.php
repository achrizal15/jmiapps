<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blok;
use Illuminate\Http\Request;

class BlokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bloks = Blok::latest()
            ->filter(request(['date', 'search']))   
            ->with("collectors")
            ->paginate(25)->withQueryString();
        return view("admin.blok.index", ["title" => "Blok", "bloks" => $bloks]);
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
        $valid = $request->validate([
            "collector_id" => "required",
            "name" => "unique:bloks,name|required",
            "detail_address" => "required"
        ]);
        Blok::create($valid);
        return  redirect("/admin/blok")->with("success", "Blok baru berhasil ditambahkan!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blok  $blok
     * @return \Illuminate\Http\Response
     */
    public function show(Blok $blok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blok  $blok
     * @return \Illuminate\Http\Response
     */
    public function edit(Blok $blok)
    {
        return $blok->load('collectors');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blok  $blok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blok $blok)
    {
        $rule = [
            "collector_id" => "required",
            "detail_address" => "required"
        ];
        if ($request->name != $blok->name) $rule["name"] = "unique:bloks,name|required";
        $valid = $request->validate($rule);
        $blok->update($valid);
        return redirect("/admin/blok")->with("success", $blok->name . " berhasil diupdate!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blok  $blok
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blok $blok)
    {
        $blok->delete();
        return redirect("/admin/blok")->with("success", "Data berhasil dihapus!");
    }
}
