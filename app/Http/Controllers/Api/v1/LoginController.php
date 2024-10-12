<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\Auth\InvalidCredentialsException;
use App\Exceptions\Auth\NotApprovedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Models\Token;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
// Функционал точно такой же, как в Controllers/Auth/LoginController, но немного изменен. Комментарии можно почитать там
    public function login(LoginRequest $request)
    {
        $userFind = User::wherePhone($request->validated('phone'))->first();

        if ($userFind && $userFind->approved) {
            if (Auth::attempt($request->validated(), true)) {
//// Сначала находятся все токены, принадлежащие аутентифицируемому юзеру, удаляются.
//                Token::where('user_id', Auth::id())->delete();
//// Затем, при логине создается токен с FK-id юзера которому он принадлежит. Сам токен генерируется методом random() вспомогательного класса Str.
//                $token = Token::create([
//                    'user_id' => Auth::id(),
//                    'token' => Str::random(15)
//                ]);
//
//                return response()->json(['token' => $token->token]);

// Ниже мы делаем аутентификацию через laravel sanctum. Токен будет записываться в БД в захешированном виде. Получить его вид для сохранения
// в память можно только из вывода ниже.
                $token = Auth::user()->createToken('api_token');

                return response()->json(['token' => $token->plainTextToken]);
            } else {
//                return response()->json(['message' => 'Неверные данные. Проверьте правильность телефона или пароля'], 401);
//
                throw new InvalidCredentialsException();
            }
        } else {
//            return response()->json(['message' => 'Ошибка. Вы сможете войти в систему после регистрации и одобрения администратором.'], 401);
            throw new NotApprovedException();
        }
    }

// Если пользователь авторизуется несколько раз, например, с нескольких устройств, то при исполнении запроса по методу logout()
// будет удаляться конкретный токен авторизации, который будет передаваться в запрос.
// Важно, чтобы маршрут на логаут проходил через посредник auth:sanctum, иначе не будет доступен метод user() и все вложенные в него методы.
    public function logout()
    {
// При использовании laravel sanctum метод user() доступен через хелпер auth().
        auth()->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Вы вышли из системы']);
    }

}
