<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = new Package;
        return view('admin.package.index', ['title' => "Paket", "packages" => $packages->latest()->get()]);
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
            "name" => "required|unique:packages,name",
            "price" => "required",
            "feature" => "required",
            "detail" => "nullable"
        ]);
        Package::create($validate);
        return redirect('/admin/package')->with('success', $request->name . " berhasil ditambahkan!");
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
    public function edit(Package $package)
    {

        $packages = new Package;
        return view('admin.package.edit', ['title' => "Edit Package", 'packages' => $packages->all(), "package" => $package]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        $validate = $request->validate([
            "name" => "required|unique:packages,name",
            "price" => "required",
            "feature" => "required",
            "detail" => "nullable"
        ]);
        $package->update($validate);
        return redirect('/admin/package')->with('success', 'Berhasil update data package ' . $package->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $package->destroy($package->id);
        return redirect('/admin/package')->with('success', $package->name . ' berhasil di hapus!');
    }
}
