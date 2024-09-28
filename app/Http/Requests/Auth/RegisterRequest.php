<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    // Laravel docs-Validation-# Preparing Input for Validation
    // Так как записи в БД у меня обработаны мутатором, введенные пользователем в форму данные могут не совпадать с БД - из-за этого валидация
    // 'unique' не работает. Поэтому здесь используется функция prepareForValidation.
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
            'name' => ['required', 'max:30'],
            // правило валидации 'unique:{имя таблицы},{имя поля}' работает интуитивно - оно проверяет уникальность вводимых данных
            // в указанной таблице и её поле. Была проблема - правило проверяет введённые данные с содержанием записи в БД.
            // А записи в БД обработаны мутатором и могут не совпадать с тем, что ввел пользователь при регистрации.
            // Для этого используется функция prepareForValidation() выше.
            'phone' => ['required', 'min:6', 'max:30', 'unique:users,phone'],
            // Правило 'confirmed' работает классно. Оно проверяет совпадение поля {имя поля}_confirmed с
            // основным password. {имя поля} должно совпадать с основным.
            'password' => ['required', 'min:6', 'max:30', 'confirmed']

        ];
    }
}
