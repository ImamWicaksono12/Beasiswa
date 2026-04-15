@extends('layouts.student')

@section('title', 'Dashboard Mahasiswa')
@section('page_title', 'Dashboard Selamat Datang')

@section('content')
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card border-0 rounded-4 shadow-sm bg-premium p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h2 class="fw-bold text-white mb-2">Halo, Ahmad Fauzi! 👋</h2>
                        <p class="text-white text-opacity-75 mb-0">Selamat datang kembali. Berikut adalah ringkasan status akademik dan beasiswa Anda.</p>
                    </div>
                    <img src="https://illustrations.popsy.co/white/studying.svg" alt="Studying" style="height: 120px;" class="d-none d-lg-block">
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="stat-card">
                <div class="icon sc-blue"><i class="bi bi-mortarboard"></i></div>
                <div>
                    <span class="label">Status Akademik</span>
                    <span class="value">Aktif (Semester 6)</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="stat-card">
                <div class="icon sc-green"><i class="bi bi-patch-check"></i></div>
                <div>
                    <span class="label">IPK Terakhir</span>
                    <span class="value">3.85 / 4.00</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="stat-card">
                <div class="icon sc-orange"><i class="bi bi-star"></i></div>
                <div>
                    <span class="label">Status Beasiswa</span>
                    <span class="value">Full Funded (Aktif)</span>
                </div>
            </div>
        </div>

        <div class="col-lg-8 mb-4">
            <div class="info-card">
                <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between">
                    <h5 class="fw-bold mb-0">Program Berjalan</h5>
                    <a href="{{ route('mahasiswa.riwayat') }}" class="small text-decoration-none">Lihat Detail</a>
                </div>
                <div class="card-body p-4">
                    <div class="current-program p-3 rounded-4 border border-dashed border-primary bg-primary bg-opacity-10">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h6 class="fw-bold text-primary mb-1">Beasiswa YARSI Full Funded 2024</h6>
                                <small class="text-muted">Batch 1 - Akademik Unggulan</small>
                            </div>
                            <span class="badge bg-success rounded-pill px-3 py-2">Berjalan</span>
                        </div>
                        <div class="progress rounded-pill mb-2" style="height: 6px;">
                            <div class="progress-bar bg-primary" style="width: 75%;"></div>
                        </div>
                        <div class="d-flex justify-content-between small">
                            <span class="text-muted">Pencairan Tahap 1 & 2 Selesai</span>
                            <span class="text-primary fw-bold">75%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="info-card">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0">Informasi Penting</h5>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-warning border-0 rounded-4 p-3 mb-0">
                        <div class="d-flex gap-3">
                            <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Deadline Lapor Semester</h6>
                                <p class="small mb-0">Batas unggah KHS Semester Ganjil adalah <strong>20 Agustus 2024</strong>. Jangan sampai terlambat!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-premium {
            background: linear-gradient(135deg, #2563eb, #4f46e5);
        }
        .stat-card {
            background: #fff; padding: 1.5rem; border-radius: 20px; box-shadow: var(--card-shadow);
            display: flex; align-items: center; gap: 15px; border: 1px solid #f1f5f9;
        }
        .stat-card .icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; }
        .sc-blue { background: rgba(37, 99, 235, 0.1); color: #2563eb; }
        .sc-green { background: rgba(16, 185, 129, 0.1); color: #10b981; }
        .sc-orange { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
        .stat-card .label { display: block; font-size: 0.75rem; color: #64748b; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-card .value { display: block; font-weight: 800; font-size: 1rem; color: #1e293b; }
        
        .info-card { background: #fff; border-radius: 24px; box-shadow: var(--card-shadow); border: 1px solid #f1f5f9; height: 100%; }
    </style>
@endsection
