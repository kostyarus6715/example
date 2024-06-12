<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('resources/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/css/app.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto"></ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        @auth
                            <span class="navbar-text mr-3">
                            Добро пожаловать, {{ Auth::user()->name }}!
                        </span>
                        @endauth
                    </li>
                    <li class="nav-item">
                        <!-- Добавьте другие элементы информационной панели здесь -->
                    </li>
                    <li class="nav-item">
                        @guest
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @else
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endguest
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
<script src="{{ asset('resources/js/jquery.min.js') }}"></script>
<script src="{{ asset('resources/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('resources/js/custom.js') }}" defer></script>
</body>
</html>
