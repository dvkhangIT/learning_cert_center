<?php

namespace App\Http\Controllers\admin;

use App\DataTables\KhoaHocDataTable;
use App\Http\Controllers\Controller;
use App\Models\KhoaHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
  public function index(KhoaHocDataTable $dataTables)
  {
    return $dataTables->render('admin.course.index');
  }
  public function update(Request $request, string $ma_kh)
  {
    $validator = Validator::make($request->all(), [
      'ten_kh' => 'required|max:200|min:5|unique:khoa_hoc,ten_kh,' . $ma_kh . ',ma_kh'
    ], [
      'ten_kh.required' => 'Tên khóa học không được để trống.',
      'ten_kh.max' => 'Tên khóa học không được vượt quá 200 ký tự.',
      'ten_kh.min' => 'Tên khóa học phải có ít nhất 5 ký tự.',
      'ten_kh.unique' => 'Tên khóa học đã tồn tại trong hệ thống.',
    ]);
    if ($validator->passes()) {
      $course = KhoaHoc::findOrFail($ma_kh);
      $course->ten_kh = $request->ten_kh;
      $course->ngay_cap_nhat = now();
      $course->save();
      toastr()->success('Cập nhật thành công.', ' ');
      return response()->json([
        'status' => true,
        'errors' => [],
      ]);
    } else {
      return response()->json([
        'status' => false,
        'errors' => $validator->errors(),
      ]);
    }
  }
}
