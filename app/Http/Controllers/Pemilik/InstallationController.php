<?php

namespace App\Http\Controllers\Pemilik;

use App\Models\Blok;
use App\Models\User;
use App\Models\Installation;
use Illuminate\Http\Request;
use App\Exports\InstallationExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class InstallationController extends Controller
{
    public function index()
    {
        $psb = Installation::latest();
        $blok = Blok::latest()->get();
        $teknisi = User::where("role_id", "3")->orderBy("name", "asc")->get();

        return view('pemilik.installation.index', [
            'title' => "Pasang Baru",
            "blok" => $blok,
            "teknisi" => $teknisi,
            "collection" => $psb->with(['user', 'package', 'technician', "bloks.collectors"])
                ->filters(request(['date', 'search']))
                ->paginate(10)
                ->withQueryString()
        ]);
    }
    public function export()
    {
        return Excel::download(new InstallationExport(request("date")), "PSB-" . request("date") . ".xlsx");
    }
}
