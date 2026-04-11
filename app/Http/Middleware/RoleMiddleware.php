<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $userRole = auth()->user()->role;

        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // Redirect unauthorized users to their correct dashboard
        return match ($userRole) {
            'admin' => redirect('/dashboard/admin')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.'),
            'mahasiswa' => redirect('/dashboard/mahasiswa')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.'),
            'verifikator_prodi' => redirect('/dashboard/prodi')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.'),
            'puskaka' => redirect('/dashboard/puskaka')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.'),
            default => redirect('/dashboard')->with('error', 'Akses ditolak.'),
        };
    }
}
