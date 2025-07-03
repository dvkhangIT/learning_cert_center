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
    if ($request->user() == null) return redirect()->route('login');
    if ($request->user()->role != 'admin') {
      return redirect()->route('login')->with('error', 'Bạn không có quyền truy cập');
    }
    return $next($request);
  }
}
