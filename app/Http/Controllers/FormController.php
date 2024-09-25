<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Form\SubmitRequest;
use App\Http\Requests\Form\UpdateRequest;


class FormController extends Controller
{
    public function createOrder(SubmitRequest $request): RedirectResponse
    {
        // Конвертирует полученный от пользователя номер телефона в подходящий для поиска в БД формат.
        // phoneConvert() - мой собственный метод внутри реквеста SubmitRequest.
        $phone = $request->phoneConvert($request->input('phone'));
        // Проверяет, есть ли в БД юзер с номером телефона из переменной выше и делает вызов
        // экземпляра модели User для дальнейшего взаимодействия внутри метода. Нельзя назвать переменную
        // привычным именем $user, потому что это имя используется дальше в ветке else.
        // метод first() вызывает конкретную запись для взаимодействия, в отличие от get(), который выводит
        // все записи из таблицы этой модели
        $userFind = User::where('phone', $phone)->first();


        //Если в переменной userFind есть экземпляр (он нашелся по номеру телефона), то данные обновляются
        // по образу и подобию метода updateUser() ниже. Получилось использовать не полную копию - поле
        // 'user_id' получает id уже существующей записи, найденной в БД, а не нового созданного юзера
        // как в ветке else.
        if ($userFind !== null) {

            $userFind->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'ip' => $request->ip()
            ]);

            // Создается новый заказ, где в поле 'user_id' заносится id-шник из найденной в БД записи.
            $order = Order::create([
                'user_id' => $userFind->id,
                'title' => $request->input('title'),
                'demand' => $request->input('demand'),
                'date' => $request->input('date'),
                'time' => $request->input('time'),
                'contact' => $request->input('contact'),
            ]);

        } else {

            // Если номер телефона оказался уникален, то создается новый юзер методом create
            $user = User::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'ip' => $request->ip()
            ]);

            // Создается и новый заказ, привязанный к свеже-созданному прямо выше юзеру.
            $order = Order::create([
                'user_id' => $user->id,
                'title' => $request->input('title'),
                'demand' => $request->input('demand'),
                'date' => $request->input('date'),
                'time' => $request->input('time'),
                'contact' => $request->input('contact'),
            ]);

        }

        return redirect()->route('index');
    }

    public function updateUser(UpdateRequest $request, User $userId): RedirectResponse
    {
        $userId->update([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email')
        ]);

        return redirect()->route('userProfile', $userId);
    }

    public function deleteUser(User $userId): RedirectResponse
    {
        $userId->delete();
        return redirect()->route('crm');
    }
}
