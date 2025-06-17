<?php

namespace App\Http\Middleware;

use App\Models\RegistrationWindow;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRegistrationWindow
{
    public function handle(Request $request, Closure $next): Response
    {
        $activeWindow = RegistrationWindow::where('is_active', true)
            ->where('start_time', '<=', now())
            ->where('end_time', '>=', now())
            ->whereColumn('current_registrations', '<', 'max_registrations')
            ->first();

        if (!$activeWindow) {
            abort(403, 'Nenhuma janela de registro ativa no momento.');
        }

        return $next($request);
    }
}
