<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Tambahkan logika redirect berdasarkan role
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->intended(RouteServiceProvider::HOME_ADMIN);
        } elseif ($user->role === 'mahasiswa') {
            return redirect()->intended(RouteServiceProvider::HOME_MAHASISWA);
        }

        // Fallback jika role tidak terdefinisi atau kasus lain
        return redirect()->intended(RouteServiceProvider::HOME_MAHASISWA); // Atau ke halaman default
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
