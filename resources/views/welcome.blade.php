@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header bg-primary text-white text-center">
                        Добро пожаловать
                    </div>

                    <div class="card-body text-center">
                        <p class="lead">Добро пожаловать на наш сайт!</p>
                        <p>Если у вас уже есть аккаунт, пожалуйста, <a href="{{ route('login') }}" class="btn btn-link">войдите</a>.</p>
                        <p>Если у вас еще нет аккаунта, вы можете <a href="{{ route('register') }}" class="btn btn-link">зарегистрироваться здесь</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
