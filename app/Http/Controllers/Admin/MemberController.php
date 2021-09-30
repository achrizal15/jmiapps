<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $user;
    public function __construct()
    {
        $this->user = User::where('role_id', 4);
    }
    public function index()
    {
        return view('admin.member.index', [
            'title' => "Pelanggan",
            "member" => $this->user
                ->latest()
                ->filter(request(['search']))
                ->paginate(10)
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
            "name" => 'required',
            "email" => 'nullable',
            "phone" => 'required|unique:users,phone',
            "alamat" => 'required',
            'password' => "required|min:3|max:8|same:re-password",
        ]);

        $validate['name'] = ucwords($validate['name']);
        $validate['password'] = Hash::make($validate['password']);
        User::create($validate);
        return redirect('/admin/member')->with('success', 'Member baru berhasil ditambahkan!');
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
    public function edit(User $member)
    {
        return $member;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $member)
    {
        $rule = [
            "name" => 'required',
            "email" => 'nullable',
            "alamat" => 'required',
            "location" => 'nullable',
        ];
        $resetpwd = "";
        if ($request->phone != $member->phone) {
            $rule['phone'] = 'required|unique:users,phone|min:8';
        }
        if ($request->password != null) {
            $rule['password'] = "min:3|max:8|";
        }
        $validate = $request->validate($rule);
        if ($request->password != null) {
            $validate['password'] = Hash::make($request->password);
            $resetpwd = " dan password telah di reset";
        }
        $member->update($validate);
        return redirect('/admin/member')->with("success", $member->name . " telah diupdate!" . $resetpwd);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $member)
    {
        $this->user->find($member->id)->delete();
        return redirect('/admin/member')
            ->with('success', $member->name . " berhasil dihapus silahkan cek kembali!");
    }
}
