@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="bi bi-bank2 fs-1"></i>
                        </div>
                        <h2 class="fw-bold">Puskaka / Kemahasiswaan</h2>
                        <p class="text-muted">Pantau data pendaftaran beasiswa secara keseluruhan.</p>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light text-center">
                                <i class="bi bi-graph-up-arrow fs-3 text-success mb-2"></i>
                                <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Total Pendaftar</small>
                                <span class="fw-bold">0 Mahasiswa</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light text-center">
                                <i class="bi bi-wallet2 fs-3 text-success mb-2"></i>
                                <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Dana Disalurkan</small>
                                <span class="fw-bold">Rp 0</span>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 opacity-25">

                    <div class="d-grid">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-lg w-100 rounded-3">
                                <i class="bi bi-box-arrow-right me-2"></i>Keluar dari Sistem
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
