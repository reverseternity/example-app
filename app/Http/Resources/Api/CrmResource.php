<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CrmResource extends JsonResource
{
// Если при вызове ресурса в аргумент функции collection() мы передаем экземпляр модели, то обращаться к её полям можно через внутреннюю
// переменную $this. Для того, чтобы в выводе избавиться от json-обертки "data":[], в app/Providers/AppServiceProvider->boot нужно вызвать
// объект нашего ресурса и его метод withoutWrapping().
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email
        ];
    }
}
