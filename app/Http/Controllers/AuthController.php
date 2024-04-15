<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function postSignin(Request $request)
    {

        if (!Auth::attempt($request->only('email', 'password'), $request->has('remember'))) {
            var_dump($request);
            echo 'Неправильный логин или пароль';
        } else {
            echo 'Вы успешно авторизовались';
            return redirect('auth/app');
        }
    }
    public function postReg(Request $request)
    {
        $user = User::create([
            'email'    => $request->input('email'),
            'name'     => $request->input('name'),
            'password' => bcrypt($request->input('password'))
        ]);

        Auth::loginUsingId($user->id);

// После успешной регистрации перенаправляем на страницу welcome
        return redirect('auth/app');
    }
}
