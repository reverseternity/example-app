<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientProfileResource extends JsonResource
{
// Правила Здесь точно такие же, как в CrmResource, но немного сложнее - есть поле 'orders', которое является коллекцией, которая вызывается
// методом orders() из нашей модели Client. Метод возвращает полный объект модели Order с ненужными полями, поэтому мы делаем маппинг. По сути,
// можно было бы создать еще один ресурс специально для отображения заказов, куда вынести правила маппинга, но я решил, в этом нет необходимости.
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'id' => $this->id,
            'phone' => $this->phone,
            'email' => $this->email,
            'ip' => $this->ip,
            'orders' => $this->orders->map(function ($order) {
            return [
                'title' => $order->title,
                'id' => $order->id,
                'demand' => $order->demand,
                'date' => $order->date,
                'time' => $order->time,
                'contact' => $order->contact
                ];
            })
        ];
    }
}
