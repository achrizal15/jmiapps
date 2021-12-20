<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class Welcome extends Controller
{
    public function index()
    {
        $paket = Package::limit(3)->get();
        return view("welcome",["package"=>$paket]);
    }
}
