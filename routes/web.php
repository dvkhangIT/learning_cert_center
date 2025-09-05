<?php

use App\Http\Controllers\admin\AccountController;
use App\Http\Controllers\admin\ClassController;
use App\Http\Controllers\admin\CourseController;
use App\Http\Controllers\admin\StudentController;
use App\Http\Controllers\quan_ly\ChungChiController;
use App\Http\Controllers\quan_ly\HocVienController;
use App\Http\Controllers\quan_ly\KetQuaController;
use App\Http\Controllers\quan_ly\KhoaHocController;
use App\Http\Controllers\quan_ly\LopController;
use App\Http\Controllers\quan_ly\NguoiDungController;
use App\Http\Controllers\quan_ly\ThongKeController;
use App\Http\Controllers\user\DashboardController;
use App\Http\Controllers\nhan_vien\KetQuaController as NhanVienKetQuaController;
use App\Http\Controllers\nhan_vien\ChungChiController as NhanVienChungChiController;
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
  Route::get('doi-mat-khau', [TaiKhoanController::class, 'formDoiMatKhau'])->name('form-doi-mat-khau');
  Route::post('doi-mat-khau', [TaiKhoanController::class, 'luuMatKhau'])->name('luu-mat-khau');
});
Route::group(['prefix' => 'quan-ly', 'middleware' => 'checkRole'], function () {
  Route::get('thong-ke', [ThongKeController::class, 'thongKe'])->name('quan-ly.tong-quan');

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
  Route::get('tao-hoc-vien', [HocVienController::class, 'formTaoHocVien'])->name('quan-ly.hoc-vien.form-tao-hoc-vien');
  Route::post('luu-hoc-vien', [HocVienController::class, 'luuHocVien'])->name('quan-ly.hoc-vien.luu-hoc-vien');
  Route::get('sua-hoc-vien/{ma_hv}', [HocVienController::class, 'formSuaHocVien'])->name('quan-ly.hoc-vien.form-sua-hoc-vien');
  Route::put('sua-hoc-vien/{ma_hv}', [HocVienController::class, 'suaHocVien'])->name('quan-ly.hoc-vien.sua-hoc-vien');
  Route::delete('xoa-hoc-vien/{ma_hv}', [HocVienController::class, 'xoaHocVien'])->name('quan-ly.hoc-vien.xoa-hoc-vien');

  // Chứng chỉ
  Route::get('danh-sach-chung-chi', [ChungChiController::class, 'danhSachChungChi'])->name('quan-ly.chung-chi.danh-sach-chung-chi');
  Route::get('tao-chung-chi', [ChungChiController::class, 'formTaoChungChi'])->name('quan-ly.chung-chi.form-tao-chung-chi');
  Route::post('luu-chung-chi', [ChungChiController::class, 'luuChungChi'])->name('quan-ly.chung-chi.luu-chung-chi');
  Route::get('sua-chung-chi/{ma_cc}', [ChungChiController::class, 'formSuaChungChi'])->name('quan-ly.chung-chi.form-sua-chung-chi');
  Route::put('sua-chung-chi/{ma_cc}', [ChungChiController::class, 'suaChungChi'])->name('quan-ly.chung-chi.sua-chung-chi');
  Route::delete('xoa-chung-chi/{ma_cc}', [ChungChiController::class, 'xoaChungChi'])->name('quan-ly.chung-chi.xoa-chung-chi');

  // Điểm thi
  Route::get('ket-qua/tieng-anh-ctut', [KetQuaController::class, 'danhSachTiengAnhCtut'])->name('quan-ly.ket-qua.tieng-anh-ctut');
  Route::get('ket-qua/tieng-anh-bac-3', [KetQuaController::class, 'danhSachTiengAnhBac3'])->name('quan-ly.ket-qua.tieng-anh-bac-3');
  Route::get('ket-qua/tieng-nhat-n4', [KetQuaController::class, 'danhSachTiengNhatN4'])->name('quan-ly.ket-qua.tieng-nhat-n4');
  Route::get('ket-qua/cntt-can-ban', [KetQuaController::class, 'danhSachCnttCanBan'])->name('quan-ly.ket-qua.cntt-co-ban');
  Route::get('sua-ket-qua/{ma_kq}', [KetQuaController::class, 'formSuaKetQua'])->name('quan-ly.ket-qua.form-sua-ket-qua');
  Route::put('sua-ket-qua/{ma_kq}', [KetQuaController::class, 'suaKetQua'])->name('quan-ly.ket-qua.sua-ket-qua');
  Route::delete('xoa-ket-qua/{ma_kq}', [KetQuaController::class, 'xoaKetQua'])->name('quan-ly.ket-qua.xoa-ket-qua');
  // khôi phục kết quả khi xóa
  Route::get('quan-ly/ket-qua-da-xoa', [KetQuaController::class, 'danhSachKetQuaDaXoa'])
    ->name('quan-ly.ket-qua.ket-qua-da-xoa');
  Route::patch('/quan-ly/khoi-phuc-ket-qua/{ma_kq}', [KetQuaController::class, 'khoiPhucKetQua'])
    ->name('quan-ly.ket-qua.khoi-phuc-ket-qua');
});

// Staff routes (nhân viên)
Route::group(['prefix' => 'nhan-vien', 'middleware' => 'checkStaff'], function () {
  // Tổng quan nhân viên có thể dùng dashboard chung hoặc trang riêng nếu có
  Route::get('thong-ke', [DashboardController::class, 'index'])->name('nhan-vien.tong-quan');

  // Tra cứu chứng chỉ (nhân viên)
  Route::get('chung-chi/tra-cuu', [NhanVienChungChiController::class, 'traCuuForm'])->name('nhan-vien.chung-chi.tra-cuu');
  Route::post('chung-chi/tra-cuu', [NhanVienChungChiController::class, 'traCuu'])->name('nhan-vien.chung-chi.tra-cuu.post');
  Route::patch('chung-chi/{ma_cc}/cap-nhat-trang-thai', [NhanVienChungChiController::class, 'capNhatTrangThai'])->name('nhan-vien.chung-chi.cap-nhat-trang-thai');
  Route::get('chung-chi/{ma_cc}/in', [NhanVienChungChiController::class, 'inChungChi'])->name('nhan-vien.chung-chi.in');
  
  // In chứng chỉ (nhân viên)
  Route::get('chung-chi/in/danh-sach', [NhanVienChungChiController::class, 'danhSachInChungChi'])->name('nhan-vien.chung-chi.in-danh-sach');

  // Kết quả - Tiếng Anh CTUT (nhân viên chỉ cập nhật Đạt/Không đạt)
  Route::get('ket-qua/tieng-anh-ctut', [NhanVienKetQuaController::class, 'danhSachTiengAnhCtut'])
    ->name('nhan-vien.ket-qua.tieng-anh-ctut');
  Route::get('ket-qua/tieng-anh-bac-3', [\App\Http\Controllers\nhan_vien\KetQuaController::class, 'danhSachTiengAnhBac3'])
    ->name('nhan-vien.ket-qua.tieng-anh-bac-3');
  Route::get('ket-qua/tieng-nhat-n4', [\App\Http\Controllers\nhan_vien\KetQuaController::class, 'danhSachTiengNhatN4'])
    ->name('nhan-vien.ket-qua.tieng-nhat-n4');
  Route::get('ket-qua/cntt-can-ban', [\App\Http\Controllers\nhan_vien\KetQuaController::class, 'danhSachCnttCanBan'])
    ->name('nhan-vien.ket-qua.cntt-co-ban');
  Route::patch('ket-qua/{ma_kq}/cap-nhat-trang-thai', [NhanVienKetQuaController::class, 'capNhatTrangThai'])
    ->name('nhan-vien.ket-qua.cap-nhat-trang-thai');
  Route::delete('ket-qua/{ma_kq}', [NhanVienKetQuaController::class, 'xoaKetQua'])
    ->name('nhan-vien.ket-qua.xoa-ket-qua');
  // Nhập điểm (sửa kết quả) cho nhân viên
  Route::get('sua-ket-qua/{ma_kq}', [NhanVienKetQuaController::class, 'formSuaKetQua'])
    ->name('nhan-vien.ket-qua.form-sua-ket-qua');
  Route::put('sua-ket-qua/{ma_kq}', [NhanVienKetQuaController::class, 'suaKetQua'])
    ->name('nhan-vien.ket-qua.sua-ket-qua');
});
