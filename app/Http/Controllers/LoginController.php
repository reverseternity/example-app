<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showIndex()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $user = User::wherePhone($request->input('phone'))->first();
        if ($user !== null) {
            if (Hash::check($request->input('password'), $user->password)) {
                Auth::login($user, true);
                return redirect()->route('crm');
            }
        }else{
            dd('Error with auth!');
        }
    }
}
