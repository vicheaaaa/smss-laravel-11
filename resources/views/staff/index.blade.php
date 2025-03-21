@extends('layouts.app')
@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Staff Dashboard</h1>
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6">{{ session('error') }}</div>
        @endif

        <!-- Search Form -->
        <div class="mb-6">
            <form method="GET" action="{{ route('staff.index') }}" id="search-form" class="flex items-center">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search staff or students..."
                    class="w-full max-w-md border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    id="search-input">
            </form>
        </div>

        <a href="{{ route('staff.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-6 inline-block">Add New User</a>

        <!-- Staff List -->
        <h2 class="text-2xl font-semibold text-gray-700 mt-8 mb-4">Staff List</h2>
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sex</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($staff as $user)
                        <tr>
                            <td class="px-6 py-4">{{ $user->id }}</td>
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ ucfirst($user->sex) }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('staff.edit', $user) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                                <form action="{{ route('staff.destroy', $user) }}" method="POST" class="inline ml-2"
                                    onsubmit="return confirm('Are you sure you want to delete this staff?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No staff found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Student List -->
        <h2 class="text-2xl font-semibold text-gray-700 mt-8 mb-4">Student List</h2>
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Major</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Graduate Day</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($students as $student)
                        <tr>
                            <td class="px-6 py-4">{{ $student->id }}</td>
                            <td class="px-6 py-4">{{ $student->name }}</td>
                            <td class="px-6 py-4">{{ $student->major ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $student->graduate_day?->format('Y-m-d') ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ ucfirst($student->status) }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('staff.edit', $student) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                                @if ($student->status === 'active')
                                    <form action="{{ route('staff.disable', $student) }}" method="POST" class="inline ml-2"
                                        onsubmit="return confirm('Are you sure you want to disable this student?');">
                                        @csrf
                                        <button type="submit" class="text-yellow-600 hover:text-yellow-800">Disable</button>
                                    </form>
                                @elseif ($student->status === 'disabled')
                                    <form action="{{ route('staff.enable', $student) }}" method="POST" class="inline ml-2"
                                        onsubmit="return confirm('Are you sure you want to enable this student?');">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-800">Enable</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No students found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript for Auto-Search and Focus Retention -->
    <script>
        // Auto-submit on typing with debounce
        const searchInput = document.getElementById('search-input');
        searchInput.addEventListener('input', function () {
            clearTimeout(this.timeout);
            this.timeout = setTimeout(() => {
                document.getElementById('search-form').submit();
            }, 300);
        });

        // Restore focus after page load if there's a search term
        document.addEventListener('DOMContentLoaded', function () {
            if (searchInput.value.trim() !== '') {
                searchInput.focus();
                // Move cursor to the end of the text
                const length = searchInput.value.length;
                searchInput.setSelectionRange(length, length);
            }
        });
    </script>
@endsection