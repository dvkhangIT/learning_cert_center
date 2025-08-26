<?php

namespace App\Http\Controllers;

use App\Mail\SendForgotPasswordMail;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Str;

class TaiKhoanController extends Controller
{
  public function formDangNhap()
  {
    return view('tai_khoan.dang_nhap');
  }
  public function dangNhap(Request $request)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'email' => 'required|email',
        'mat_khau' => 'required'
      ],
      [
        'email.required' => 'Vui lòng nhập địa chỉ email.',
        'email.email' => 'Địa chỉ email không hợp lệ.',
        'mat_khau.required' => 'Vui lòng nhập mật khẩu.'
      ]
    );
    if ($validator->passes()) {
      if (Auth::attempt(['email' => $request->email, 'password' => $request->mat_khau, 'trang_thai' => 1])) {
        $vai_tro = Auth::user()->vai_tro;
        if ($vai_tro === 'quanly') {
          toastr()->success('Đăng nhập thành cônng!', ' ');
          return redirect()->route('quan-ly.tong-quan');
        } else {
          toastr()->success('Đăng nhập thành cônng!', ' ');
          return redirect()->route('user.dashboard');
        }
      } else {
        toastr()->error('Tài khoản, mật khẩu không đúng hoặc tài khoản đã bị khóa!', ' ');
        return redirect()->route('form-dang-nhap');
      }
    } else {
      return redirect()->route('form-dang-nhap')->withInput()->withErrors($validator);
    }
  }
  public function dangXuat()
  {
    Auth::logout();
    return redirect()->route('form-dang-nhap');
  }
  public function formQuenMatKhau()
  {
    return view('tai_khoan.quen_mat_khau');
  }
  public function quenMatKhau(Request $request)
  { //
    $request->validate([
      'email' => 'required|email|exists:tai_khoan,email'
    ], [
      'email.required' => 'Vui lòng nhập địa chỉ email.',
      'email.email' => 'Địa chỉ email không hợp lệ.',
      'email.exists' => 'Email không tồn tại trong hệ thống.'
    ]);

    $user = TaiKhoan::where('email', $request->email)->firstOrFail();
    $token = Str::random(64);
    DB::table('password_reset_tokens')->updateOrInsert(
      ['email' => $request->email],
      ['token' => $token, 'created_at' => Carbon::now()]
    );
    Mail::to($request->email)->send(new SendForgotPasswordMail($user->ho_ten, $user->email, $token));
    toastr()->success('Vui lòng kiểm tra email.', ' ');
    return redirect()->route('form-dang-nhap');
  }
  public function formKhoiPhucMatKhau(string $tokenString)
  {
    $token = DB::table('password_reset_tokens')
      ->where('token', $tokenString)
      ->first();
    if (!$token) {
      abort(404);
    }
    return view('tai_khoan.khoi_phuc_mat_khau', compact('tokenString'));
  }
  public function khoiPhucMatKhau(Request $request)
  {
    $request->validate([
      'new_password' => 'required|min:8',
      'confirm_password' => 'required|same:new_password'
    ], [
      'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
      'new_password.min' => 'Mật khẩu mới phải có ít nhất :min ký tự.',
      'confirm_password.required' => 'Vui lòng xác nhận mật khẩu.',
      'confirm_password.same' => 'Mật khẩu xác nhận không khớp với mật khẩu mới.'
    ]);
    $token = DB::table('password_reset_tokens')
      ->where('token', $request->token)
      ->first();
    if (!$token) {
      toastr()->error('Liên kết không hợp lệ.', ' ');
      return redirect()->route('form-quen-mat-khau');
    }
    if (!$token->email) {
      toastr()->error('Email không hợp lệ.', ' ');
      return redirect()->route('form-quen-mat-khau');
    }
    if (Carbon::parse($token->created_at)->addMinutes(1)->isPast()) {
      DB::table('password_reset_tokens')->where('email', $token->email)->delete();
      toastr()->error('Liên kết đã hết hạn.', ' ');
      return back();
    }
    $user = TaiKhoan::where('email', $token->email)->firstOrFail();
    $user->mat_khau = Hash::make($request->new_password);
    $user->save();
    DB::table('password_reset_tokens')->where('email', $token->email)->delete();
    toastr()->success('Mật khẩu được thay đổi thành công.', ' ');
    return redirect()->route('dang-nhap');
  }
  public function thongtinTaiKhoan()
  {
    $user = Auth::user();
    return view('tai_khoan.thong_tin_tai_khoan', compact('user'));
  }
  public function luuMatKhau(Request $request)
  {
    $request->validate([
      'current_password' => ['required'],
      'new_password' => ['required', 'min:8', 'confirmed'],
    ], [
      'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại.',
      'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
      'new_password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
      'new_password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
    ]);
    if (!Hash::check($request->current_password, Auth::user()->mat_khau)) {
      toastr()->error('Mật khẩu hiện tại không chính xác.', ' ');
    }
    $taiKhoan = Auth()->user();
    $taiKhoan->mat_khau = Hash::make($request->new_password);
    $taiKhoan->ngay_cap_nhat = now();
    $taiKhoan->save();
    toastr()->success('Đổi mật khẩu thành công!', ' ');
    return redirect()->route('quan-ly.tong-quan');
  }
  public function capNhatThongtinTaiKhoan(Request $request, string $ma_tk)
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
    toastr()->success('Cập nhật thông tin thành công.', ' ');
    return redirect()->back();
  }
}
