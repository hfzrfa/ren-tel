<!doctype html>
<html lang="en" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#111827">
    <title>@yield('title', 'Rent-Tel')</title>

    <!-- Font: Instrument Sans (matches Tailwind @theme font-sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Vite assets (Tailwind v4 is configured) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Small polish for focus and scroll */
        html {
            scroll-behavior: smooth;
        }
    </style>
    @stack('head')
    @yield('head')
</head>

<body class="min-h-full bg-gray-50 text-gray-800 antialiased dark:bg-gray-950 dark:text-gray-100">
    @include('partials.nav')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
    @yield('scripts')
</body>

</html>
