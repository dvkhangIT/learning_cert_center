<?php

namespace App\Http\Controllers\admin;

use App\DataTables\HocVienDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
  public function index(HocVienDataTable $dataTable)
  {
    return $dataTable->render('admin.hoc_vien.index');
  }
}
