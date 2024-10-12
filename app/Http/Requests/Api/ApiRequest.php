<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

// Оригинальная функция из родительского класса FormRequest, которую мы будем изменять.
//    protected function failedValidation(Validator $validator)
//    {
//        $exception = $validator->getException();
//
//        throw (new $exception($validator))
//            ->errorBag($this->errorBag)
//            ->redirectTo($this->getRedirectUrl());
//    }

// Этот метод возвращает ответ response() с json-массивом ошибок валидации и статус-код 400.
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors()->getMessages(), 400)
        );
    }
}
