<?php

namespace App\Http\Requests\Api;

// Здесь нестандартная ситуация - наш кастомный реквест наследуется не от стандартного род.класса FormRequest, а от добавленного нами
// ApiRequest. Внутри есть переназначенный метод failedValidation(). Больше комментариев внизу класса при rules().
class SubmitRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

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

// Когда правило валидации не срабатывает, внутринние методы класса FormRequest (failedValidation() на строке 136),
// от которого наследуются requestы в нашем разделе web, делают redirect()->back() с ошибками из файла lang/ru/auth.php.
// В случае с работой через маршруты api нам не подходит такой вариант - нужно возвращать json с ошибками полей и http-код.
// Можно переписать метод failedValidation из FormRequest, но это нежелательно - этим методом могут пользоваться другие маршруты.
// Поэтому метод надо переопредилить - создать замену родительскому классу Formrequest, от которого будет наследоваться этот request.
//  А наш созданный ApiRequest-замена будет наследоваться от FormRequst. Повторяющийся метод failedValidation() будет переопределён
// при использовании ApiRequest, как родительского класса для наших реквестов)))
    public function rules(): array
    {
        return [
            'name' => 'max:30',
            'phone' => ['required', 'min:6', 'max:30'],
//            'email' => ['email:rfc,dns', 'min:6', 'max:30'],
            'demand' => 'max:250',
            'date' => 'max:10',
            'time' => 'max:10'
        ];
    }
}
