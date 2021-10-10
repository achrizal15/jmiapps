<?php

namespace App\Http\Controllers\Admin;

use App\Models\Salary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salarys = Salary::latest();
        return view("admin.salary.index", [
            "title" => "Gaji Teknisi",
            "salaries" => $salarys
                ->filter(request(['date', 'search']))
                ->with(["user"])
                ->paginate(25)
                ->withQueryString()
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
            "user_id" => "exists:users,id|required",
            "pay_cut" => "nullable|numeric",
            "bonus" => "nullable|numeric",
            "balance" => "numeric|required",
            "note" => "nullable",
        ]);
        Salary::create($validate);
        return redirect("/admin/salary")->with("success", "Data berhasil ditambah!");
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
    public function edit(Salary $salary)
    {
        return $salary->load('user');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salary $salary)
    {
        $validate=$request->validate([
            "user_id" => "exists:users,id|required",
            "pay_cut" => "nullable|numeric",
            "bonus" => "nullable|numeric",
            "balance" => "numeric|required",
            "note" => "nullable",
        ]);
        $salary->update($validate);
        if(count($salary->getChanges())==0){
            return redirect("/admin/salary")->with("error","Tidak ada data yang diupdate!");
        }
        return redirect("admin/salary")->with('success',"Data berhasil diupdate!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salary $salary)
    {
        $salary->delete();
        return redirect('/admin/salary')
            ->with("success", $salary
                ->status . " gaji " . $salary
                ->user->name . " berhasil dihapus");
    }
}
