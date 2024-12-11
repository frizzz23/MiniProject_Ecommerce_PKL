<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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
        return view('auth.auth');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate(); // Proses autentikasi

        $request->session()->regenerate(); // Regenerasi sesi

        // Cek role pengguna yang login
        $user = $request->user(); // Ambil data user yang login

        if ($user->hasRole('admin')) {
            return redirect()->route('dashboard.index'); // Jika admin, arahkan ke dashboard
        }

        if ($user->hasRole('user')) {
            return redirect('/'); // Jika user, arahkan ke landingpage
        }

        // Jika tidak ada role yang cocok, arahkan ke halaman default
        return redirect('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
