@extends('layouts.app')
@section('content')
    <body>
    <div class="container">
        <div class="card">
            <div class="card-header">Регистрация</div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autocomplete="email">
                    </div>

                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" name="password" id="password" class="form-control" required autocomplete="new-password">
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">Подтверждение пароля</label>
                        <input type="password" name="password_confirmation" id="password-confirm" class="form-control" required autocomplete="new-password">
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                    </div>
                </form>

                <form method="GET" action="{{ route('welcome') }}">
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-secondary">Назад</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    </body>
@endsection
