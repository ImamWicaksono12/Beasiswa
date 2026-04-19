<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {

        $credentials = $request->validate([
            'username' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string', 'min:6', 'max:100'],
        ]);

        $key = Str::lower($request->input('username')) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            return back()->with('error', 'Terlalu banyak percobaan login. Tunggu 2 menit.');
        }
        if (Auth::attempt($credentials)) {
            if (Auth::user()->is_active ?? true === false) {
                Auth::logout();
                return back()->with('error', 'Akun dinonaktifkan');
            }
            $request->session()->regenerate();
            RateLimiter::clear($key);
            return redirect($this->redirectByRole(Auth::user()->role));
        }
        Log::warning('Login gagal', [
            'username' => $request->username,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
        sleep(1);
        RateLimiter::hit($key, 120);
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
            'admin'     => route('dashboard.admin'),
            'kaprodi'   => route('dashboard.kaprodi'),
            'wadek'     => route('dashboard.wadek'),
            'warek'     => route('dashboard.warek'),
            'puskaka'   => route('dashboard.puskaka'),
            'mahasiswa' => route('dashboard.mahasiswa'),
            default     => '/',
        };
    }
}