<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DigitalSignaturesFullAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      if (in_array("digital_signatures_full_access", explode(',', auth()->user()->possibilitys))) {
        return $next($request);
      } else {
        return redirect()->route('home');
      }
    }
}
