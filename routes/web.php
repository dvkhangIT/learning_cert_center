<?php

use App\Http\Controllers\DashboardController;
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
// Authentication <Route></Route>
Route::group(['middleware' => 'auth'], function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
