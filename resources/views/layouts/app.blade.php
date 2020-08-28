<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        a{
            color: black;
        }
        a:hover{
            text-decoration: none;
            color: black;
        }
    </style>
    @stack('style')
    @stack('mix')
</head>
<body>
    <div id="app">
        <section class="px-5 py-4 mb-4">
            <header class="container mx-auto">
                <h1>Tweety</h1>
            </header>
        </section>
        <section class="px-5">
            <main class="mx-auto">
                @auth
                    <div class="row d-flex justify-content-between">
                        <div class="col-lg-2">
                            @include('_sidebar-links')
                        </div>
                        <div class="col-lg-8">
                            @yield('content')
                        </div>
                        <div class="col-lg-2">
                            @include('_friend-list')
                        </div>
                    </div>
                @endauth
                @guest
                        @yield('content')
                @endguest
            </main>
        </section>
    </div>
    @stack('script')
</body>
</html>
