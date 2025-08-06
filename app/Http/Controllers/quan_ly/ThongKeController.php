<?php

namespace App\Http\Controllers\quan_ly;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThongKeController extends Controller
{
  public function trangChu()
  {
    return view('quan_ly.trang_chu');
  }
}
