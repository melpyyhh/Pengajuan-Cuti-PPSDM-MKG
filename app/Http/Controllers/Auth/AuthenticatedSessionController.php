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
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        //logika login
        $request->authenticate();
        $request->session()->regenerate();

        $role = Auth::user()->role;
        if ($role === 'admin') {
            return redirect(route('admin.daftar-pengaduan'));
        } elseif ($role === 'pengaju') {
            return redirect(route('pengaju.riwayat'));
        } elseif ($role === 'penyetuju') {
            return redirect(route('penyetuju.daftar-cuti'));
        } elseif ($role === 'dual_role') {
            return redirect(route('pengaju.riwayat'));
        }
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
