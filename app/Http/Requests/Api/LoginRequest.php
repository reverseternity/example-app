<?php

namespace App\Http\Requests\Api;

class LoginRequest extends ApiRequest
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
            'phone' => 'required',
            'password' => 'required'
        ];
    }
}
