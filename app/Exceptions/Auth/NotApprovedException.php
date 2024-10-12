<?php

namespace App\Exceptions\Auth;

use Exception;

class NotApprovedException extends Exception
{
    // в переменной $message будет выводиться значение из массива в файле /lang/ru или /en / exceptions по ключу, который мы указали
// в зависимости от локали приложения. Логика прописана в app/Exceptions/Handler.php
    protected $message = 'NotApproved';
}
