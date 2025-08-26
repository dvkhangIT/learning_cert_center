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
use Illuminate\Support\Facades\DB;

class ThongKeController extends Controller
{
  public function thongKe()
  {
    $hocVien = HocVien::count();
    $khoaHoc = KhoaHoc::count();
    $countLop = Lop::count();
    $chungChi = ChungChi::count();
    // $dataCharts = [];
    // $loaiChungChis = LoaiChungChi::all();

    // foreach ($loaiChungChis as $loai) {
    //   $startDate = ChungChi::where('ma_loai_cc', $loai->ma_loai_cc)->min('ngay_bat_dau');
    //   $endDate   = ChungChi::where('ma_loai_cc', $loai->ma_loai_cc)->max('ngay_ket_thuc');

    //   if (!$startDate || !$endDate) {
    //     continue;
    //   }

    //   $thongKeTrangThai = KetQua::join('chung_chi', 'ket_qua.ma_cc', '=', 'chung_chi.ma_cc')
    //     ->where('chung_chi.ma_loai_cc', $loai->ma_loai_cc)
    //     ->whereBetween('chung_chi.ngay_bat_dau', [$startDate, $endDate])
    //     ->selectRaw("trang_thai, COUNT(*) as so_luong")
    //     ->groupBy('trang_thai')
    //     ->pluck('so_luong', 'trang_thai');

    //   $dat = $thongKeTrangThai['Đạt'] ?? 0;
    //   $khongDat = $thongKeTrangThai['Không đạt'] ?? 0;

    //   $dataCharts[] = [
    //     'id' => 'chart_' . $loai->ma_loai_cc,
    //     'ten_loai' => $loai->ten_loai_cc,
    //     'start' => Carbon::parse($startDate)->format('d/m/Y'),
    //     'end' => Carbon::parse($endDate)->format('d/m/Y'),
    //     'dat' => $dat,
    //     'khong_dat' => $khongDat
    //   ];
    // }
    $thongKe = DB::table('ket_qua as kq')
      ->join('hoc_vien as hv', 'kq.ma_hv', '=', 'hv.ma_hv')
      ->join('hoc_vien_lop as hvl', 'hv.ma_hv', '=', 'hvl.ma_hv')
      ->join('lop as l', 'hvl.ma_lop', '=', 'l.ma_lop')
      ->select(
        'l.ten_lop',
        DB::raw("CASE 
                       WHEN (kq.diem_nghe + kq.diem_doc + kq.diem_noi + kq.diem_viet) >= 50 
                       THEN 'Đạt' ELSE 'Không đạt' END as ket_qua"),
        DB::raw('COUNT(*) as so_luong')
      )
      ->groupBy('l.ten_lop', 'ket_qua')
      ->get();

    // Chuẩn hóa dữ liệu cho Chart.js
    $labels = $thongKe->pluck('ten_lop')->unique()->values();
    $datDat = [];
    $datKhongDat = [];

    foreach ($labels as $lop) {
      $datDat[] = $thongKe->where('ten_lop', $lop)->where('ket_qua', 'Đạt')->sum('so_luong');
      $datKhongDat[] = $thongKe->where('ten_lop', $lop)->where('ket_qua', 'Không đạt')->sum('so_luong');
    }
    return view('quan_ly.thong_ke', compact(
      'labels',
      'datDat',
      'datKhongDat',
      'hocVien',
      'khoaHoc',
      'countLop',
      'chungChi'
    ));
    // return view('quan_ly.thong_ke', compact(
    //   'hocVien',
    //   'khoaHoc',
    //   'lop',
    //   'chungChi',
    //   'dataCharts'
    // ));
  }
}
