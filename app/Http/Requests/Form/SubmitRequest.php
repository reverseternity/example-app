<?php

namespace App\Http\Requests\Form;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubmitRequest extends FormRequest
{
    public function all($keys = null)
    {
        return [
            'title' => $this->input('title'),
            'name' => $this->input('name'),
            'phone' => $this->input('phone'),
            'demand' => $this->input('demand'),
            'date' => $this->input('date'),
            'time' => $this->input('time'),
            'contact' => $this->input('contact'),
            'ip' => $this->ip()
        ];
    }

    // Конвертирует полученный от пользователя номер телефона в подходящий для поиска в БД формат.
    // Удаляет все символы кроме цифр из ввода, затем добавляет + в начало.
    // Скопировано из мутатора phone() из модели Client и переделано.
    public function phoneConvert($value)
    {
        return '+' . preg_replace('/[^0-9]/', '', $value);
    }

    public function rules(): array
    {
        return [
            'title' => ['string', 'max:50'],
            'name' => 'max:30',
            'phone' => ['required', 'min:6', 'max:30'],
            'email' => ['email:rfc,dns', 'min:6', 'max:30'],
            'demand' => 'max:250',
            'date' => 'max:10',
            'time' => 'max:10',
// С помощью метода in() класса Rule создается кастомное правило - ввод должен полностью соответствовать ему.
            'contact' => Rule::in(['personally', 'call', 'videocall']),
            'ip' => 'ip'
        ];
    }
}
