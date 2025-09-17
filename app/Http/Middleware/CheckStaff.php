<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckStaff
{
  public function handle(Request $request, Closure $next): Response
  {
    if ($request->user() == null) {
      return redirect()->route('form-dang-nhap');
    }
    if (! in_array($request->user()->vai_tro, ['nhanvien','quanly'])) {
      return redirect()->route('form-dang-nhap')->with('error', 'Bạn không có quyền truy cập');
    }
    return $next($request);
  }
}
