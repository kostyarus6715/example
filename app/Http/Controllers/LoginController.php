<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {

        if (!Auth::attempt($request->only('email', 'password'), $request->has('remember'))) {
            var_dump($request);
            echo 'Неправильный логин или пароль';
        } else {
            echo 'Вы успешно авторизовались';
            return redirect('/app');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
