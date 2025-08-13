<?php

namespace App\Http\Controllers\quan_ly;

use App\Http\Controllers\Controller;
use App\Models\ChungChi;
use App\Models\HocVien;
use App\Models\KetQua;
use App\Models\KhoaHoc;
use App\Models\LoaiChungChi;
use App\Models\Lop;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ThongKeController extends Controller
{
  public function thongKe()
  {
    $hocVien = HocVien::count();
    $khoaHoc = KhoaHoc::count();
    $lop = Lop::count();
    $chungChi = ChungChi::count();

    $dataCharts = [];
    $loaiChungChis = LoaiChungChi::all();

    foreach ($loaiChungChis as $loai) {
      $startDate = ChungChi::where('ma_loai_cc', $loai->ma_loai_cc)->min('ngay_bat_dau');
      $endDate   = ChungChi::where('ma_loai_cc', $loai->ma_loai_cc)->max('ngay_ket_thuc');

      if (!$startDate || !$endDate) {
        continue;
      }

      $thongKeTrangThai = KetQua::join('chung_chi', 'ket_qua.ma_cc', '=', 'chung_chi.ma_cc')
        ->where('chung_chi.ma_loai_cc', $loai->ma_loai_cc)
        ->whereBetween('chung_chi.ngay_bat_dau', [$startDate, $endDate])
        ->selectRaw("trang_thai, COUNT(*) as so_luong")
        ->groupBy('trang_thai')
        ->pluck('so_luong', 'trang_thai');

      $dat = $thongKeTrangThai['Đạt'] ?? 0;
      $khongDat = $thongKeTrangThai['Không đạt'] ?? 0;

      $dataCharts[] = [
        'id' => 'chart_' . $loai->ma_loai_cc,
        'ten_loai' => $loai->ten_loai_cc,
        'start' => Carbon::parse($startDate)->format('d/m/Y'),
        'end' => Carbon::parse($endDate)->format('d/m/Y'),
        'dat' => $dat,
        'khong_dat' => $khongDat
      ];
    }

    return view('quan_ly.thong_ke', compact(
      'hocVien',
      'khoaHoc',
      'lop',
      'chungChi',
      'dataCharts'
    ));
  }
}
