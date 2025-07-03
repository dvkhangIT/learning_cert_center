<?php

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
});
// Authentication Route
Route::group(['middleware' => 'auth'], function () {
  Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
});
Route::group(['prefix' => 'admin', 'middleware' => 'checkRole'], function () {
  Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});
