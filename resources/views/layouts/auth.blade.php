<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Masuk' }} &mdash; {{ config('app.name', 'Beasiswa YARSI') }}</title>

    <!-- Vite CSS -->
    @vite(['resources/css/app.css'])

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom Styles Stack -->
    @stack('styles')
</head>

<body class="auth-body">

    <div class="auth-wrapper">
        @yield('content')
    </div>

    <!-- Vite JS -->
    @vite(['resources/js/app.js'])

    <!-- Custom Scripts Stack -->
    @stack('scripts')
</body>

</html>
