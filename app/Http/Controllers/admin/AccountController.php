<?php

namespace App\Http\Controllers\admin;

use App\DataTables\TaiKhoanDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
  public function index(TaiKhoanDataTable $dataTables)
  {
    return $dataTables->render('admin.account.index');
  }
}
