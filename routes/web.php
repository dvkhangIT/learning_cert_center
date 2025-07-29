<?php

use App\Http\Controllers\admin\AccountController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\user\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});
// Guest Route
Route::group(['middleware' => 'guest'], function () {
  Route::get('/login', [LoginController::class, 'index'])->name('login');
  Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
  Route::get('/register', [LoginController::class, 'register'])->name('register');
  Route::post('/process-register', [LoginController::class, 'processRegister'])->name('processRegister');
  Route::get('forgot-password', [LoginController::class, 'forgotPassword'])->name('forgot.password');
  Route::post('forgot-password-process', [LoginController::class, 'forgotPasswordProcess'])->name('forgot.password.process');
  Route::get('reset-password/{token}', [LoginController::class, 'resetPassword'])->name('reset.password');
  Route::put('process-reset-password', [LoginController::class, 'processResestPassword'])->name('process.reset.password');
});
// Authentication Route
Route::group(['middleware' => 'auth'], function () {
  Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
});
Route::group(['prefix' => 'admin', 'middleware' => 'checkRole'], function () {
  Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
  Route::get('/account', [AccountController::class, 'index'])->name('admin.account.index');
  Route::get('/account/create', [AccountController::class, 'create'])->name('admin.account.create');
  Route::post('/account/store', [AccountController::class, 'store'])->name('admin.account.store');
  Route::put('account/change-satus', [AccountController::class, 'changeStatus'])->name('admin.account.change-status');
  Route::get('account/edit/{ma_tk}', [AccountController::class, 'edit'])->name('admin.account.edit');
  Route::put('account/update/{ma_tk}', [AccountController::class, 'update'])->name('admin.account.update');
  Route::delete('account/delete/{ma_tk}', [AccountController::class, 'destroy'])->name('admin.account.destroy');
  Route::put('account/reset-password/{ma_tk}', [AccountController::class, 'resetPassword'])->name('admin.account.reset-password');
});
