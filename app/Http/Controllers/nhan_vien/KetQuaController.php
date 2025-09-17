<?php

namespace App\Http\Controllers\nhan_vien;

use App\DataTables\Staff\TiengAnhCtutDataTable;
use App\DataTables\Staff\TiengAnhBac3DataTable;
use App\DataTables\Staff\TiengNhatN4DataTable;
use App\DataTables\Staff\CnttCoBanDataTable;
use App\Http\Controllers\Controller;
use App\Models\KetQua;
use App\Models\ChungChi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KetQuaController extends Controller
{
  public function danhSachTiengAnhCtut(TiengAnhCtutDataTable $dataTable)
  {
    $title = 'Kết quả chứng nhận năng lực tiếng Anh CTUT';
    return $dataTable->render('nhan_vien.ket_qua.tieng_anh_ctut', compact('title'));
  }

  public function danhSachTiengAnhBac3(TiengAnhBac3DataTable $dataTable)
  {
    $title = 'Kết quả chứng nhận năng lực tiếng anh tương đương bậc 3';
    return $dataTable->render('nhan_vien.ket_qua.tieng_anh_bac3', compact('title'));
  }

  public function danhSachTiengNhatN4(TiengNhatN4DataTable $dataTable)
  {
    $title = 'Chứng nhận năng lực tiếng Nhật tương đương N4';
    return $dataTable->render('nhan_vien.ket_qua.tieng_nhat_n4', compact('title'));
  }

  public function danhSachCnttCanBan(CnttCoBanDataTable $dataTable)
  {
    $title = 'Chứng chỉ ứng dụng CNTT cơ bản';
    return $dataTable->render('nhan_vien.ket_qua.cntt_co_ban', compact('title'));
  }

  public function capNhatTrangThai(Request $request, string $ma_kq)
  {
    $request->validate([
      'trang_thai' => 'required|in:Đạt,Không đạt,Chưa xét',
    ]);

    $status = $request->input('trang_thai');

    KetQua::withoutEvents(function () use ($ma_kq, $status) {
      KetQua::where('ma_kq', $ma_kq)
        ->update([
          'trang_thai' => $status,
          'ngay_cap_nhat' => now(),
        ]);
    });

    return response()->json(['status' => 'success']);
  }

  public function xoaKetQua(string $ma_kq)
  {
    $ketQua = KetQua::findOrFail($ma_kq);
    $ketQua->delete();
    return response()->json(['status' => 'success', 'message' => 'Xóa thành công!']);
  }

  public function formTaoKetQua(string $ma_cc)
  {
    $chungChi = ChungChi::with('loaiChungChi', 'hocVien')->findOrFail($ma_cc);
    
    // Tạo kết quả mới nếu chưa có
    $ketQua = KetQua::firstOrCreate(
      ['ma_cc' => $ma_cc],
      [
        'ma_hv' => $chungChi->ma_hv,
        'trang_thai' => 'Chưa xét',
        'ngay_tao' => now(),
        'ngay_cap_nhat' => now(),
      ]
    );
    
    return $this->formSuaKetQua($ketQua->ma_kq);
  }

  public function formSuaKetQua(string $ma_cc)
  {
    $chungChi = ChungChi::with('loaiChungChi', 'hocVien')->findOrFail($ma_cc);
    
    // Tìm kết quả hiện tại hoặc tạo mới
    $ketQua = KetQua::where('ma_cc', $ma_cc)->first();
    
    if ($ketQua && $this->hasAnyScore($ketQua)) {
      toastr()->error('Nhân viên chỉ được nhập điểm 1 lần!', ' ');
      return redirect()->route($this->getStaffRouteByLoai($chungChi->loaiChungChi?->ten_loai_cc));
    }
    
    $cacMaDiemCanThiet = $chungChi->loaiChungChi->cau_hinh_diem ?? [];
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
    
    // Tạo object ketQua giả để truyền vào view
    if (!$ketQua) {
      $ketQua = new KetQua();
      $ketQua->ma_cc = $ma_cc;
      $ketQua->ma_hv = $chungChi->ma_hv;
      $ketQua->chungChi = $chungChi;
    }
    
    return view('nhan_vien.ket_qua.sua_ket_qua', compact('ketQua', 'cacLoaiDiem'));
  }

  public function suaKetQua(Request $request, string $ma_cc)
  {
    $chungChi = ChungChi::with('loaiChungChi', 'hocVien')->findOrFail($ma_cc);
    
    // Tìm kết quả hiện tại hoặc tạo mới
    $ketQua = KetQua::where('ma_cc', $ma_cc)->first();
    
    if ($ketQua && $this->hasAnyScore($ketQua)) {
      toastr()->error('Nhân viên chỉ được nhập điểm 1 lần!', ' ');
      return redirect()->route($this->getStaffRouteByLoai($chungChi->loaiChungChi?->ten_loai_cc));
    }
    $rules = [];
    $messages = [];
    $tenLoaiCC = $chungChi->loaiChungChi?->ten_loai_cc;
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

    $validator = Validator::make($request->all(), $rules, $messages, $attributes);
    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }

    // Tạo kết quả mới hoặc cập nhật kết quả hiện tại
    if (!$ketQua) {
      $ketQua = new KetQua();
      $ketQua->ma_cc = $ma_cc;
      $ketQua->ma_hv = $chungChi->ma_hv;
      $ketQua->ngay_tao = now();
    }
    
    // Cập nhật điểm số
    $ketQua->fill($request->all());
    
    // Tính trạng thái dựa trên điểm số
    $ketQua->trang_thai = $this->tinhTrangThai($ketQua, $tenLoaiCC);
    $ketQua->ngay_cap_nhat = now();
    
    $ketQua->save();

    toastr()->success('Nhập điểm thành công!', ' ');
    return redirect()->route($this->getStaffRouteByLoai($chungChi->loaiChungChi?->ten_loai_cc));
  }

  private function getStaffRouteByLoai(?string $tenLoaiCC): string
  {
    return match ($tenLoaiCC) {
      'Chứng nhận năng lực tiếng Anh CTUT' => 'nhan-vien.ket-qua.tieng-anh-ctut',
      'Chứng nhận năng lực tiếng Anh tương đương bậc 3' => 'nhan-vien.ket-qua.tieng-anh-bac-3',
      'Chứng nhận năng lực tiếng Nhật tương đương N4' => 'nhan-vien.ket-qua.tieng-nhat-n4',
      'Chứng chỉ ứng dụng CNTT cơ bản' => 'nhan-vien.ket-qua.cntt-co-ban',
      default => 'nhan-vien.ket-qua.tieng-anh-ctut',
    };
  }

  private function hasAnyScore(KetQua $ketQua): bool
  {
    $requiredScoreKeys = $ketQua->chungChi?->loaiChungChi?->cau_hinh_diem ?? [];
    foreach ($requiredScoreKeys as $scoreKey) {
      if (!is_null($ketQua->{$scoreKey})) {
        return true;
      }
    }
    return false;
  }

  private function tinhTrangThai(KetQua $ketQua, string $tenLoaiCC): string
  {
    switch ($tenLoaiCC) {
      case 'Chứng nhận năng lực tiếng Anh CTUT':
        // Tổng điểm >= 600/1000 thì đạt
        $tongDiem = ($ketQua->diem_nghe ?? 0) + ($ketQua->diem_doc ?? 0);
        return $tongDiem >= 600 ? 'Đạt' : 'Không đạt';
        
      case 'Chứng nhận năng lực tiếng Anh tương đương bậc 3':
        // Tất cả điểm >= 5/10 thì đạt
        $diemNghe = $ketQua->diem_nghe ?? 0;
        $diemNoi = $ketQua->diem_noi ?? 0;
        $diemDoc = $ketQua->diem_doc ?? 0;
        $diemViet = $ketQua->diem_viet ?? 0;
        return ($diemNghe >= 5 && $diemNoi >= 5 && $diemDoc >= 5 && $diemViet >= 5) ? 'Đạt' : 'Không đạt';
        
      case 'Chứng nhận năng lực tiếng Nhật tương đương N4':
        // Tổng điểm >= 90/180 thì đạt
        $tongDiem = ($ketQua->diem_tu_vung ?? 0) + ($ketQua->diem_ngu_phap_doc ?? 0) + ($ketQua->diem_nghe ?? 0);
        return $tongDiem >= 90 ? 'Đạt' : 'Không đạt';
        
      case 'Chứng chỉ ứng dụng CNTT cơ bản':
        // Tất cả điểm >= 5/10 thì đạt
        $diemTracNghiem = $ketQua->diem_trac_nghiem ?? 0;
        $diemThucHanh = $ketQua->diem_thuc_hanh ?? 0;
        return ($diemTracNghiem >= 5 && $diemThucHanh >= 5) ? 'Đạt' : 'Không đạt';
        
      default:
        return 'Chưa xét';
    }
  }
}


