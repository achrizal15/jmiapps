<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register', ["title" => 'Register']);
    }
    public function store(Request $request)
    {

        $validate = $request->validate([
            "name" => 'required',
            "email" => 'nullable',
            "phone" => 'required|unique:users,phone|min:8',
            "alamat" => 'required',
            'password' => "required|min:3|max:8|same:re-password",
        ]);

        $validate['name'] = ucwords($validate['name']);
        $validate['password'] = Hash::make($validate['password']);
        User::create($validate);
        // if (isset(request()->fromadmin) ? request()->fromadmin : false) {
        //     return redirect('/admin/member')->with('success', 'Member baru berhasil ditambahkan!');
        // }
        return redirect('/login')->with('success', 'Berhasil melakukan registrasi!');
    }
}
