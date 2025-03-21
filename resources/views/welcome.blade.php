<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Student Management System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full items-center text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Welcome to Student Management System</h1>
            <p class="text-gray-600 mb-6">Please log in to access your dashboard.</p>
            <img src="{{ asset('images/rupp_logo.png') }}" alt="Logo" class="h-20 w-auto mx-auto block mb-6">
            <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Login</a>
            <a href="{{ route('register') }}" class="ml-4 text-blue-600 hover:text-blue-800">Register</a>
        </div>
    </div>
</body>

</html>