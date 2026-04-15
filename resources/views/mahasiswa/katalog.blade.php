@extends('layouts.student')

@section('title', 'Katalog Beasiswa')
@section('page_title', 'Katalog Beasiswa Tersedia')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-0 rounded-4 shadow-sm p-4 text-center">
                <i class="bi bi-search-heart text-primary fs-1 mb-3"></i>
                <h4 class="fw-bold">Temukan Beasiswa Impian Anda</h4>
                <p class="text-muted">Cari dan filter berbagai program beasiswa internal maupun eksternal Universitas YARSI.</p>
                
                <div class="input-group mb-4 mx-auto" style="max-width: 500px;">
                    <input type="text" class="form-control rounded-pill-start border-light bg-light px-4" placeholder="Cari beasiswa...">
                    <button class="btn btn-primary rounded-pill-end px-4">Cari</button>
                </div>

                <div class="row text-start mt-4">
                    <div class="col-md-6 mb-4">
                        <div class="p-4 rounded-4 border border-light shadow-sm hover-shadow transition">
                            <span class="badge bg-primary mb-3">Internal</span>
                            <h5 class="fw-bold mb-2">Beasiswa Tahfidz Al-Qur'an</h5>
                            <p class="small text-muted mb-3">Diberikan kepada mahasiswa yang memiliki hafalan minimal 5 Juz.</p>
                            <button class="btn btn-outline-primary btn-sm rounded-pill px-4">Lihat Syarat</button>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="p-4 rounded-4 border border-light shadow-sm hover-shadow transition">
                            <span class="badge bg-success mb-3">Full Funded</span>
                            <h5 class="fw-bold mb-2">Beasiswa Prestasi Akademik</h5>
                            <p class="small text-muted mb-3">Penghargaan untuk mahasiswa dengan IPK minimal 3.75 selama 2 semester berturut-turut.</p>
                            <button class="btn btn-outline-primary btn-sm rounded-pill px-4">Lihat Syarat</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
