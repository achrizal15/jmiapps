<?php

use App\Http\Controllers\Admin\BlokController;
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
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\Admin\TechnicianController;
use App\Http\Controllers\Pelanggan\DashboardController;
use App\Http\Controllers\Pelanggan\PaymentController;
use App\Http\Controllers\Pemilik\DashboardController as PemilikDashboardController;
use App\Http\Controllers\Teknisi\DashboardController as TeknisiDashboardController;
use App\Http\Controllers\Teknisi\InstallationController as TeknisiInstallationController;
use App\Http\Controllers\Teknisi\JqueryController;
use App\Http\Controllers\Teknisi\PenagihanController;
use App\Http\Controllers\Teknisi\ReportController;
use App\Http\Controllers\Welcome;

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
Route::get('/', [Welcome::class, "index"])->name("landingpage");
Route::middleware(['guest'])->group(function () {
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
        Route::resource('/installation', InstallationController::class)->except("show");
        Route::resource('/technician', TechnicianController::class);
        Route::resource('/salary', SalaryController::class);
        Route::resource('/payment', AdminPaymentController::class)->names("admin.payment");
        Route::resource('/blok', BlokController::class)->names("admin.blok");
        Route::resource('/report', AdminReportController::class)->names("admin.report");
    });
});
Route::middleware(['auth', 'is_role:4'])->group(function () {
    Route::get('/pelanggan', [DashboardController::class, "index"]);
    Route::prefix("/pelanggan")->group(function () {
        Route::resource('/payment', PaymentController::class);
        Route::post("/dashboard/report", [DashboardController::class, "report"]);
        Route::delete("/dashboard/report/{user}", [DashboardController::class, "report_destroy"]);
        Route::resource('/dashboard', DashboardController::class);
    });
});
Route::middleware(['auth', "is_role:3"])->group(function () {
    Route::get('/teknisi/jquery', [JqueryController::class, "index"]);
    Route::resource('/teknisi/installation', TeknisiInstallationController::class)
        ->names("teknisiInstallation");
    Route::resource('/teknisi/report', ReportController::class)->names("teknisiController")->except("show");
    Route::resource('/teknisi/penagihan', PenagihanController::class);
    Route::get('/teknisi', [TeknisiDashboardController::class, "index"]);
});
