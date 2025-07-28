<?php

namespace App\Http\Controllers\admin;

use App\DataTables\TaiKhoanDataTable;
use App\Http\Controllers\Controller;
use App\Mail\SendPasswordMail;
use App\Mail\SendResetPasswordMail;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Str;
use Carbon\Carbon;

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
    $user->ngay_tao = now();
    $user->save();

    Mail::to($user->email)->send(new SendPasswordMail($user->ho_ten, $password, $user->email));
    flasher('Tài khoản đã được tạo và gửi mật khẩu qua email.',)->setTitle(' ');
    return back();
  }
  public function edit(string $ma_tk)
  {
    $user = TaiKhoan::findOrFail($ma_tk);
    return view('admin.account.edit', compact('user'));
  }
  public function update(Request $request, string $ma_tk)
  {
    $request->validate([
      'ho_ten' => 'required|string|max:255',
      'email' => 'required|email|unique:tai_khoan,email,' . $ma_tk . ',ma_tk'
    ], [
      'ho_ten.required' => 'Vui lòng nhập họ và tên.',
      'ho_ten.string' => 'Họ và tên phải là chuỗi ký tự.',
      'ho_ten.max' => 'Họ và tên không được vượt quá 255 ký tự.',

      'email.required' => 'Vui lòng nhập email.',
      'email.email' => 'Email không hợp lệ.',
      'email.unique' => 'Email này đã được sử dụng.',
    ]);

    $user =  TaiKhoan::findOrFail($ma_tk);
    $user->ho_ten = $request->ho_ten;
    $user->email = $request->email;
    $user->ngay_cap_nhat = now();
    $user->save();

    flasher('Cập nhật thông tin thành công.',)->setTitle(' ');
    return redirect()->route('admin.account.index');
  }
  public function destroy(string $ma_tk)
  {
    $user = TaiKhoan::findOrFail($ma_tk);
    $user->delete();
    return response()->json(['status' => 'success', 'message' => 'Xóa thành công!']);
  }
  public function changeStatus(Request $request)
  {
    $user = TaiKhoan::findOrFail($request->ma_tk);
    $user->trang_thai = $request->trang_thai == 'true' ? '1' : '0';
    $user->save();
    return response()->json(['message' => 'Cập nhật thành công!']);
  }
  public function resetPassword(string $ma_tk)
  {
    $user = TaiKhoan::findOrFail($ma_tk);
    $password = Str::random(8);
    $user->mat_khau = Hash::make($password);
    $user->save();
    Mail::to($user->email)->send(new SendResetPasswordMail($user->ho_ten, $password, $user->email));
    return response()->json(['status' => 'success', 'message' => 'Mật khẩu mới đã gửi qua email.']);
  }
}
