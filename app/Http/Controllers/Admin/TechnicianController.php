<?php

namespace App\Http\Controllers\Admin;

use Maatwebsite\Excel\Facades\Excel;

use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class TechnicianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $technician = User::latest();

        return view("admin.technician.index", [
            'title' => "Technician",
            "technician" => $technician
                ->filter(request(['date', 'search']))
                ->where('role_id', 3)
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
            "name" => 'required',
            "email" => "nullable|email:dns",
            "phone" => "unique:users,phone|min:8",
            "alamat" => "required",
            "location" => "nullable",
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);
        $validate['role_id'] = 3;
        $validate["password"]=Hash::make($validate["password"]);
        User::create($validate);
        return redirect('/admin/technician')->with('success', "Teknisi baru berhasil ditambahkan!");
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
    public function edit(User $technician)
    {
        return json_encode($technician);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $technician)
    {
        $rule = [
            "name" => 'required',
            "email" => "nullable|email:dns",
            "alamat" => "required",
            "location" => "nullable",
        ];
        $msg = $technician->name . ", berhasil diperbarui";
        if ($request->phone != $technician->phone) {
            $rule["phone"] = "unique:users,phone|min:8";
            $msg .= " phone number juga diperbarui";
        }
        $validate = $request->validate($rule);
        if ($request->password != null) {
            $validate["password"] =  Hash::make($request->password);
            $msg .= " dan Password direset";
        }
        $technician->update($validate);
        if (count($technician->getChanges()) == 0) {
            return redirect("/admin/technician")->with("error", "Tidak ada data yang di update!");
        }
        return redirect("/admin/technician")->with("success", $msg . '!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $technician)
    {
        try {
            $technician->delete();
            return redirect("/admin/technician")->with("success", $technician->name . " berhasil dihapus!");
        } catch (\Throwable $th) {
            return redirect("/admin/technician")->with("error", $technician->name . " gagal dihapus karena masih ada data yang terhubung dengan teknisi ini!");
        }
    }
    public function export()
    {
        $role = request()->role;
        $name = $role == "3" ? "DAFTARTEKNISI" : "DAFTARMEMBER";
        return Excel::download(new UsersExport(request("role")), $name . ".xlsx");
    }
}
