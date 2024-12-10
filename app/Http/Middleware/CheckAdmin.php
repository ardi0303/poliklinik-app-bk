<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
  public function handle(Request $request, Closure $next)
  {
    if (!session()->has('isAdmin') || session('isAdmin') !== true) {
      return redirect()->route('loginForm')->with('error', 'You must be logged in.');
    }

    return $next($request);
  }
}
