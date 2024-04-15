<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Добро пожаловать</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Подключение стилей Bootstrap -->
    <link href="{{ asset('source/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body class="antialiased">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{--                , {{ Auth::user()->name }}--}}
                <div class="card-header">Добро пожаловать!</div>
                <div class="card-body">
                    <p>Вы успешно авторизовались. Это страница после авторизации.</p>
                    {{--                    <form action="{{ route('logout') }}" method="POST">--}}
                    {{--                        @csrf--}}
                    {{--                        <button type="submit" class="btn btn-primary">Выйти</button>--}}
                    {{--                    </form>--}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Подключение скриптов Bootstrap -->
<script src="{{ asset('source/css/bootstrap/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
