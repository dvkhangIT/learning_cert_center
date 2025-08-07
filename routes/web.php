<?php

use App\Http\Controllers\admin\AccountController;
use App\Http\Controllers\admin\ClassController;
use App\Http\Controllers\admin\CourseController;
use App\Http\Controllers\admin\StudentController;
use App\Http\Controllers\quan_ly\HocVienController;
use App\Http\Controllers\quan_ly\KhoaHocController;
use App\Http\Controllers\quan_ly\LopController;
use App\Http\Controllers\quan_ly\NguoiDungController;
use App\Http\Controllers\quan_ly\ThongKeController;
use App\Http\Controllers\user\DashboardController;
use App\Http\Controllers\TaiKhoanController;
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
  return view('tai_khoan.dang_nhap');
});
// Guest Route
Route::group(['middleware' => 'guest'], function () {
  Route::get('dang-nhap', [TaiKhoanController::class, 'formDangNhap'])->name('form-dang-nhap');
  Route::post('dang-nhap', [TaiKhoanController::class, 'dangNhap'])->name('dang-nhap');
  Route::get('/register', [TaiKhoanController::class, 'register'])->name('register');
  Route::post('/process-register', [TaiKhoanController::class, 'processRegister'])->name('processRegister');
  Route::get('quen-mat-khau', [TaiKhoanController::class, 'formQuenMatKhau'])->name('form-quen-mat-khau');
  Route::post('quen-mat-khau', [TaiKhoanController::class, 'quenMatKhau'])->name('quen-mat-khau');
  Route::get('khoi-phuc-mat-khau/{token}', [TaiKhoanController::class, 'formKhoiPhucMatKhau'])->name('form-khoi-phuc-mat-khau');
  Route::put('khoi-phuc-mat-khau', [TaiKhoanController::class, 'khoiPhucMatKhau'])->name('khoi-phuc-mat-khau');
});
// Authentication Route
Route::group(['middleware' => 'auth'], function () {
  Route::get('dang-xuat', [TaiKhoanController::class, 'dangXuat'])->name('dang-xuat');
  Route::get('dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
});
Route::group(['prefix' => 'quan-ly', 'middleware' => 'checkRole'], function () {
  Route::get('trang-chu', [ThongKeController::class, 'trangChu'])->name('quan-ly.trang-chu');

  // Tài khoản
  Route::get('danh-sach-tai-khoan', [NguoiDungController::class, 'danhSachTaiKhoan'])->name('quan-ly.tai-khoan.danh-sach-tai-khoan');
  Route::get('tao-tai-khoan', [NguoiDungController::class, 'taoTaiKhoan'])->name('quan-ly.tai-khoan.tao-tai-khoan');
  Route::post('luu-tai-khoan', [NguoiDungController::class, 'luuTaiKhoan'])->name('quan-ly.tai-khoan.luu-tai-khoan');
  Route::put('trang-thai-tai-khoan', [NguoiDungController::class, 'trangThai'])->name('quan-ly.tai-khoan.trang-thai-tai-khoan');
  Route::get('sua-tai-khoan/{ma_tk}', [NguoiDungController::class, 'formSuaTaiKhoan'])->name('quan-ly.tai-khoan.form-sua-tai-khoan');
  Route::put('sua-tai-khoan/{ma_tk}', [NguoiDungController::class, 'suaTaiKhoan'])->name('quan-ly.tai-khoan.sua-tai-khoan');
  Route::delete('xoa-tai-khoan/{ma_tk}', [NguoiDungController::class, 'XoaTaiKhoan'])->name('quan-ly.tai-khoan.xoa-tai-khoan');
  Route::put('khoi-phuc-mat-khau-tai-khoan/{ma_tk}', [NguoiDungController::class, 'khoiPhucMatKhau'])->name('quan-ly.tai-khoan.khoi-phuc-mat-khau-tai-khoan');

  // khóa học
  Route::get('danh-sach-khoa-hoc', [KhoaHocController::class, 'danhSachKhoaHoc'])->name('quan-ly.khoa-hoc.danh-sach-khoa-hoc');
  Route::post('luu-khoa-hoc', [KhoaHocController::class, 'luuKhoaHoc'])->name('quan-ly.khoa-hoc.luu-khoa-hoc');
  Route::put('sua-khoa-hoc/{ma_kh}', [KhoaHocController::class, 'suaKhoaHoc'])->name('quan-ly.khoa-hoc.sua-khoa-hoc');
  Route::delete('xoa-khoa-hoc/{ma_kh}', [KhoaHocController::class, 'xoaKhoaHoc'])->name('quan-ly.khoa-hoc.xoa-khoa-hoc');

  // Lớp
  Route::get('danh-sach-lop', [LopController::class, 'danhSachLop'])->name('quan-ly.lop.danh-sach-lop');
  Route::get('tao-lop', [LopController::class, 'formTaoLop'])->name('quan-ly.lop.form-tao-lop');
  Route::post('luu-lop', [LopController::class, 'luuLop'])->name('quan-ly.lop.luu-lop');
  Route::get('sua-lop/{ma_lop}', [LopController::class, 'formSuaLop'])->name('quan-ly.lop.form-sua-lop');
  Route::put('sua-lop/{ma_lop}', [LopController::class, 'suaLop'])->name('quan-ly.lop.sua-lop');
  Route::delete('xoa-lop/{ma_lop}', [LopController::class, 'xoaLop'])->name('quan-ly.lop.xoa-lop');
  Route::get('lop/{ma_lop}/hoc-vien-chua-co', [LopController::class, 'getHocVien']);
  Route::get('lop/them-hoc-vien/{ma_lop}', [LopController::class, 'themHocVien'])->name('quan-ly.lop.them-hoc-vien');
  Route::post('lop/luu-hoc-vien/{ma_lop}', [LopController::class, 'luuHocVien'])->name('quan-ly.lop.luu-hoc-vien');
  Route::get('lop/{ma_lop}/hoc-vien', [LopController::class, 'hocVienTrongLop'])
    ->name('quan-ly.lop.hoc-vien');
  Route::delete('lop/{ma_lop}/hoc-vien/{ma_hv}', [LopController::class, 'xoaHocVien'])->name('lop.hoc-vien.xoa');

  //Học viên
  Route::get('danh-sach-hoc-vien', [HocVienController::class, 'danhSachHocVien'])->name('quan-ly.hoc-vien.danh-sach-hoc-vien');
});
