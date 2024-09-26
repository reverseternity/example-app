<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function showIndex()
    {
        return view('auth.register');
    }

    // Функция register(), по сути, просто создает пользователя и записывает его в БД. Механизм точно такой же, как
    // в FormController->createOrder() при добавлении нового клиента.
    public function register(RegisterRequest $request)
    {
//        User::create([
//            'name' => $request->input('name'),
//            'phone' => $request->input('phone'),
//            'password' => $request->input('password'),
//        ]);

        // Вот упрощенный вариант записи выше. метод validated() возвращает массив из полей, которые прошли валидацию.
        // в dd() выглядит это точно так же, как сверху:
        //[▼ // app/Http/Controllers/RegisterController.php:17
        //  "name" => "Алексей"
        //  "phone" => "+7 964 780-32-44"
        //  "password" => "123123123"
        //]
        User::create($request->validated());

        return redirect()->route('index');


    }
}
