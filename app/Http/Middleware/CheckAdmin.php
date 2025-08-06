<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    if ($request->user() == null) return redirect()->route('form-dang-nhap');
    if ($request->user()->vai_tro != 'quanly') {
      return redirect()->route('form-dang-nhap')->with('error', 'Bạn không có quyền truy cập');
    }
    return $next($request);
  }
}
