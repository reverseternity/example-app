<?php

namespace App\Http\Requests\Form;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'max:30',
            'phone' => ['required', 'min:6', 'max:30']
//            'email' => ['email:dns', 'min:6', 'max:30']
        ];
    }
}
