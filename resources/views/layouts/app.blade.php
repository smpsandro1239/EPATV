<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EPATV Job Portal') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">EPATV Job Portal</a>
            <div class="flex gap-4">
                <a href="{{ route('jobs.index') }}" class="text-gray-700 hover:text-blue-600">Ofertas</a>
                <a href="{{ route('areas.index') }}" class="text-gray-700 hover:text-blue-600">Áreas</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600">Dashboard</a>
                    @if(auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin')
                        <a href="{{ route('registration-windows.index') }}" class="text-gray-700 hover:text-blue-600">Admin</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-blue-600">Sair</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Registar</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="min-h-screen">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 text-center">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-4 text-center">
                {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="bg-blue-600 text-white py-4 text-center">
        <p>© {{ date('Y') }} EPATV - Escola Profissional Amar Terra Verde. Todos os direitos reservados.</p>
        <p>Desenvolvido para a comunidade EPATV | <a href="mailto:contact@epatv.pt" class="underline">contact@epatv.pt</a></p>
    </footer>
</body>
</html>
