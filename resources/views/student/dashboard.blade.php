@extends('layouts.app')
@section('content')
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Student Dashboard</h1>
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">{{ session('success') }}</div>
        @endif
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Your Information</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <p><strong>ID:</strong> {{ $student->id }}</p>
                <p><strong>Name:</strong> {{ $student->name }}</p>
                <p><strong>Sex:</strong> {{ ucfirst($student->sex) }}</p>
                <p><strong>Year of Study:</strong> {{ $student->year_of_study ?? 'N/A' }}</p>
                <p><strong>Major:</strong> {{ $student->major ?? 'N/A' }}</p>
                <p><strong>Department:</strong> {{ $student->department ?? 'N/A' }}</p>
                <p><strong>Graduate Day:</strong> {{ $student->graduate_day?->format('Y-m-d') ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $student->email }}</p>
                <p><strong>Status:</strong> {{ ucfirst($student->status) }}</p>
            </div>
        </div>
        <form action="{{ route('student.password.request') }}" method="POST" class="mt-6">
            @csrf
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Request Password
                Change</button>
        </form>
    </div>
@endsection