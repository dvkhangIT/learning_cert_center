<?php

namespace App\Http\Controllers\nhan_vien;

use App\Http\Controllers\Controller;
use App\Models\ChungChi;
use App\Models\KetQua;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ChungChiController extends Controller
{
  public function traCuuForm()
  {
    return view('nhan_vien.chung_chi.tra_cuu');
  }

  public function traCuu(Request $request)
  {
    $request->validate([
      'so_hieu' => 'nullable|string',
      'so_vao_so' => 'nullable|string',
    ]);

    $results = null;
    if ($request->filled('so_hieu') || $request->filled('so_vao_so')) {
      $q = ChungChi::with(['hocVien', 'ketQua', 'loaiChungChi']);
      if ($request->so_hieu) $q->where('so_hieu', $request->so_hieu);
      if ($request->so_vao_so) $q->where('so_vao_so', $request->so_vao_so);
      $results = $q->orderByDesc('ngay_tao')->get();
    }
    return view('nhan_vien.chung_chi.tra_cuu', compact('results'));
  }

  public function capNhatTrangThai(Request $request, string $ma_cc)
  {
    $request->validate([
      'trang_thai' => 'required|in:Đạt,Không đạt,Chưa xét',
    ]);

    $chungChi = ChungChi::with('hocVien')->findOrFail($ma_cc);
    $status = $request->input('trang_thai');

    KetQua::withoutEvents(function () use ($chungChi, $status) {
      $ketQua = KetQua::firstOrNew(['ma_cc' => $chungChi->ma_cc]);
      if (!$ketQua->exists) {
        $ketQua->ma_hv = $chungChi->ma_hv;
        $ketQua->ngay_tao = now();
      }
      $ketQua->trang_thai = $status;
      $ketQua->ngay_cap_nhat = now();
      $ketQua->save();
    });

    return response()->json(['status' => 'success']);
  }

  public function danhSachInChungChi()
  {
    $chungChis = ChungChi::with(['hocVien', 'ketQua', 'loaiChungChi'])
      ->whereHas('ketQua', function($query) {
        $query->where('trang_thai', 'Đạt');
      })
      ->orderBy('ngay_tao', 'desc')
      ->get();
    
    return view('nhan_vien.chung_chi.in_danh_sach', compact('chungChis'));
  }

  public function inChungChi(string $ma_cc)
  {
    $chungChi = ChungChi::with(['hocVien','ketQua','loaiChungChi'])->findOrFail($ma_cc);
    if (!$chungChi->ketQua || ($chungChi->ketQua->trang_thai ?? '') !== 'Đạt') {
      toastr()->error('Chứng chỉ chưa đạt, không thể in.', ' ');
      return redirect()->back();
    }
    
    // Chọn template PDF dựa trên loại chứng chỉ
    $template = $this->getPdfTemplateByLoai($chungChi->loaiChungChi->ten_loai_cc);
    
    $pdf = Pdf::loadView($template, compact('chungChi'));
    return $pdf->stream("chungchi_{$chungChi->so_hieu}.pdf");
  }
  
  private function getPdfTemplateByLoai(string $tenLoaiCC): string
  {
    return match ($tenLoaiCC) {
      'Chứng nhận năng lực tiếng Anh CTUT' => 'user.chung_chi.pdf_tieng_anh_ctut',
      'Chứng nhận năng lực tiếng Anh tương đương bậc 3' => 'user.chung_chi.pdf_tieng_anh_bac3',
      'Chứng nhận năng lực tiếng Nhật tương đương N4' => 'user.chung_chi.pdf_tieng_nhat_n4',
      'Chứng chỉ ứng dụng CNTT cơ bản' => 'user.chung_chi.pdf_cntt_co_ban',
      default => 'user.chung_chi.pdf',
    };
  }
}


