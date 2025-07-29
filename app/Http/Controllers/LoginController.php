<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Mail\SendForgotPasswordMail;
use App\Models\TaiKhoan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Str;

class LoginController extends Controller
{
  public function index()
  {
    return view('auth.login');
  }
  public function authenticate(Request $request)
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
      if (Auth::attempt(['email' => $request->email, 'password' => $request->mat_khau])) {
        $vai_tro = Auth::user()->vai_tro;
        if ($vai_tro === 'quanly') {
          return redirect()->route('admin.dashboard');
        } else {
          return redirect()->route('user.dashboard');
        }
      } else {
        return redirect()->route('login')->with('error', 'Tài khoản hoặc mật khẩu không đúng!');
      }
    } else {
      return redirect()->route('login')->withInput()->withErrors($validator);
    }
  }
  public function register(Request $request)
  {
    return view('register');
  }
  public function processRegister(Request $request)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed'
      ]
    );
    if ($validator->passes()) {
      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->role = 'user';
      $user->password = Hash::make($request->password);
      $user->save();
      return redirect()->route('login')->with('success', 'You have register successfully!');
    } else {
      return redirect()->route('register')->withInput()->withErrors($validator);
    }
  }
  public function logout()
  {
    Auth::logout();
    return redirect()->route('login');
  }
  public function forgotPassword()
  {
    return view('auth.forgot-password');
  }
  public function forgotPasswordProcess(Request $request)
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
    flasher('Vui lòng kiểm tra email.',)->setTitle(' ');
    return redirect()->route('login');
  }
  public function resetPassword(string $tokenString)
  {
    $token = DB::table('password_reset_tokens')
      ->where('token', $tokenString)
      ->first();
    if (!$token) {
      abort(404);
    }
    return view('auth.reset-password', compact('tokenString'));
  }
  public function processResestPassword(Request $request)
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
      flasher('Liên kết không hợp lệ.', 'error')->setTitle(' ');
      return redirect()->route('forgot.password');
    }
    if (!$token->email) {
      flasher('Email không hợp lệ.', 'error')->setTitle(' ');
      return redirect()->route('forgot.password');
    }
    if (Carbon::parse($token->created_at)->addMinutes(1)->isPast()) {
      DB::table('password_reset_tokens')->where('email', $token->email)->delete();
      flasher('Liên kết đã hết hạn.', 'error')->setTitle(' ');
      return back();
    }
    $user = TaiKhoan::where('email', $token->email)->firstOrFail();
    $user->mat_khau = Hash::make($request->new_password);
    $user->save();
    DB::table('password_reset_tokens')->where('email', $token->email)->delete();
    flasher('Mật khẩu được thay đổi thành công.', 'success')->setTitle(' ');
    return redirect()->route('login');
  }
}
