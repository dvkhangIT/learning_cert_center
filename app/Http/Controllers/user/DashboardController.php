<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HocVien;
use App\Models\KhoaHoc;
use App\Models\Lop;
use App\Models\ChungChi;
use App\Models\LoaiChungChi;
use App\Models\KetQua;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // tổng số
        $hocVien = HocVien::count();
        $khoaHoc = KhoaHoc::count();
        $lop = Lop::count();
        $chungChi = ChungChi::count();

        // build dataCharts giống thong_ke view (vd: thống kê 1 tháng)
        $dataCharts = [];
        $start = Carbon::now()->subMonth();
        $end = Carbon::now();

        $loaiList = LoaiChungChi::all();
        foreach ($loaiList as $loai) {
            $dat = KetQua::whereHas('chungChi', function($q) use ($loai) {
                $q->where('ma_loai_cc', $loai->ma_loai_cc);
            })->where('trang_thai', 'Đạt')
              ->whereBetween('ngay_tao', [$start, $end])->count();

            $khong_dat = KetQua::whereHas('chungChi', function($q) use ($loai) {
                $q->where('ma_loai_cc', $loai->ma_loai_cc);
            })->where('trang_thai', 'Không đạt')
              ->whereBetween('ngay_tao', [$start, $end])->count();

            $dataCharts[] = [
                'id' => 'chart_' . $loai->ma_loai_cc,
                'ten_loai' => $loai->ten_loai_cc,
                'start' => $start->format('d/m/Y'),
                'end' => $end->format('d/m/Y'),
                'dat' => $dat,
                'khong_dat' => $khong_dat,
            ];
        }

        return view('user.dashboard', compact('hocVien','khoaHoc','lop','chungChi','dataCharts'));
    }
}
