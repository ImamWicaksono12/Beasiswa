@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="bi bi-shield-lock-fill fs-1"></i>
                        </div>
                        <h2 class="fw-bold">Selamat Datang, Admin!</h2>
                        <p class="text-muted">Panel Kontrol Administrator - Sistem Manajemen Beasiswa.</p>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light text-center">
                                <i class="bi bi-people-fill fs-3 text-primary mb-2"></i>
                                <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Kelola User</small>
                                <span class="fw-bold">Total: 4 User</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light text-center">
                                <i class="bi bi-file-earmark-text-fill fs-3 text-primary mb-2"></i>
                                <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Data Beasiswa</small>
                                <span class="fw-bold">Monitoring Aktif</span>
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
