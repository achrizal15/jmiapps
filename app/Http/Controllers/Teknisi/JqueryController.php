<?php

namespace App\Http\Controllers\Teknisi;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Installation;

class JqueryController extends Controller
{
    public function index()
    {
        $model = request()->get("model");
        switch ($model) {
            case 'inventory':
                echo json_encode(Inventory::latest()->where(["status" => "ready"])->get());
                break;
            case 'installation':
                echo json_encode(Installation::latest()->get());
                break;

            default:
                abort(404);
                break;
        }
    }
}
