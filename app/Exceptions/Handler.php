<?php

namespace App\Exceptions;

use App\Exceptions\Auth\InvalidCredentialsException;
use App\Exceptions\Auth\NotApprovedException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
// Эта функция регистрирует наш кастомный exception
        $this->renderable(function (InvalidCredentialsException $e) {
            return response()->json([
                'status' => 'failed',
// message, который будет передаваться функция __() - она используется для мультиязычности. в неё мы передаем файл exceptions  и ключ из массива
// в его выводе. В зависимости от locale, указанной в /config/app будет использоваться файл из папки en или ru
                'message' => __("exceptions.{$e->getMessage()}")
            ],401);
        });

        $this->renderable(function (NotApprovedException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => __("exceptions.{$e->getMessage()}")
            ], 401);
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
