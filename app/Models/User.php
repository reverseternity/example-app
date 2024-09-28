<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    //Hasfactoru - класс, который даст модели работоать с фабриками
    //SoftDeletes даст работу с мягким удалением))
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // Эти поля не будут выводиться, когда мы получим экземпляр модели.
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // Каст 'hashed' делает пароль захешированным. Не нужно отдельно прописывать хеш в контроллере.
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //Это Мутаторы. Они преобразуют все значения поля name, проходящих через модель.
    //Эти мутаторы делают каждое слово с большой буквы.
    //getNameAttribue называется "геттер" - она работает на маршруте get - преобразует получаемые из БД данные.
    //setNameAttribute называется "сеттер" - она работает на маршруте post - преобразует входящие в БД данные.
    // Я их немного доработал. В туторе предлагалось использовать функцию ucfirst/ucwords
    // но она работает только с латинскими буквами. mb_convert_case работает со всеми. Это встроенная функция php
//    public function setNameAttribute($value): void
//    {
//        $converted = mb_convert_case($value, MB_CASE_TITLE);
//
//        $this->attributes['name'] = $converted;
//    }
//
//    public function getNameAttribute($value): string
//    {
//        $converted = mb_convert_case($value, MB_CASE_TITLE);
//
//        return $converted;
//    }

    //Далее написана укороченная версия этих мутаторов с использованием "fn" - "лямбда-функции", которая появилась в php 7.x
    //fn - сокращение от function. Левая часть функции - это её код, правая часть - её return
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => mb_convert_case($value, MB_CASE_TITLE),
            set: fn ($value) => mb_convert_case($value, MB_CASE_TITLE)
        );
    }

    // Это лютый франкенштейн-мутатор. Идею взял отсюда: https://stackoverflow.com/questions/21985932/remove-special-characters-from-a-phone-number
    // Инфо по использованию функции preg_replace() можно найти в доке php.
    // Первый аргумент - паттерн поиска в строке. Может быть строкой или массивом со строками. В данном случае функция
    // находит все цифры от 0 до 9 и символ +. Если убрать ^, то эффект инвертируется.
    // Второй аргумент - всё, что не совпадает с этим паттерном, заменяется на '' - пустое место.
    // Третий аргумент - сама строка, которую мыв модифицируем. В данном случае это переменная $value внутри объекта
    // класса Attribute.
    protected function phone(): Attribute
    {

        return Attribute::make(
            get: fn ($value) => '+' . preg_replace('/[^0-9]/', '', $value),
            set: fn ($value) => '+' . preg_replace('/[^0-9]/', '', $value)
        );
    }
}

