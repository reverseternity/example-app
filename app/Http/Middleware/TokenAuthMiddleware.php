<?php

namespace App\Http\Middleware;

use App\Models\Token;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TokenAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
// Сначала в переменную $token передается заголовок запроса 'Authorization', содержащий токен.
//        $token = $request->header('Authorization');

// Когда мы раотаем с Bearer token, есть специальный метод, похожий на написанное выше. Он очень прост-отрезает значение 'Bearer ' от токена
// и сотавляет только тело токена.
        $token = $request->bearerToken();
// Затем переменная переопределяется - ищется запись в таблице tokens с полем 'token', соответствующая предыдущей переменной $token
// Метод first() выведет экземпляр модели.
        $token = Token::whereToken($token)->first();

        if ($token == null) {
            return response()->json(['message' => 'auth error'], 401);
        }

// Для чего нужен setUser() пока не понял до конца. Предполагаю, этот метод привязывает токен к пользователю для текущей сессии авторизации.
// В аргументе доступ к модели User получается из метода-определителя отношений user() модели Token.
        Auth::setUser($token->user);

        return $next($request);
    }
}
