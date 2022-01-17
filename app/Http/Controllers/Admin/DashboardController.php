<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Installation;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $psb = Installation::all()->count();
        $teknisi = User::where("role_id", "3")->get()->count();
        $member = User::where("role_id", "4")->get()->count();

        return view("admin.index", ['title' => "Welcome", "total_teknisi" => $teknisi, "total_psb" => $psb, "total_member" => $member]);
    }
    public function profile()
    {
        $this_user = User::with("role")->find(auth()->user()->id);
        return view("admin.profile", ["title" => "Profile", "user" => $this_user]);
    }
}
