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
    // Lấy thống kê Đạt / Không đạt theo lớp dựa vào cột trạng_thai
    $thongKe = DB::table('ket_qua as kq')
      ->join('hoc_vien as hv', 'kq.ma_hv', '=', 'hv.ma_hv')
      ->join('hoc_vien_lop as hvl', 'hv.ma_hv', '=', 'hvl.ma_hv')
      ->join('lop as l', 'hvl.ma_lop', '=', 'l.ma_lop')
      ->select(
        'l.ten_lop',
        'kq.trang_thai',
        DB::raw('COUNT(*) as so_luong')
      )
      ->groupBy('l.ten_lop', 'kq.trang_thai')
      ->get();

    // Chuẩn hóa dữ liệu cho Chart.js
    $labels = $thongKe->pluck('ten_lop')->unique()->values();
    $datDat = [];
    $datKhongDat = [];

    foreach ($labels as $lop) {
      $datDat[] = $thongKe->where('ten_lop', $lop)->where('trang_thai', 'Đạt')->sum('so_luong');
      $datKhongDat[] = $thongKe->where('ten_lop', $lop)->where('trang_thai', 'Không đạt')->sum('so_luong');
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
  }
}
