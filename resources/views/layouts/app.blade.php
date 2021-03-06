<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="robots" content="index, follow">
    <meta name="description" content="Have a simple website with a form in it? Submit the form to us, we'll email it to you. No server, no signup, no database."/>

    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ config('app.name') }} - Form submissions directly to your email">
    <meta property="og:description" content="Have a simple website with a form in it? Submit the form to us, we'll email it to you. No server, no signup, no database.">
    <meta property="og:image" content="{{ asset('assets/images/formzend-desc.png') }}">
    <meta property="og:url" content="{{ config('app.url') }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image:alt" content="{{ config('app.name') }} Selling Points. A banner">
    <meta name="twitter:site" content="@xXAlphaManXx">
    <meta name="twitter:creator" content="@xXAlphaManXx">

    @yield('head')

    <title>@yield('title') - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    @yield('content')

    <script src="{{ asset('js/app.js') }}"></script>
    @includeWhen(app()->environment() === 'production', 'layouts.analytics')
</body>

</html>
