<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Services\BeasiswaService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        private BeasiswaService $beasiswaService
    ) {}

    public function index()
    {
        return view('mahasiswa.dashboard');
    }

    public function katalog(Request $request)
    {
        $query = Beasiswa::where('is_active', true)->latest();

        if ($request->filled('search')) {
            $query->where('nama_beasiswa', 'like', '%' . $request->search . '%')
                  ->orWhere('sumber_dana', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori')) {
            $query->where('kategori_dana', $request->kategori);
        }

        $beasiswas = $query->get();

        return view('mahasiswa.katalog', compact('beasiswas'));
    }

    public function pengajuan()
    {
        $beasiswas = $this->beasiswaService->getActive();

        return view('mahasiswa.pengajuan', compact('beasiswas'));
    }

    public function riwayat()
    {
        return view('mahasiswa.riwayat');
    }

    public function profil()
    {
        return view('mahasiswa.profil');
    }
}
