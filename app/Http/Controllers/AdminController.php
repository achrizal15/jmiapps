<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $name=auth()->user()->name;
        return view("admin.index", ['title' => "Welcome $name"]);
    }
}
