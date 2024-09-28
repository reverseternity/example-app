<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showIndex()
    {
        return view('auth.login');
    }
// Модель, которую мы используем, должна наследоваться от класса Authenticable. В config/auth.php : line 65 модель должна быть прописана.
    public function login(LoginRequest $request)
    {
// Примитивный вариант аутентификации. Сначала мы ищем пользователя с телефоном, который есть в БД. Т.к. номер телефона обработан мутатором,
// в LoginController у нас есть функция prepareForValidation(), которая преобразует введенные данные сразу, до валидации. Теперь мы можем
// получить нужный формат телефона для поиска юзера в БД. Если юзер найден ($user в условии if дает true/false), то мы классом Hash и его
// функцией check() - она выдает true/false, сравнивая введенный юзером пароль с захешированным паролем из БД. Если все ок,
// то мы используем класс Auth:: (можно использовать также хелпер auth(), который доступен по всей системе) и вызываем его метод
// login(), который заносит пользователя в текущую сессию и записывает remember_token в БД. Этот токен и есть обозначение сессии.
// в первом аргументе метода передаем экземпляр модели, которая проходит авторизацию, во втором (true/flase) даем ли мы remember_token.
// передачу инфы во второй аргумент можно сделать с помощью чекбокса "запомнить меня" в форме, например. Но у меня по умолчанию true.

        // $user = User::where('phone', $request->input('phone'))->first();
        // if ($user) {
        // if (Hash::check($request->input('password'), $user->password)) {
        // Auth::login($user, true);

        // return redirect()->route('crm');
        // }
// ниже нормальный способ аутентификации))

// Сначала функция находит юзера по введенному телефону. Затем проверяет его поле 'approved'
// если пользователь неодобрен ( approved == false), выведется редирект назад с ошибкой.
        $userFind = User::where('phone', $request->validated('phone'))->first();

        if ($userFind->approved) {
// Вот простой и лаконичный метод attempt() класса Auth, который делает всю работу, написанную выше))
// функция validated() возвращает массив из полей, которые прошли валидацию. По этим данным метод attempt() сам находит экземпляр модели
// и дает ему авторизацию. Так же, как выше второй аргумент - это "Запомнить пользователя". Я делаю автоматически true.
            if (Auth::attempt($request->validated(), true)) {
                return redirect()->route('crm');
            } else {
                // метод withErrors() позволяет передать в маршрут сообщение, которое во вьюхе можно будет вывести с помощью вставки
                // @error('auth_error'){{ $message }}@enderror.
                return redirect()->back()->withErrors(['auth_error' => 'Неверные данные. Проверьте правильность телефона или пароля']);
            }
        } else {
            return redirect()->route('messagePage')->withErrors(['auth_error' => 'Ошибка. Вы сможете войти в систему после одобрения администратором.']);
        }
    }

// Метод logout() класса Auth очистит сессию и пользователь будет разлогинен. Так как для логаута используется метод POST, наша кнопка для
// выхода должна находиться в форме и иметь type="submit" с маршрутом logoutAction.
    public function logout()
    {
        Auth::logout();

        return redirect()->route('index');
    }
}
