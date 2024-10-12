<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SubmitRequest;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;

class FormController extends Controller
{
    public function createOrder(SubmitRequest $request)
    {
// Конвертирует полученный от пользователя номер телефона в подходящий для поиска в БД формат.
// phoneConvert() - мой собственный метод внутри реквеста SubmitRequest.
        $phone = $request->phoneConvert($request->input('phone'));
// Проверяет, есть ли в БД юзер с номером телефона из переменной выше и делает вызов
// экземпляра модели Client для дальнейшего взаимодействия внутри метода. Нельзя назвать переменную
// привычным именем $client, потому что это имя используется дальше в ветке else.
// метод first() вызывает конкретную запись для взаимодействия, в отличие от get(), который выводит
// все записи из таблицы этой модели
        $clientFind = Client::where('phone', $phone)->first();

//Если в переменной clientFind есть экземпляр (он нашелся по номеру телефона), то данные обновляются
// по образу и подобию метода updateClient() ниже. Получилось использовать не полную копию - поле
// 'client_id' получает id уже существующей записи, найденной в БД, а не нового созданного юзера
// как в ветке else.
        if ($clientFind !== null) {

            $clientFind->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'ip' => $request->ip()
            ]);

// Создается новый заказ, где в поле 'client_id' заносится id-шник из найденной в БД записи.
            $order = Order::create([
                'client_id' => $clientFind->id,
                'title' => $request->input('title'),
                'demand' => $request->input('demand'),
                'date' => $request->input('date'),
                'time' => $request->input('time'),
                'contact' => $request->input('contact'),
            ]);
// Вместо указания http-кода в аргументах к методу json(), можно вызвать отдельно метод setStatusCode(), в котором можно передать не только
// код, но и кастомный ответ.
            return response()->json([$clientFind, $order])->setStatusCode(201, 'Client updated. Order created');

        } else {
            // Если номер телефона оказался уникален, то создается новый юзер методом create
            $client = Client::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'ip' => $request->ip()
            ]);

// Создается и новый заказ, привязанный к свеже-созданному прямо выше юзеру.
            $order = Order::create([
                'client_id' => $client->id,
                'title' => $request->input('title'),
                'demand' => $request->input('demand'),
                'date' => $request->input('date'),
                'time' => $request->input('time'),
                'contact' => $request->input('contact'),
            ]);
            return response()->json([$client, $order])->setStatusCode(201, 'Client created. Order created');
        }
// В оригинале для маршрутов web у меня используется редирект на главную страницу. Но Учитель в туторе сказал, что фронтенд-разрабу может
// потребоваться увидеть объект, который создался. В контексте его приложения это логично, в контексте моего - нет. Посмотрим что будет дальше.
//        return redirect()->route('api.clientProfile', $clientFind->id);
    }
}
