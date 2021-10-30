<?php

use App\Http\Controllers\Admin\BlokController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Pemilik\FinanceController;
use App\Http\Controllers\Admin\ExpenditureController;
use App\Http\Controllers\Pemilik\FinancingController;
use App\Http\Controllers\Admin\InstallationController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\Admin\TechnicianController;
use App\Http\Controllers\Pelanggan\DashboardController;
use App\Http\Controllers\Pelanggan\PaymentController;
use App\Http\Controllers\Pelanggan\ReportController;
use App\Http\Controllers\Pemilik\DashboardController as PemilikDashboardController;
use App\Http\Controllers\Teknisi\DashboardController as TeknisiDashboardController;

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

Route::get('/logout', [LoginController::class, "logout"]);
Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view("welcome", ['title' => "Landing Page"]);
    });
    Route::get('/login', [LoginController::class, "index"])->name("login");
    Route::post('/login', [LoginController::class, "authenticate"]);
    Route::get('/register', [RegisterController::class, "index"]);
    Route::post('/register', [RegisterController::class, "store"]);
});
Route::middleware(['auth', 'is_role:1'])->group(function () {
    Route::get('/pemilik', [PemilikDashboardController::class, 'index']);
    Route::prefix('/pemilik/agreement')->group(function () {
        Route::get('/', [FinancingController::class, "index"]);
        Route::put('/financing/{expenditure}', [FinancingController::class, "update"]);
    });
    Route::prefix('/pemilik')->group(function () {
        Route::resource('/finance', FinanceController::class)->except("show");
    });
});
Route::middleware(['auth', 'is_role:2'])->group(function () {
    Route::get('/admin', [AdminDashboardController::class, "index"]);
    Route::prefix('/admin')->group(function () {
        Route::resource('/product', InventoryController::class);
        Route::resource('/expenditure', ExpenditureController::class)->except("show");
        Route::resource('/package', PackageController::class)->except("show");
        Route::resource('/member', MemberController::class);
        Route::post('/installation/{installation}', [InstallationController::class, "pause"]);
        Route::get('/installation/selectJquery', [InstallationController::class, "selectJquery"]);
        Route::resource('/installation', InstallationController::class);
        Route::resource('/technician', TechnicianController::class);
        Route::resource('/salary', SalaryController::class);
        Route::resource('/payment', AdminPaymentController::class)->names("admin.payment");
        Route::resource('/blok', BlokController::class)->names("admin.blok");
    });
});
Route::middleware(['auth', 'is_role:4'])->group(function () {
    Route::get('/pelanggan', [DashboardController::class, "index"]);
    Route::prefix("/pelanggan")->group(function () {
        Route::resource('/payment', PaymentController::class);
        Route::resource('/dashboard', DashboardController::class);
        Route::prefix("/information")->group(function () {
            Route::get("/", [ReportController::class, "index"]);
            Route::post("/report", [ReportController::class, "store"]);
            Route::delete("/report/{report}", [ReportController::class, "destroy"]);
        });
    });
});
Route::middleware(['auth', "is_role:3"])->group(function () {
    Route::get('/teknisi/selectjquery', [TeknisiDashboardController::class, "selectquery"]);
    Route::resource('/teknisi', TeknisiDashboardController::class);
});
