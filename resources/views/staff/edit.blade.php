@extends('layouts.app')
@section('content')
    <div class="max-w-lg mx-auto bg-white shadow rounded-lg p-6 mt-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit User</h1>
        <form action="{{ route('staff.update', $staff->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $staff->name) }}"
                    class="w-full border rounded p-2 @error('name') border-red-500 @enderror" required>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="sex">Sex</label>
                <select name="sex" id="sex" class="w-full border rounded p-2 @error('sex') border-red-500 @enderror"
                    required>
                    <option value="male" {{ old('sex', $staff->sex) === 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('sex', $staff->sex) === 'female' ? 'selected' : '' }}>Female</option>
                </select>
                @error('sex')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $staff->email) }}"
                    class="w-full border rounded p-2 @error('email') border-red-500 @enderror" required>
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            @if ($staff->isStudent())
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="year_of_study">Year of Study</label>
                    <input type="number" name="year_of_study" id="year_of_study"
                        value="{{ old('year_of_study', $staff->year_of_study) }}"
                        class="w-full border rounded p-2 @error('year_of_study') border-red-500 @enderror">
                    @error('year_of_study')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="major">Major</label>
                    <input type="text" name="major" id="major" value="{{ old('major', $staff->major) }}"
                        class="w-full border rounded p-2 @error('major') border-red-500 @enderror">
                    @error('major')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="department">Department</label>
                    <input type="text" name="department" id="department" value="{{ old('department', $staff->department) }}"
                        class="w-full border rounded p-2 @error('department') border-red-500 @enderror">
                    @error('department')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="graduate_day">Graduate Day</label>
                    <input type="date" name="graduate_day" id="graduate_day"
                        value="{{ old('graduate_day', $staff->graduate_day?->format('Y-m-d')) }}"
                        class="w-full border rounded p-2 @error('graduate_day') border-red-500 @enderror">
                    @error('graduate_day')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            @endif
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
                <a href="{{ route('staff.index') }}"
                    class="ml-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
            </div>
        </form>
    </div>
@endsection