@extends('layouts.student')

@section('title', 'Pengajuan Beasiswa')
@section('page_title', 'Form Pengajuan Baru')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 rounded-4 shadow-sm">
                <div class="card-body p-5">
                    <div class="alert alert-info border-0 rounded-4 mb-4">
                        <div class="d-flex gap-3">
                            <i class="bi bi-info-circle-fill fs-4"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Sebelum Melanjutkan</h6>
                                <p class="small mb-0">Pastikan Anda telah menyiapkan dokumen persyaratan (Scan KTP, KTM, KHS, dan Esai) dalam format PDF maksimal 2MB per file.</p>
                            </div>
                        </div>
                    </div>

                    <form action="#" method="POST">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Pilih Program Beasiswa</label>
                            <select class="form-select border-light bg-light rounded-3 p-3">
                                <option selected disabled>Pilih program...</option>
                                <option>Beasiswa Full Funded Ganjil 2024</option>
                                <option>Beasiswa Tahfidz Batch 3</option>
                                <option>Beasiswa Satu Juta Mimpi</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Alasan Mengajukan</label>
                            <textarea class="form-control border-light bg-light rounded-3 p-3" rows="4" placeholder="Ceritakan singkat motivasi Anda..."></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg rounded-3 py-3 fw-bold">
                                Lanjutkan ke Unggah Dokumen <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
