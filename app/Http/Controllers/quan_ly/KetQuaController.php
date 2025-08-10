<?php

namespace App\Http\Controllers\quan_ly;

use App\DataTables\CnttCoBanDataTable;
use App\DataTables\TiengAnhBac3DataTable;
use App\DataTables\TiengAnhCtutDataTable;
use App\DataTables\TiengNhatN4DataTable;
use App\Http\Controllers\Controller;
use App\Models\KetQua;
use Illuminate\Http\Request;

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
      // Kiểm tra xem mã điểm có tồn tại trong danh sách tên không
      if (isset($danhSachTenDiem[$maDiem])) {
        // Tạo một mảng mới với key là mã điểm và value là tên hiển thị
        $cacLoaiDiem[$maDiem] = $danhSachTenDiem[$maDiem];
      }
    }
    // return view('ketqua.edit', [
    //   'ketQua' => $ketQua,
    //   'cacLoaiDiem' => $cacLoaiDiemDeHienThi,
    // ]);
    // dd($cacLoaiDiem);
    return view('quan_ly.ket_qua.sua_ket_qua', compact('ketQua', 'cacLoaiDiem'));
  }
  public function suaKetQua(Request $request, string $ma_kq)
  {
    $request->validate([
      'diem_nghe' => 'numeric|min:0',
      'diem_noi' => 'numeric|min:0',
      'diem_doc' => 'numeric|min:0',
      'diem_viet' => 'numeric|min:0',
      'diem_tu_vung' => 'numeric|min:0',
      'diem_ngu_phap_doc' => 'numeric|min:0',
      'diem_trac_nghiem' => 'numeric|min:0',
      'diem_thuc_hanh' => 'numeric|min:0',
    ]);
    $ketQua = KetQua::findOrFail($ma_kq);
    $ketQua->update($request->all());
    $ketQua->trang_thai;
    $redirectRoute = $ketQua->chungChi?->loaiChungChi?->route_name;
    toastr()->success('Cập nhật thành công!', ' ');
    if (!$redirectRoute) {
      return redirect()->back();
    }
    return redirect()->route($redirectRoute);
  }
}
