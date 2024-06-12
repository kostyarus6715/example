@extends('layouts.app')
@section('content')
<body>
<div class="container">
    <div class="card">
        <div class="card-header">Авторизация</div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Запомнить меня</label>
                </div>

                <div class="form-group text-center">
                    <button type="submit">Вход</button>
                </div>
            </form>

            <form method="GET" action="{{ route('welcome') }}">
                <div class="form-group text-center">
                    <button type="submit">Назад</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
@endsection
