<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'name' => 'max:30',
            'phone' => ['min:6', 'max:30'],
            'email' => ['email:dns', 'min:6', 'max:30']
        ];
    }
}
