<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('mahasiswa.dashboard');
    }

    public function katalog()
    {
        return view('mahasiswa.katalog');
    }

    public function pengajuan()
    {
        return view('mahasiswa.pengajuan');
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
