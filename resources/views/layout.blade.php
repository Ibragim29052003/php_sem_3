<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Сайт') </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<header class="d-flex justify-content-between align-items-center p-3 border-bottom">
    <a class="navbar-brand" href="{{ route('home') }}">Мой сайт</a>

    {{-- ----------------- 9 ЛАБА закомментирована ----------------- --}}
    {{--
    <div class="ms-auto d-flex gap-2">
        @auth
            <span class="navbar-text me-3">Привет, {{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">@csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">Выйти</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Войти</a>
            <a href="{{ route('register') }}" class="btn btn-outline-success btn-sm">Регистрация</a>
        @endauth
    </div>
    --}}
</header>

<main class="container mt-4">
    @yield('content')
</main>
</body>
</html>
