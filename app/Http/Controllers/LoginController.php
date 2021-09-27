<?php

namespace App\Http\Controllers;

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.index', ["title" => "Login"]);
    }
    public function authenticate()
    {
        $validate = request()->validate([
            "phone" => ["required"],
            "password" => "required"
        ]);
        if (Auth::attempt($validate)) {
            request()->session()->regenerate();
            $role = Auth::user()->role_id;
            if ($role == 1) {
                return redirect()->intended('/pemilik');
            } elseif ($role == 2) {
                return redirect()->intended('/admin');
            } elseif ($role == 3) {
                return redirect()->intended("/teknisi");
            } else {
                return redirect()->intended("/pelanggan");
            }
        }
        return redirect('/login')->with("loginError", "Login gagal silahkan coba lagi!");
    }
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect("/");
    }
}
