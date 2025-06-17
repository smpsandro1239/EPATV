<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Add this import
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
  public function handle(Request $request, Closure $next, ...$roles): Response
  {
    if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
      abort(403, 'Acesso não autorizado.');
    }
    return $next($request);
  }
}
