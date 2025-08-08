<?php

namespace App\Http\Controllers\quan_ly;

use App\DataTables\HocVienDataTable;
use App\Http\Controllers\Controller;
use App\Models\HocVien;
use Illuminate\Http\Request;

class HocVienController extends Controller
{
  public function danhSachHocVien(HocVienDataTable $dataTable)
  {
    return $dataTable->render('quan_ly.hoc_vien.danh_sach_hoc_vien');
  }
  public function formTaoHocVien()
  {
    return view('quan_ly.hoc_vien.them_hoc_vien');
  }
  public function luuHocVien(Request $request)
  {
    $request->validate([
      'hoten_hv' => ['required', 'string', 'max:100'],
      'ngay_sinh' => ['required', 'date'],
      'noi_sinh' => ['required'],
      'gioi_tinh' => ['required', 'in:nam,nu']
    ], [
      'hoten_hv.required' => 'Họ tên không được để trống.',
      'hoten_hv.string' => 'Họ tên phải là một chuỗi ký tự.',
      'hoten_hv.max' => 'Họ tên không được vượt quá 100 ký tự.',
      'ngay_sinh.required' => 'Ngày sinh không được để trống.',
      'ngay_sinh.date' => 'Ngày sinh không hợp lệ.',
      'noi_sinh.required' => 'Nơi sinh không được để trống.',
      'gioi_tinh.required' => 'Giới tính không được để trống.',
      'gioi_tinh.in' => 'Giới tính không hợp lệ.',
    ]);
    $hocVien = new HocVien();
    $hocVien->hoten_hv = $request->hoten_hv;
    $hocVien->ngay_sinh = $request->ngay_sinh;
    $hocVien->noi_sinh = $request->noi_sinh;
    $hocVien->gioi_tinh = $request->gioi_tinh;
    $hocVien->ngay_tao = now();
    $hocVien->ngay_cap_nhat = now();
    $hocVien->save();
    toastr()->success('Tạo học viên thành công.', ' ');
    return redirect()->route('quan-ly.hoc-vien.danh-sach-hoc-vien');
  }
  public function formSuaHocVien(string $ma_hv)
  {
    $hocVien = HocVien::findOrFail($ma_hv);
    return view('quan_ly.hoc_vien.sua_hoc_vien', compact('hocVien'));
  }
  public function suaHocVien(Request $request, string $ma_hv)
  {
    $request->validate([
      'hoten_hv' => ['required', 'string', 'max:100'],
      'ngay_sinh' => ['required', 'date'],
      'noi_sinh' => ['required'],
      'gioi_tinh' => ['required', 'in:nam,nu']
    ], [
      'hoten_hv.required' => 'Họ tên không được để trống.',
      'hoten_hv.string' => 'Họ tên phải là một chuỗi ký tự.',
      'hoten_hv.max' => 'Họ tên không được vượt quá 100 ký tự.',
      'ngay_sinh.required' => 'Ngày sinh không được để trống.',
      'ngay_sinh.date' => 'Ngày sinh không hợp lệ.',
      'noi_sinh.required' => 'Nơi sinh không được để trống.',
      'gioi_tinh.required' => 'Giới tính không được để trống.',
      'gioi_tinh.in' => 'Giới tính không hợp lệ.',
    ]);
    $hocVien = HocVien::findOrFail($ma_hv);
    $hocVien->hoten_hv = $request->hoten_hv;
    $hocVien->ngay_sinh = $request->ngay_sinh;
    $hocVien->noi_sinh = $request->noi_sinh;
    $hocVien->gioi_tinh = $request->gioi_tinh;
    $hocVien->ngay_cap_nhat = now();
    $hocVien->save();
    toastr()->success('Cập nhật thành công.', ' ');
    return redirect()->route('quan-ly.hoc-vien.danh-sach-hoc-vien');
  }
  public function xoaHocVien(string $ma_hv)
  {
    $hocVien = HocVien::findOrFail($ma_hv);
    $hocVien->delete();
    return response()->json(
      [
        'status' => 'success',
        'message' => 'Xóa thành công.'
      ]
    );
  }
}
