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
        $error = 'Anda tidak memiliki akses ke halaman tersebut.';

        return match ($userRole) {
            'admin'     => redirect('/dashboard/admin')->with('error', $error),
            'kaprodi'   => redirect('/dashboard/kaprodi')->with('error', $error),
            'wadek'     => redirect('/dashboard/wadek')->with('error', $error),
            'warek'     => redirect('/dashboard/warek')->with('error', $error),
            'puskaka'   => redirect('/dashboard/puskaka')->with('error', $error),
            'mahasiswa' => redirect('/dashboard/mahasiswa')->with('error', $error),
            default     => redirect('/')->with('error', 'Akses ditolak.'),
        };
    }
}
