<?php

namespace App\Http\Controllers\admin;

use App\DataTables\LopDataTable;
use App\Http\Controllers\Controller;
use App\Models\KhoaHoc;
use App\Models\Lop;
use Illuminate\Http\Request;

class ClassController extends Controller
{
  public function index(LopDataTable $dataTables)
  {
    return $dataTables->render('admin.class.index');
  }
  public function edit($ma_lop)
  {
    $courses = KhoaHoc::all();
    $class = Lop::findOrFail($ma_lop);
    return view('admin.class.edit', compact('class', 'courses'));
  }
  public function update(Request $request, string $ma_lop)
  {
    $request->validate([
      'ten_lop' => 'required|min:5|max:200|unique:lop,ten_lop,' . $ma_lop . ',ma_lop',
      'ma_kh' => 'required',
      'ngay_bat_dau' => 'required|date',
      'ngay_ket_thuc' => 'required|date|after_or_equal:ngay_bat_dau',
    ], [
      'ten_lop.required' => 'Tên lớp không được để trống.',
      'ten_lop.min' => 'Tên lớp phải có ít nhất :min ký tự.',
      'ten_lop.max' => 'Tên lớp không được vượt quá :max ký tự.',
      'ten_lop.unique' => 'Tên lớp đã tồn tại.',
      'ma_kh.required' => 'Vui lòng chọn khóa học.',
      'ngay_bat_dau.required' => 'Vui lòng chọn ngày bắt đầu.',
      'ngay_bat_dau.date' => 'Ngày bắt đầu không hợp lệ.',
      'ngay_ket_thuc.required' => 'Vui lòng chọn ngày kết thúc.',
      'ngay_ket_thuc.date' => 'Ngày kết thúc không hợp lệ.',
      'ngay_ket_thuc.after_or_equal' => 'Ngày kết thúc phải bằng hoặc sau ngày bắt đầu.',
    ]);

    $class = Lop::findOrFail($ma_lop);
    $class->ten_lop = $request->ten_lop;
    $class->ma_kh = $request->ma_kh;
    $class->ngay_bat_dau = $request->ngay_bat_dau;
    $class->ngay_ket_thuc = $request->ngay_ket_thuc;
    $class->ngay_cap_nhat = now();
    $class->save();
    toastr()->success('Cập nhật thành công!', ' ');
    return redirect()->route('admin.class.index');
  }
  public function destroy($ma_lop)
  {
    $class = Lop::findOrFail($ma_lop);
    $class->delete();
    return response()->json(['status' => 'success', 'message' => 'Xóa thành công!']);
  }
  public function create()
  {
    $courses = KhoaHoc::all();
    return view('admin.class.create', compact('courses'));
  }
  public function store(Request $request)
  {
    $request->validate([
      'ten_lop' => 'required|min:5|max:200|unique:lop,ten_lop',
      'ma_kh' => 'required',
      'ngay_bat_dau' => 'required|date',
      'ngay_ket_thuc' => 'required|date|after_or_equal:ngay_bat_dau',
    ], [
      'ten_lop.required' => 'Tên lớp không được để trống.',
      'ten_lop.min' => 'Tên lớp phải có ít nhất :min ký tự.',
      'ten_lop.max' => 'Tên lớp không được vượt quá :max ký tự.',
      'ten_lop.unique' => 'Tên lớp đã tồn tại.',
      'ma_kh.required' => 'Vui lòng chọn khóa học.',
      'ngay_bat_dau.required' => 'Vui lòng chọn ngày bắt đầu.',
      'ngay_bat_dau.date' => 'Ngày bắt đầu không hợp lệ.',
      'ngay_ket_thuc.required' => 'Vui lòng chọn ngày kết thúc.',
      'ngay_ket_thuc.date' => 'Ngày kết thúc không hợp lệ.',
      'ngay_ket_thuc.after_or_equal' => 'Ngày kết thúc phải bằng hoặc sau ngày bắt đầu.',
    ]);

    $class = new Lop();
    $class->ten_lop = $request->ten_lop;
    $class->ma_kh = $request->ma_kh;
    $class->ngay_bat_dau = $request->ngay_bat_dau;
    $class->ngay_ket_thuc = $request->ngay_ket_thuc;
    $class->ngay_cap_nhat = now();
    $class->save();
    toastr()->success('Tạo lớp thành công!', ' ');
    return redirect()->route('admin.class.index');
  }
}
