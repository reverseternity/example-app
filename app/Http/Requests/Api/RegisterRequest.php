<?php

namespace App\Http\Requests\Api;

class RegisterRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $phone = $this->request->get('phone');
        $converted = '+' . preg_replace('/[^0-9]/', '', $phone);

        $this->merge([
            'phone' => $converted,
        ]);
    }

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
