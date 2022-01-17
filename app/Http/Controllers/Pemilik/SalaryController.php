<?php

namespace App\Http\Controllers\Pemilik;

use App\Models\Salary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Installation;

class SalaryController extends Controller
{
    public function index()
    {
        $salarys = Salary::latest();
        return view("pemilik.salary.index", [
            "title" => "Gaji Teknisi",
            "salaries" => $salarys
                ->filter(request(['date', 'search']))
                ->with(["user"])
                ->paginate(25)
                ->withQueryString()
        ]);
    }
    public function update(Salary $salary){
      if(request("status")=="accept"){
          $salary->update(["status"=>"accept"]);
          return redirect("pemilik/salary")->with("success","Berhasil diterima.");
        }else{
$salary->delete();
            return redirect("pemilik/salary")->with("error","Pengajuan gaji ditolak.");
        }
    }
}
