<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserProfileResource;
use App\Http\Resources\Api\ClientProfileResource;
use App\Http\Resources\Api\CrmResource;
use App\Models\User;
use App\Models\Client;
use App\Http\Requests\Api\UpdateRequest;

// Когда мы работаем с api, нам нужно отправлять json на выводе, т.к. это наиболее универсальный формат.
// Если на выводе функции мы будем возвращать массив, то laravel автоматически применяет фуккцию-хелпер json_encode().
class StaffController extends Controller
{
    public function showUserProfile() {
// Комментарий, объясняющий работу ресурсов в методах ниже
// из хелпера auth() всегда можно получить экземпляр модели user(), к которому относится токен,
// передаваемый в каждом запросе, маршрут которого требует авторизацию.
        $user = auth()->user();

        return new UserProfileResource($user);
    }

    public function showCrm()
    {
// Здесь мы формируем вывод json-массива для отправки на фронтенд. Сначала формируем экземпляр модели со всеми записями с сортировкой,
// прямо как в StaffController->showCrm. Затем создаем пустую переменную-счетчик с массивом, куда по мере цикла будем добавлять данные
//с записей экземпляра модели.
//        $clients = Client::all()->sortByDesc('id');

//        foreach ($clients as $client) {
//            $data = [
//                'id' => $client->id,
//                'name' => $client->name,
//                'phone' => $client->phone,
//                'email' => $client->email,
//            ];
//        }
//        return $data;

// Ниже немного более сложный в логике, но более эффективный по затратам выч. ресурсов и простой код. Мы обращаемся к методу query().
//Интерфейс похож на обычный sql-запрос. Выводим только те данные, которые нужны, получаем их методом get() и сортируем по убыванию по id.
//        $clients = Client::query()
//            ->select('id', 'name', 'phone', 'email')
//            ->get()
//            ->sortByDesc('id');

// Ниже мы будем использовать ресурс. Ресурс-это класс, который форматирует вывод по типу функции-хелпера map(). Правила вывода описаны в
// app/Http/Resources/CrmResource. Его метод Collection() перебирает все записи вызванной модели и выводит данные как коллекцию массивов по
// описанным в нем правилам-делает мапинг.
        $clients = Client::all()->sortByDesc('id');

        return CrmResource::collection($clients);
    }

// Здесь мы используем dependency injection, Поэтому нам не нужно вызывать экземпляр модели в коде. За нас это делает laravel.
// В этой функции в аргументах мы указываем Модель и переменную, которая будет её представлять. Если в функцию передается числовой
// аргумент, laravel сам создает экземпляр модели и ищет её запись по id, переданному в аргументе. Внутри переменной в коде функции
// будет доступна запись по найденному id. Её поля мы выводим и на выходе получим json-массив со всей нужной инфой.
    public function showClientProfile (Client $clientId)
    {
// В этом выражении мы применяем функцию map(). В её аргументе внутренняя переменная, в которой находится запись модели.
// С помощью этой функции можно переназначить имя полям или отсеить ненужные поля.
//        $orders = $clientId->orders->map(function ($order) {
//            return [
//                'title' => $order->title,
//                'id' => $order->id,
//                'demand' => $order->demand,
//                'date' => $order->date,
//                'time' => $order->time,
//                'contact' => $order->contact,
//            ];
//        });
//        return response()->json([
//                'name' => $clientId->name,
//                'id' => $clientId->id,
//                'phone' => $clientId->phone,
//                'email' => $clientId->email,
//                'ip' => $clientId->ip,
//                'orders' => $orders,
//            ], 200);

// В случае, если нам нужно вернуть не коллекцию, а одну запись, нам нужно вызвать экземпляр класса ресурса не статическим методом и передать
// в аргументах экземпляр модели.
        return new ClientProfileResource($clientId);
    }

    public function updateClient(UpdateRequest $request, Client $clientId)
    {
        $clientId->update([
//            'name' => $request->input('name'),
//            'phone' => $request->input('phone'),
//            'email' => $request->input('email')
        $request->validated()
        ]);

        return response()->json($this->showClientProfile($clientId), 200);
    }

    public function deleteClient(Client $clientId)
    {
// Метод delete() возвращает boolean-значение: true или false.
        return ['deleted' => $clientId->delete()];
    }
}
