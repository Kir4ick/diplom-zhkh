<?php

namespace App\Http\Middlewares;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAuthTypeMiddleware
{
    public function handle(Request $request, \Closure $next)
    {
        if (!$this->isOrchidRoute($request)) {
            Auth::shouldUse('customer');
        }


        return $next($request);
    }

    private function isOrchidRoute(Request $request): bool
    {
        // Проверяем, является ли текущий маршрут частью Orchid
        return $request->is('admin/*') || $request->is('platform/*');
    }
}
