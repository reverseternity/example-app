<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    public function showIndex()
    {
        return view('auth.register');
    }

    public function register($request)
    {

    }
}
