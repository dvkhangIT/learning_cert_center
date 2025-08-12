<?php

namespace App\Http\Controllers\quan_ly;

use App\DataTables\CnttCoBanDataTable;
use App\DataTables\KetQuaDaXoaDataTable;
use App\DataTables\TiengAnhBac3DataTable;
use App\DataTables\TiengAnhCtutDataTable;
use App\DataTables\TiengNhatN4DataTable;
use App\Http\Controllers\Controller;
use App\Models\KetQua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KetQuaController extends Controller
{
  public function danhSachTiengAnhCtut(TiengAnhCtutDataTable $dataTable)
  {
    $title = 'Kết quả chứng nhận năng lực tiếng Anh CTUT';
    return $dataTable->render('quan_ly.ket_qua.tieng_anh_ctut', compact('title'));
  }
  public function danhSachTiengAnhBac3(TiengAnhBac3DataTable $dataTable)
  {
    $title = 'Kết quả chứng nhận năng lực tiếng anh tương đương bậc 3';
    return $dataTable->render('quan_ly.ket_qua.tieng_anh_bac3', compact('title'));
  }
  public function danhSachTiengNhatN4(TiengNhatN4DataTable $dataTable)
  {
    $title = 'Chứng nhận năng lực tiếng Nhật tương đương N4';
    return $dataTable->render('quan_ly.ket_qua.tieng_anh_bac3', compact('title'));
  }
  public function danhSachCnttCanBan(CnttCoBanDataTable $dataTable)
  {
    $title = 'Chứng chỉ ứng dụng CNTT cơ bản';
    return $dataTable->render('quan_ly.ket_qua.tieng_anh_bac3', compact('title'));
  }
  public function formSuaKetQua(string $ma_kq)
  {
    $ketQua = KetQua::with('chungChi.loaiChungChi')->findOrFail($ma_kq);
    $cacMaDiemCanThiet = $ketQua->chungChi->loaiChungChi->cau_hinh_diem ?? [];
    $danhSachTenDiem = [
      'diem_nghe' => 'Điểm nghe',
      'diem_doc' => 'Điểm đọc',
      'diem_noi' => 'Điểm nói',
      'diem_viet' => 'Điểm viết',
      'diem_tu_vung' => 'Điểm từ vựng',
      'diem_ngu_phap_doc' => 'Điểm ngữ pháp - Đọc',
      'diem_trac_nghiem' => 'Điểm trắc nghiệm',
      'diem_thuc_hanh' => 'Điểm thực hành',
    ];
    $cacLoaiDiem = [];
    foreach ($cacMaDiemCanThiet as $maDiem) {
      if (isset($danhSachTenDiem[$maDiem])) {
        $cacLoaiDiem[$maDiem] = $danhSachTenDiem[$maDiem];
      }
    }
    return view('quan_ly.ket_qua.sua_ket_qua', compact('ketQua', 'cacLoaiDiem'));
  }
  public function suaKetQua(Request $request, string $ma_kq)
  {
    $ketQua = KetQua::findOrFail($ma_kq);
    $rules = [];
    $messages = [];
    $tenLoaiCC = $ketQua->chungChi?->loaiChungChi?->ten_loai_cc;
    switch ($tenLoaiCC) {
      case 'Chứng nhận năng lực tiếng Anh CTUT':
        $rules['diem_nghe'] = 'required|numeric|min:0|max:500';
        $rules['diem_doc'] = 'required|numeric|min:0|max:500';
        $messages = [
          'diem_nghe.required' => 'Vui lòng nhập điểm nghe.',
          'diem_nghe.numeric'  => 'Điểm nghe phải là số.',
          'diem_nghe.min'      => 'Điểm nghe không được nhỏ hơn 0.',
          'diem_nghe.max'      => 'Điểm nghe không được lớn hơn 500.',

          'diem_doc.required'  => 'Vui lòng nhập điểm đọc.',
          'diem_doc.numeric'   => 'Điểm đọc phải là số.',
          'diem_doc.min'       => 'Điểm đọc không được nhỏ hơn 0.',
          'diem_doc.max'       => 'Điểm đọc không được lớn hơn 500.',
        ];
        break;
      case 'Chứng nhận năng lực tiếng Anh tương đương bậc 3':
        $rules['diem_nghe'] = 'required|numeric|min:0|max:10';
        $rules['diem_noi']  = 'required|numeric|min:0|max:10';
        $rules['diem_doc']  = 'required|numeric|min:0|max:10';
        $rules['diem_viet'] = 'required|numeric|min:0|max:10';
        $messages = [
          '*.required' => 'Vui lòng nhập :attribute.',
          '*.numeric'  => ':attribute phải là số.',
          '*.min'      => ':attribute không được nhỏ hơn 0.',
          '*.max'      => ':attribute không được lớn hơn 10.',
        ];
        break;
      case 'Chứng nhận năng lực tiếng Nhật tương đương N4':
        $rules['diem_tu_vung']     = 'required|numeric|min:0|max:60';
        $rules['diem_ngu_phap_doc'] = 'required|numeric|min:0|max:60';
        $rules['diem_nghe']        = 'required|numeric|min:0|max:60';
        $messages = [
          '*.required' => 'Vui lòng nhập :attribute.',
          '*.numeric'  => ':attribute phải là số.',
          '*.min'      => ':attribute không được nhỏ hơn 0.',
          '*.max'      => ':attribute không được lớn hơn 60.',
        ];
        break;
      case 'Chứng chỉ ứng dụng CNTT cơ bản':
        $rules['diem_trac_nghiem'] = 'required|numeric|min:0|max:10';
        $rules['diem_thuc_hanh']   = 'required|numeric|min:0|max:10';
        $messages = [
          '*.required' => 'Vui lòng nhập :attribute.',
          '*.numeric'  => ':attribute phải là số.',
          '*.min'      => ':attribute không được nhỏ hơn 0.',
          '*.max'      => ':attribute không được lớn hơn 10.',
        ];
        break;
    }
    $attributes = [
      'diem_nghe'         => 'điểm nghe',
      'diem_noi'          => 'điểm nói',
      'diem_doc'          => 'điểm đọc',
      'diem_viet'         => 'điểm viết',
      'diem_tu_vung'      => 'điểm từ vựng',
      'diem_ngu_phap_doc' => 'điểm ngữ pháp - đọc hiểu',
      'diem_trac_nghiem'  => 'điểm trắc nghiệm',
      'diem_thuc_hanh'    => 'điểm thực hành',
    ];
    // Validator với thông báo tiếng Việt
    $validator = Validator::make($request->all(), $rules, $messages, $attributes);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }

    $ketQua->update($request->all());

    toastr()->success('Cập nhật thành công!', ' ');
    $redirectRoute = $ketQua->chungChi?->loaiChungChi?->route_name;

    return $redirectRoute
      ? redirect()->route($redirectRoute)
      : redirect()->back();
  }
  public function xoaKetQua(string $ma_kq)
  {
    KetQua::findOrFail($ma_kq)->delete();
    return response()->json(['status' => 'success', 'message' => 'Xóa thành công!']);
  }
  public function danhSachKetQuaDaXoa(KetQuaDaXoaDataTable $dataTable)
  {
    return $dataTable->render('quan_ly.ket_qua.ket_qua_da_xoa');
  }
  public function khoiPhucKetQua(string $ma_kq)
  {
    $ketQua = KetQua::withTrashed()->findOrFail($ma_kq);
    $ketQua->restore();
    toastr()->success('Khôi phục kết quả thành công!', ' ');
    $redirectRoute = $ketQua->chungChi?->loaiChungChi?->route_name;
    return $redirectRoute
      ? redirect()->route($redirectRoute)
      : redirect()->back();
  }
}
