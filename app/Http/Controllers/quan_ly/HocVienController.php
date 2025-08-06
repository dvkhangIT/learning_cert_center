<?php

namespace App\Http\Controllers\quan_ly;

use App\DataTables\HocVienDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HocVienController extends Controller
{
  public function danhSachHocVien(HocVienDataTable $dataTable)
  {
    return $dataTable->render('quan_ly.hoc_vien.danh_sach_hoc_vien');
  }
}
