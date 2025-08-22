<?php

namespace App\Http\Controllers\quan_ly;

use App\DataTables\ChungChiDataTable;
use App\Http\Controllers\Controller;
use App\Models\ChungChi;
use App\Models\LoaiChungChi;
use Illuminate\Http\Request;

class ChungChiController extends Controller
{
  public function danhSachChungChi(ChungChiDataTable $dataTable)
  {
    return $dataTable->render('quan_ly.chung_chi.danh_sach_chung_chi');
  }
  public function formTaoChungChi()
  {
    $loaiChungChi = LoaiChungChi::all();
    return view('quan_ly.chung_chi.tao_chung_chi', compact('loaiChungChi'));
  }
  public function luuChungChi(Request $request)
  {
    $request->validate([
      'ten_cc' => 'required|string|min:10|max:100|unique:chung_chi,ten_cc',
      'so_hieu' => 'required|string',
      'so_vao_so' => 'required|string',
      'ma_loai_cc' => 'required',
      'ngay_vao_so' => 'required|date',
      'ngay_bat_dau' => 'required|date|before_or_equal:ngay_ket_thuc',
      'ngay_ket_thuc' => 'required|date|after_or_equal:ngay_bat_dau',
    ], [
      'ten_cc.required' => 'Vui lòng nhập tên chứng chỉ.',
      'ten_cc.string' => 'Tên chứng chỉ phải là chuỗi.',
      'ten_cc.min' => 'Tên chứng chỉ phải có ít nhất :min ký tự.',
      'ten_cc.max' => 'Tên chứng chỉ không được vượt quá :max ký tự.',
      'ten_cc.unique' => 'Tên chứng chỉ đã tồn tại.',

      'so_hieu.required' => 'Vui lòng nhập số hiệu.',
      'so_hieu.string' => 'Số hiệu phải là chuỗi.',

      'so_vao_so.required' => 'Vui lòng nhập số vào sổ.',
      'so_vao_so.string' => 'Số vào sổ phải là chuỗi.',

      'ma_loai_cc.required' => 'Vui lòng chọn loại chứng chỉ.',

      'ngay_vao_so.required' => 'Vui lòng chọn ngày vào sổ.',
      'ngay_vao_so.date' => 'Ngày vào sổ không đúng định dạng.',

      'ngay_bat_dau.required' => 'Vui lòng chọn ngày bắt đầu.',
      'ngay_bat_dau.date' => 'Ngày bắt đầu không đúng định dạng.',
      'ngay_bat_dau.before_or_equal' => 'Ngày bắt đầu phải trước hoặc bằng ngày kết thúc',

      'ngay_ket_thuc.required' => 'Vui lòng chọn ngày kết thúc.',
      'ngay_ket_thuc.date' => 'Ngày kết thúc không đúng định dạng.',
      'ngay_ket_thuc.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',
    ]);
    $chungChi = new ChungChi();
    $chungChi->ten_cc = $request->ten_cc;
    $chungChi->so_hieu = $request->so_hieu;
    $chungChi->ma_loai_cc = $request->ma_loai_cc;
    $chungChi->ngay_vao_so = $request->ngay_vao_so;
    $chungChi->so_vao_so = $request->so_vao_so;
    $chungChi->ngay_bat_dau = $request->ngay_bat_dau;
    $chungChi->ngay_ket_thuc = $request->ngay_ket_thuc;
    $chungChi->ngay_tao = now();
    $chungChi->ngay_cap_nhat = now();
    $chungChi->save();
    toastr()->success('Tạo chứng chỉ thành công!', ' ');
    return redirect()->route('quan-ly.chung-chi.danh-sach-chung-chi');
  }
  public function formSuaChungChi(string $ma_cc)
  {
    $loaiChungChi = LoaiChungChi::all();
    $chungChi = ChungChi::with('loaiChungChi')->findOrFail($ma_cc);
    return view('quan_ly.chung_chi.sua_chung_chi', compact('chungChi', 'loaiChungChi'));
  }
  public function suaChungChi(Request $request, string $ma_cc)
  {
    $request->validate([
      'ten_cc' => 'required|string|min:10|max:100|unique:chung_chi,ten_cc,' . $ma_cc . ',ma_cc',
      'so_hieu' => 'required|string',
      'so_vao_so' => 'required|string',
      'ngay_vao_so' => 'required|date',
      'ngay_bat_dau' => 'required|date|before_or_equal:ngay_ket_thuc',
      'ngay_ket_thuc' => 'required|date|after_or_equal:ngay_bat_dau',
    ], [
      'ten_cc.required' => 'Vui lòng nhập tên chứng chỉ.',
      'ten_cc.string' => 'Tên chứng chỉ phải là chuỗi.',
      'ten_cc.min' => 'Tên chứng chỉ phải có ít nhất :min ký tự.',
      'ten_cc.max' => 'Tên chứng chỉ không được vượt quá :max ký tự.',
      'ten_cc.unique' => 'Tên chứng chỉ đã tồn tại.',

      'so_hieu.required' => 'Vui lòng nhập số hiệu.',
      'so_hieu.string' => 'Số hiệu phải là chuỗi.',

      'so_vao_so.required' => 'Vui lòng nhập số vào sổ.',
      'so_vao_so.string' => 'Số vào sổ phải là chuỗi.',

      'ngay_vao_so.required' => 'Vui lòng chọn ngày vào sổ.',
      'ngay_vao_so.date' => 'Ngày vào sổ không đúng định dạng.',

      'ngay_bat_dau.required' => 'Vui lòng chọn ngày bắt đầu.',
      'ngay_bat_dau.date' => 'Ngày bắt đầu không đúng định dạng.',
      'ngay_bat_dau.before_or_equal' => 'Ngày bắt đầu phải trước hoặc bằng ngày kết thúc.',

      'ngay_ket_thuc.required' => 'Vui lòng chọn ngày kết thúc.',
      'ngay_ket_thuc.date' => 'Ngày kết thúc không đúng định dạng.',
      'ngay_ket_thuc.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',
    ]);
    $chungChi = ChungChi::findOrFail($ma_cc);
    $chungChi->ten_cc = $request->ten_cc;
    $chungChi->so_hieu = $request->so_hieu;
    $chungChi->ngay_vao_so = $request->ngay_vao_so;
    $chungChi->so_vao_so = $request->so_vao_so;
    $chungChi->ngay_bat_dau = $request->ngay_bat_dau;
    $chungChi->ngay_ket_thuc = $request->ngay_ket_thuc;
    $chungChi->ngay_cap_nhat = now();
    $chungChi->save();
    toastr()->success('Cập nhật chứng chỉ thành công!', ' ');
    return redirect()->route('quan-ly.chung-chi.danh-sach-chung-chi');
  }
  public function xoaChungChi(string $ma_cc)
  {
    ChungChi::findOrFail($ma_cc)->delete();
    return response()->json(['status' => 'success', 'message' => 'Xóa thành công!']);
  }
}
