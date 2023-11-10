<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForemanController;
use App\Http\Controllers\ValidasiController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
|
*/

// Guest
Route::get('/', function () {
    return view('auth.login');
});

Route::prefix('auth')->group(function () {
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'loginAction'])->name('login.action');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');   
});

// Authenticate
Route::middleware('auth')->group(function () {

    // Admin Only
    Route::group(['middleware' =>['auth','CekLevel:1']], function(){
        // Routing for Dashboard Admin
        Route::get('admin', [AdminController::class, 'dashboard'])->name('admin.DashboardAdmin');

        Route::resource('project', ProjectController::class);

        // Routing for LJKH
        Route::get('exportLJKH', [AdminController::class, 'exportLJKH'])->name('admin.exportLJKH');
        Route::post('importLJKH', [AdminController::class, 'importLJKH'])->name('importLJKH');
        Route::get('admin/index', [AdminController::class, 'index'])->name('admin.ljkh');
        Route::get('create', [AdminController::class, 'create'])->name('admin.addLJKH');
        Route::post('store', [AdminController::class, 'store'])->name('admin.storeLJKH');
        Route::get('edit/{id}', [AdminController::class, 'edit'])->name('admin.editLJKH');
        Route::put('update/{id}', [AdminController::class, 'update'])->name('admin.updateLJKH');
        Route::delete('destroy/{id}', [AdminController::class, 'destroy'])->name('admin.deleteLJKH');

        // Routing For Profile/User Setting
        Route::prefix('profile')->group(function(){
            Route::get('', [UserController::class, 'index'])->name('profile');
            Route::get('create', [UserController::class, 'create'])->name('profile.create');
            Route::get('edit/{id}', [UserController::class, 'edit'])->name('profile.edit');
            Route::put('update/{id}', [UserController::class, 'update'])->name('profile.update');
            Route::delete('destroy/{id}', [UserController::class, 'destroy'])->name('profile.destroy');
            Route::get('register', [UserController::class, 'register'])->name('register');
            Route::post('register', [UserController::class, 'registerSave'])->name('register.save');
        });
    });
    
    // Foreman Only
    Route::group(['middleware' =>['auth','CekLevel:2']], function(){
        // Routing For Foreman Dashboard
        Route::get('foreman', [ForemanController::class, 'currentProcess'])->name('foreman.DashboardForeman');

        // Report Workstation
        Route::prefix('workstation')->group(function() {
            Route::get('', [ForemanController::class, 'index'])->name('workstation.index');
            Route::post('showByMch', [ForemanController::class, 'showByMch'])->name('workstaion.showByMch');
            Route::get('create', [ForemanController::class, 'create'])->name('workstation.create');
            Route::post('store', [ForemanController::class, 'sindetore'])->name('workstation.store');
            Route::post('update/{id}', [ForemanController::class, 'update'])->name('workstation.update');
            Route::get('edit/{id}', [ForemanController::class, 'edit'])->name('workstation.edit');
            Route::delete('destroy/{id}', [ForemanController::class, 'destroy'])->name('workstation.destroy');
        });

        Route::prefix('validasi')->group(function() {
            Route::get('indexValidasi',[ForemanController::class,'indexValidasi'])->name('foreman.ListValidasiJob');
            Route::get('validated',[ForemanController::class,'validated'])->name('foreman.jobValidated');
            Route::get('showJob/{id}',[ForemanController::class,'showJob'])->name('foreman.showValidasiJob');
            Route::put('validasiJob/{id}',[ForemanController::class,'validasiJob'])->name('foreman.validasiJob');
        });
    });

    // Member Only
    Route::group(['middleware' => ['auth', 'CekLevel:3']], function(){
        Route::get('index',[MemberController::class, 'index'])->name('member.index');
        Route::post('submit',[MemberController::class, 'submit'])->name('downtime.submit');
        Route::post('submitStop/{id}',[MemberController::class, 'submitStop'])->name('downtime.submitStop');
        Route::get('showJob/{id}',[MemberController::class, 'showJob'])->name('member.showJob');
        Route::post('jobStart/{id}',[MemberController::class, 'jobStart'])->name('member.start');
        Route::post('jobEnd/{id}',[MemberController::class, 'jobEnd'])->name('member.stop');
        Route::post('nextShift/{id}',[MemberController::class, 'nextShift'])->name('member.nextShift');
        Route::post('takeJob/{id}',[MemberController::class, 'takeJob'])->name('job.take');
        Route::post('cancelJob/{id}',[MemberController::class, 'cancelJob'])->name('member.cancel');
        Route::get('indexJob',[MemberController::class, 'indexJob'])->name('member.indexJob');
        Route::post('autoRun/{id}', [MemberController::class, 'autoRun'])->name('member.autoRun');
    });
});




