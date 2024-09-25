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
        return false;
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
            'phone' => ['required', 'min:6', 'max:30'],
            // Правило 'confirmed' работает классно. Оно проверяет совпадение поля {имя поля}_confirmed с
            // основным password. {имя поля} должно совпадать с основным.
            'password' => ['required', 'min:6', 'max:30', 'confirmed']

        ];
    }
}
