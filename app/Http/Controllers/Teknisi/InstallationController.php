<?php

namespace App\Http\Controllers\Teknisi;

use App\Models\Installation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inventory;

class InstallationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technician_id = auth()->user()->id;
        $psb = Installation::where("technician_id", $technician_id)
            ->with(['technician', 'user', 'package', "bloks"])->get();
        return view("teknisi.install.index", ["title" => "installation", "psb" => $psb]);
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
    public function edit(Installation $installation)
    {
        return view("teknisi.install.install", [
            'title' => "Install",
            "inventories" => Inventory::latest()
                ->where([['status', '=', 'ready'], ["stock", ">", 0]])->get(),
            "installation" => $installation->load(['user', 'package'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Installation $installation)
    {
        $installationData = [
            "username" => $request->username,
            "number_modem" => $request->number_modem,
            "installation_costs" => $request->installation_costs,
            "redaman" => $request->redaman,
            "spliter" => $request->spliter,
            "port" => $request->port,
            "location" => $request->location,
            "discount" => $request->discount,
            "expired" => date("Y-m-d", strtotime("+1 month")),
            "status" => "installed"
        ];
        $username_exist = Installation::where("username", $request->username)->first();
        $error = $username_exist ? "username has been used" : "";
        for ($index = 0; $index < count($inv = $request->input("inventory", [])); $index++) {
            $stock_inventory = Inventory::find($inv[$index][0]);
            if ($stock_inventory) {
                $stock_ = $stock_inventory->stock - $inv[$index][1];
                if ($stock_ < 0) {
                    $error .= "Stock " . $stock_inventory->name . " sudah habis!";
                }
            }
        }
        if ($error == "") {
            $inventory = collect($request->input("inventory", []))
                ->mapWithKeys(function ($i) {
                    $stock_inventory = Inventory::find($i[0]);
                    $stock = $stock_inventory->stock - $i[1];
                    $stock_inventory->update(["stock" => $stock, "status" => $stock <= 0 ? "sold" : "ready"]);
                    return [$i[0] => ["stock" => $i[1]]];
                });
            $installation->user->update(["location" => $request->location]);
            $installation->update($installationData);
            $installation->inventorys()->sync($inventory);
            $request->session()->flash('success', 'Installation success!');
        }
        echo $error;
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
}
