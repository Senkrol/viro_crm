<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class redirectUser
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next, $guard = null): Response
  {

    if (Auth::guard($guard)->check()) {
      if (Auth::user()->is_admin  == 1) {
        return redirect()->route('admin.dashboard');
      }

      if (Auth::user()->is_admin  != 1) {
        return $next($request);
      }
      
    }
    return redirect()->route('home');

    //return $next($request);
  }
}
