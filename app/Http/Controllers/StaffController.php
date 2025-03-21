<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        // Search query from the request
        $search = $request->input('search');

        // Staff query with search filter
        $staffQuery = User::where('role', 'staff');
        if ($search) {
            $staffQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }
        $staff = $staffQuery->get();

        // Students query with search filter
        $studentsQuery = User::where('role', 'student');
        if ($search) {
            $studentsQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('major', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%");
            });
        }
        $students = $studentsQuery->get();

        return view('staff.index', compact('staff', 'students', 'search'));
    }

    public function create()
    {
        return view('staff.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'sex' => 'required|in:male,female',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:staff,student',
            'year_of_study' => 'nullable|integer|min:1|max:6',
            'major' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'graduate_day' => 'nullable|date|after:today',
        ]);

        $data['password'] = bcrypt($data['password']);
        User::create($data);

        return redirect()->route('staff.index')->with('success', 'User created successfully.');
    }

    public function edit(User $staff)
    {
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, User $staff)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'sex' => 'required|in:male,female',
            'email' => 'required|email|unique:users,email,' . $staff->id,
            'year_of_study' => 'nullable|integer|min:1|max:6',
            'major' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'graduate_day' => 'nullable|date',
        ]);

        $staff->update($data);

        // Check if the user is a student and graduate_day is past
        if ($staff->isStudent() && $staff->graduate_day && Carbon::today()->gte($staff->graduate_day)) {
            $staff->update(['status' => 'disabled']);
            return redirect()->route('staff.index')->with('success', 'User updated and disabled due to past graduation date.');
        }

        return redirect()->route('staff.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('staff.index')->with('success', 'User deleted successfully.');
    }

    public function disable(User $staff)
    {
        if ($staff->isStudent()) {
            $staff->update(['status' => 'disabled']);
            return redirect()->route('staff.index')->with('success', 'Student disabled successfully.');
        }
        return redirect()->route('staff.index')->with('error', 'Only students can be disabled.');
    }

    public function enable(User $staff)
    {
        if ($staff->isStudent()) {
            $staff->update(['status' => 'active']);
            return redirect()->route('staff.index')->with('success', 'Student enabled successfully.');
        }
        return redirect()->route('staff.index')->with('error', 'Only students can be enabled.');
    }
}