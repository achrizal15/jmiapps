<?php

namespace App\Http\Controllers\Pemilik;

use App\Models\User;
use App\Models\Installation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $psb = Installation::all()->count();
        $teknisi = \App\Models\User::where("role_id", "3")->get()->count();
        $member = User::where("role_id", "4")->get()->count();

        return view("pemilik.index", ['title' => "Welcome", "total_teknisi" => $teknisi, "total_psb" => $psb, "total_member" => $member]);
    }
}
