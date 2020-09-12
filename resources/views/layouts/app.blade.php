<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('head')

    <title>@yield('title') - FormZend</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    @yield('content')
    <script src="{{ asset('js/app.js') }}"></script>
    <script async defer src="https://funny.formzend.com/latest.js"></script>
    <noscript><img src="https://funny.formzend.com/noscript.gif" alt="" /></noscript>
</body>

</html>
