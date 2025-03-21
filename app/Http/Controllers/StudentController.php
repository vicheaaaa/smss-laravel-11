<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
    public function dashboard()
    {
        $student = auth()->user();
        return view('student.dashboard', compact('student'));
    }

    public function requestPasswordChange(Request $request)
    {
        $student = auth()->user();
        Mail::raw("Student {$student->name} (ID: {$student->id}) has requested a password change.", function ($message) {
            $message->to('staff@example.com')->subject('Password Change Request');
        });

        return redirect()->route('student.dashboard')->with('success', 'Password change request sent to staff.');
    }
}