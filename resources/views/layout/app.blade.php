<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Sweat Nothing — sweetness without the sugar.">
        <title>@yield('title', 'Sweat Nothing | Less sugar, more life')</title>
        <link rel="stylesheet" href="{{ asset('css/contact-layout.css') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#fffdf9] font-sans text-[#111111] antialiased">
        @include('layout.topbar')

        @yield('content')

        @include('layout.footer')
    </body>
</html>
