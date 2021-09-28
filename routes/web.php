<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\ExpenditureController;
use App\Http\Controllers\Pemilik\FinancingController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Pemilik\DashboardController as PemilikDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view("welcome", ['title' => "Landing Page"]);
    });
    Route::get('/login', [LoginController::class, "index"])->name("login");
    Route::post('/login', [LoginController::class, "authenticate"]);
    Route::get('/register', [RegisterController::class, "index"]);
    Route::post('/register', [RegisterController::class, "store"]);
});
Route::get('/logout', [LoginController::class, "logout"]);
Route::middleware(['auth', 'is_role:1'])->group(function () {
    Route::get('/pemilik',[PemilikDashboardController::class,'index']);
    Route::prefix('/pemilik/agreement')->group(function () {
        Route::get('/', [FinancingController::class, "index"]);
    });
    Route::prefix('/pemilik/agreement')->group(function () {
        Route::put('/financing/{expenditure}', [FinancingController::class, "update"]);
    });
});
Route::middleware(['auth', 'is_role:2'])->group(function () {
    Route::get('/admin', [AdminDashboardController::class, "index"]);
    Route::prefix('/admin/expenditure')->group(function () {
        Route::get('/', [ExpenditureController::class, "index"]);
        Route::post('/', [ExpenditureController::class, "store"]);
        Route::delete('/{expenditure}', [ExpenditureController::class, "destroy"]);
        Route::put('/{expenditure}', [ExpenditureController::class, "update"]);
        Route::post('/{expenditure}/edit', [ExpenditureController::class, "edit"]);
    });
    Route::prefix('/admin/product')->group(function () {
        Route::get('/', [InventoryController::class, 'index']);
        Route::post('/', [InventoryController::class, 'store']);
        Route::delete('/{inventory}', [InventoryController::class, 'destroy']);
        Route::put('/{inventory}',[InventoryController::class,'update']);
        Route::post('/{inventory}/edit', [InventoryController::class, 'edit']);
    });
});
