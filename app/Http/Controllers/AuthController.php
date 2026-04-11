<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(\Illuminate\Http\Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = \Illuminate\Support\Facades\Auth::user();

            return match ($user->role) {
                'admin' => redirect()->intended('/dashboard/admin'),
                'mahasiswa' => redirect()->intended('/dashboard/mahasiswa'),
                'verifikator_prodi' => redirect()->intended('/dashboard/prodi'),
                'puskaka' => redirect()->intended('/dashboard/puskaka'),
                default => redirect()->intended('/dashboard'),
            };
        }

        return back()->with('error', 'Username atau password salah.')->withInput($request->only('username'));
    }

    public function logout(\Illuminate\Http\Request $request)
    {
        \Illuminate\Support\Facades\Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
