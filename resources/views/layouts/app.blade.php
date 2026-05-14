<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Papan Aspirasi')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="min-h-screen text-gray-800">

    @include('layouts.navigation')

    <main @if(View::hasSection('fullwidth')) style="width:100%; padding:0; margin:0;" @else class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" @endif>
        @yield('content')
    </main>

</body>
</html>