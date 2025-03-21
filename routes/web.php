<?php

use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return auth()->user()->isStaff()
            ? redirect()->route('staff.index')
            : redirect()->route('student.dashboard');
    })->name('dashboard');

    Route::middleware('role:staff')->group(function () {
        Route::resource('staff', StaffController::class);
        Route::post('staff/{staff}/disable', [StaffController::class, 'disable'])->name('staff.disable');
        Route::post('staff/{staff}/enable', [StaffController::class, 'enable'])->name('staff.enable'); // New route
    });

    Route::middleware('role:student')->group(function () {
        Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
        Route::post('/student/password-request', [StudentController::class, 'requestPasswordChange'])->name('student.password.request');
    });
});

require __DIR__ . '/auth.php';