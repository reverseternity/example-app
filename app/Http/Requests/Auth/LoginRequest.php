<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    // Laravel docs-Validation-# Preparing Input for Validation
    // С помощью этой функции можно изменить введенные пользователем данные до валидации. В моем случае функция
    // конвертирует полученный от пользователя номер телефона в подходящий для поиска в БД формат.
    // Удаляет все символы кроме цифр из ввода, затем добавляет + в начало.
    // Скопировано из мутатора phone() из модели Client и переделано.
    protected function prepareForValidation(): void
    {
        $phone = $this->request->get('phone');
        $converted = '+' . preg_replace('/[^0-9]/', '', $phone);

        $this->merge([
            'phone' => $converted,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone' => 'required',
            'password' => 'required'
        ];
    }
}
