<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = auth()->user();

        // Check if student has graduated
        if ($user->isStudent() && $user->graduate_day && Carbon::today()->gte($user->graduate_day)) {
            $user->update(['status' => 'disabled']);
            auth()->logout();
            return redirect('/login')->withErrors(['email' => 'Your account has been disabled due to graduation.']);
        }

        // Check if already disabled
        if ($user->isStudent() && $user->status === 'disabled') {
            auth()->logout();
            return redirect('/login')->withErrors(['email' => 'Your account is disabled.']);
        }

        return redirect()->intended(route('dashboard'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}