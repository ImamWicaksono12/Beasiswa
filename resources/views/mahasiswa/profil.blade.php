@extends('layouts.student')

@section('title', 'Profil Saya')
@section('page_title', 'Manajemen Profil Mahasiswa')

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card border-0 rounded-4 shadow-sm mb-4">
                <div class="card-body text-center p-5">
                    <div class="user-avatar-lg bg-primary text-white mx-auto mb-3">AF</div>
                    <h5 class="fw-bold mb-1">Ahmad Fauzi</h5>
                    <p class="text-muted small mb-3">Mahasiswa Teknik Informatika</p>
                    <div class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Akun Terverifikasi</div>
                </div>
            </div>
            <div class="card border-0 rounded-4 shadow-sm">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">Keamanan</h6>
                    <button class="btn btn-outline-primary btn-sm rounded-pill w-100 mb-2">Ubah Password</button>
                    <button class="btn btn-outline-secondary btn-sm rounded-pill w-100">Dua Faktor (2FA)</button>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card border-0 rounded-4 shadow-sm">
                <div class="card-body p-5">
                    <h5 class="fw-bold mb-4">Informasi Pribadi</h5>
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Nomor Pokok Mahasiswa (NPM)</label>
                                <input type="text" class="form-control bg-light border-0 rounded-3" value="1402021001" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Program Studi</label>
                                <input type="text" class="form-control bg-light border-0 rounded-3" value="Teknik Informatika" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label small fw-bold">Email Universitas</label>
                                <input type="email" class="form-control border-light rounded-3" value="ahmad.fauzi@yarsi.ac.id">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label small fw-bold">Nomor WhatsApp</label>
                                <input type="text" class="form-control border-light rounded-3" value="081234567890">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label small fw-bold">Alamat Lengkap</label>
                                <textarea class="form-control border-light rounded-3" rows="3">Jl. Letjen Suprapto, Cempaka Putih, Jakarta Pusat</textarea>
                            </div>
                        </div>
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary rounded-pill px-5">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .user-avatar-lg { width: 100px; height: 100px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; font-weight: 800; border: 5px solid #f1f5f9; }
    </style>
@endsection
