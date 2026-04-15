<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {

        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $key = Str::lower($request->input('username')) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            return back()->with('error', 'Terlalu banyak percobaan login. Coba lagi nanti.');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            RateLimiter::clear($key); 

            return redirect()->intended(
                $this->redirectByRole(Auth::user()->role)
            );
        }

        // tambah percobaan jika gagal
        RateLimiter::hit($key, 60); 

        return back()
            ->with('error', 'Username atau password salah.')
            ->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    private function redirectByRole($role)
    {
        return match ($role) {
            'admin' => route('dashboard.admin'),
            'mahasiswa' => route('dashboard.mahasiswa'),
            'verifikator_prodi' => route('dashboard.prodi'),
            'puskaka' => route('dashboard.puskaka'),
            default => '/',
        };
    }
}