<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
  protected $middleware = [
    // ...
  ];

  protected $middlewareGroups = [
    'web' => [
      \Illuminate\Session\Middleware\StartSession::class,
      \Illuminate\View\Middleware\ShareErrorsFromSession::class,
      \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class, // Corrected
    ],
    'api' => [
      // ...
    ],
  ];

  protected $routeMiddleware = [
    'role' => \App\Http\Middleware\EnsureUserRole::class,
  ];

  protected $middlewarePriority = [
    \Illuminate\Session\Middleware\StartSession::class,
    \Illuminate\View\Middleware\ShareErrorsFromSession::class,
    \App\Http\Middleware\CheckRegistrationWindow::class,
    \App\Http\Middleware\EnsureUserRole::class,
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
    \Illuminate\Auth\Middleware\Authenticate::class,
    \Illuminate\Routing\Middleware\ThrottleRequests::class,
  ];

  protected $middlewareAliases = [
    'check.registration.window' => \App\Http\Middleware\CheckRegistrationWindow::class,
  ];
}
