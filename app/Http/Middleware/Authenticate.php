<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
// Здесь мы ставим условие - Если в префиксе маршрута есть 'api', то вывод функции меняется на другой редирект.
        if (str_contains($request->route()->getPrefix(), 'api')) {
//            return response()->json(['message' => 'No acess. User should be authorised'], 403);
            return $request->expectsJson() ? null : route('loginForm');
        }

        return $request->expectsJson() ? null : route('loginForm');
    }
}
