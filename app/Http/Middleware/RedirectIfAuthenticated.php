<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
  public function handle(Request $request, Closure $next)
  {
    if (session()->has('isAdmin')) {
      return redirect()->route('admin.dashboard');
    }

    if (Auth::guard('dokter')->check()) {
      return redirect()->route('dokter.dashboard');
    }

    if (Auth::guard('pasien')->check()) {
      return redirect()->route('pasien.dashboard');
    }

    return $next($request);
  }
}
