<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Student Management System') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen">
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-800">Student
                                Management</a>
                        </div>
                    </div>
                    <div class="flex items-center">
                        @auth
                            <span class="text-gray-700 mr-4">{{ auth()->user()->name }}
                                ({{ ucfirst(auth()->user()->role) }})</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
        <main class="py-6">
            @yield('content')
        </main>
    </div>
</body>

</html>