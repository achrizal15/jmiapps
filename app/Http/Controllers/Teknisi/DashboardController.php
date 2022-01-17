<?php

namespace App\Http\Controllers\Teknisi;

use DateTime;
use App\Models\User;
use App\Models\Inventory;
use App\Models\Installation;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;
use App\Http\Controllers\Controller;
use App\Models\Report;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $installation = Installation::where("technician_id", auth()->user()->id)->count();
        $report = Report::where("technician_id", auth()->user()->id)->count();

        return view("teknisi.index", [
            "title" => "Dashboard",
            "teknisi" => auth()->user()->name,
            "total_install" => $installation,
            "total_report" => $report
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
        //
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
    public function edit(Installation $teknisi)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Installation $teknisi)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function profile()
    {
        $this_user = User::with("role")->find(auth()->user()->id);
        return view("teknisi.profile", ["title" => "Profile", "user" => $this_user]);
    }
}
