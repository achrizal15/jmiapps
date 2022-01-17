<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExpenditureExport;
use App\Models\Expenditure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExpenditureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.expenditure.index', [
            'title' => "Pembelanjaan",
            "collection" => Expenditure::latest()
                ->filter(request(['search', 'status', 'date']))
                ->paginate(25)->withQueryString()
        ]);
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
            "name_product" => "required",
            "name_suplier" => "required",
            "balance" => "required",
            "stock" => "required",
            "price" => "required",
            "type" => "required",
            "notes" => "nullable"
        ]);
        $validate['status'] = "pending";
        Expenditure::create($validate);
        return redirect('/admin/expenditure')->with("success", $validate['name_product'] . ", Berhasil di ajukan tunggu acc pimpinan!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expenditure  $expenditure
     * @return \Illuminate\Http\Response
     */
    public function show(Expenditure $expenditure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expenditure  $expenditure
     * @return \Illuminate\Http\Response
     */
    public function edit(Expenditure $expenditure)
    {
        echo json_encode($expenditure);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expenditure  $expenditure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expenditure $expenditure)
    {
        $rules = [
            "name_product" => "required",
            "name_suplier" => "required",
            "balance" => "required",
            "stock" => "required",
            "price" => "required",
            "type" => "required",
            "notes" => "nullable"
        ];
        $validate = $request->validate($rules);
        Expenditure::where("id", $expenditure->id)->update($validate);
        return redirect('/admin/expenditure')->with("success", $validate['name_product'] . ", Berhasil diupdate tunggu acc pimpinan!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expenditure  $expenditure
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expenditure $expenditure)
    {
        Expenditure::find($expenditure->id)->delete();
        return redirect('/admin/expenditure')->with("success", "Data berhasil dihapus");
    }
    public function export()
    {
        return Excel::download(new ExpenditureExport(request("year"),request("status")), "PEMBELANJAAN.xlsx");
    }
}
