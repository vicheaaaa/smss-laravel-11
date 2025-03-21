@extends('layouts.app')
@section('content')
    <div class="max-w-lg mx-auto bg-white shadow rounded-lg p-6 mt-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Add New User</h1>
        <form action="{{ route('staff.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full border rounded p-2 @error('name') border-red-500 @enderror" required>
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="sex">Sex</label>
                <select name="sex" id="sex" class="w-full border rounded p-2 @error('sex') border-red-500 @enderror"
                    required>
                    <option value="male" {{ old('sex') === 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('sex') === 'female' ? 'selected' : '' }}>Female</option>
                </select>
                @error('sex') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="w-full border rounded p-2 @error('email') border-red-500 @enderror" required>
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="password">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full border rounded p-2 @error('password') border-red-500 @enderror" required>
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="role">Role</label>
                <select name="role" id="role" class="w-full border rounded p-2 @error('role') border-red-500 @enderror"
                    required>
                    <option value="staff" {{ old('role') === 'staff' ? 'selected' : '' }}>Staff</option>
                    <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>Student</option>
                </select>
                @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div id="student-fields" class="hidden">
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="year_of_study">Year of Study</label>
                    <input type="number" name="year_of_study" id="year_of_study" max="4" min="1" value="{{ old('year_of_study') }}"
                        class="w-full border rounded p-2 @error('year_of_study') border-red-500 @enderror">
                    @error('year_of_study') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="major">Major</label>
                    <input type="text" name="major" id="major" value="{{ old('major') }}"
                        class="w-full border rounded p-2 @error('major') border-red-500 @enderror">
                    @error('major') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="department">Department</label>
                    <input type="text" name="department" id="department" value="{{ old('department') }}"
                        class="w-full border rounded p-2 @error('department') border-red-500 @enderror">
                    @error('department') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="graduate_day">Graduate Day</label>
                    <input type="date" name="graduate_day" id="graduate_day" value="{{ old('graduate_day') }}"
                        class="w-full border rounded p-2 @error('graduate_day') border-red-500 @enderror">
                    @error('graduate_day') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
        </form>
    </div>
    <script>
        const roleSelect = document.getElementById('role');
        const studentFields = document.getElementById('student-fields');
        roleSelect.addEventListener('change', function () {
            studentFields.classList.toggle('hidden', this.value !== 'student');
        });
        if (roleSelect.value === 'student') studentFields.classList.remove('hidden');
    </script>
@endsection