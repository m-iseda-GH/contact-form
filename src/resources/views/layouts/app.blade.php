<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>
<body>
    <header class="header">
        <h1 class="header__logo">FashionablyLate</h1>

        <div class="header__button">
            @yield('header-button')
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>