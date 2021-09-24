<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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
    Route::get('/pemilik', function () {
        return view('pemilik.index', ['title' => "Super User"]);
    });
});
Route::middleware(['auth', 'is_role:2'])->group(function () {
    Route::get('/admin', [AdminController::class, "index"]);
    Route::get('/admin/supplier', [InventoryController::class, "index"]);
});
