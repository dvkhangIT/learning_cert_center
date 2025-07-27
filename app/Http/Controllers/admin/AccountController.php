<?php

namespace App\Http\Controllers\admin;

use App\DataTables\TaiKhoanDataTable;
use App\Http\Controllers\Controller;
use App\Mail\SendPasswordMail;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Str;

class AccountController extends Controller
{
  public function index(TaiKhoanDataTable $dataTables)
  {
    return $dataTables->render('admin.account.index');
  }
  public function create()
  {
    return view('admin.account.create');
  }
  public function store(Request $request)
  {
    $request->validate([
      'ho_ten' => 'required|string|max:255',
      'email' => 'required|email|unique:tai_khoan,email',
    ], [
      'ho_ten.required' => 'Vui lòng nhập họ và tên.',
      'ho_ten.string' => 'Họ và tên phải là chuỗi ký tự.',
      'ho_ten.max' => 'Họ và tên không được vượt quá 255 ký tự.',

      'email.required' => 'Vui lòng nhập email.',
      'email.email' => 'Email không hợp lệ.',
      'email.unique' => 'Email này đã được sử dụng.',
    ]);

    $password = Str::random(8);
    $user = new TaiKhoan();
    $user->ho_ten = $request->ho_ten;
    $user->email = $request->email;
    $user->vai_tro = 'nhanvien';
    $user->trang_thai = 1;
    $user->mat_khau = Hash::make($password);
    $user->save();

    Mail::to($user->email)->send(new SendPasswordMail($user->ho_ten, $password, $user->email));
    flasher('Tài khoản đã được tạo và gửi mật khẩu qua email.',)->setTitle(' ');
    return back();
  }
}
