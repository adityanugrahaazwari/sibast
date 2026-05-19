<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-sm mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <a href="/" class="flex-shrink-0 flex items-center font-bold text-xl text-indigo-600">
                        SIBAST
                    </a>
                </div>
                <div class="flex items-center">
                    @auth
                        <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold mr-4 px-2.5 py-0.5 rounded uppercase">{{ Auth::user()->role }}</span>
                        <a href="{{ route('dashboard') }}" class="text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                        <a href="{{ route('berita-acara.index') }}" class="text-gray-700 px-3 py-2 rounded-md text-sm font-medium">BAST</a>
                        @if (Auth::user()->isAdmin())
                            <a href="{{ route('users.index') }}" class="text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Users</a>
                        @endif
                        <a href="{{ route('profile.edit') }}" class="text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Profil</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
