<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $stats = [
            'total_beasiswa'    => Beasiswa::count(),
            'beasiswa_aktif'    => Beasiswa::where('is_active', true)->count(),
            'beasiswa_nonaktif' => Beasiswa::where('is_active', false)->count(),
            'fully_funded'      => Beasiswa::where('kategori_dana', 'fully_funded')->count(),
            'partially_funded'  => Beasiswa::where('kategori_dana', 'partially_funded')->count(),
            'one_shoot'         => Beasiswa::where('kategori_dana', 'one_shoot')->count(),
            'total_pejabat'     => User::whereIn('role', ['kaprodi', 'wadek', 'warek', 'puskaka'])->count(),
            'total_kaprodi'     => User::where('role', 'kaprodi')->count(),
            'total_wadek'       => User::where('role', 'wadek')->count(),
            'total_warek'       => User::where('role', 'warek')->count(),
            'total_puskaka'     => User::where('role', 'puskaka')->count(),
        ];

        // Support AJAX polling untuk realtime stats
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['stats' => $stats]);
        }

        $recentBeasiswa = Beasiswa::latest()->take(6)->get();

        return view('admin.dashboard', compact('stats', 'recentBeasiswa'));
    }
}
