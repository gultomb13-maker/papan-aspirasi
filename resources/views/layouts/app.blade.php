<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Papan Aspirasi')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased min-h-screen pb-12">

    <header class="bg-white border-b border-gray-100 sticky top-0 z-50 backdrop-blur-md bg-white/90">
        <div class="max-w-2xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('aspirations.index') }}" class="text-xl font-bold tracking-tight text-gray-900">
                Papan Aspirasi <span class="text-blue-600">Kampus</span>
            </a>
            <a href="{{ route('aspirations.create') }}" class="text-xs bg-blue-600 text-white px-3 py-1.5 rounded-full font-medium hover:bg-blue-700 transition">
                + Kirim Suara
            </a>
        </div>
    </header>

    <main class="max-w-2xl mx-auto px-4 mt-8">
        @yield('content')
    </main>

</body>
</html>