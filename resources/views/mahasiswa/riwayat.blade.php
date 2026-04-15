@extends('layouts.student')

@section('title', 'Riwayat Pengajuan')
@section('page_title', 'Riwayat Pengajuan Saya')

@section('content')
    <div class="card border-0 rounded-4 shadow-sm overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 text-uppercase small fw-bold text-muted">ID / Program</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Tanggal</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Status</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Feedback Admin</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted pe-4 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-4">
                            <div class="fw-bold">B-2024001</div>
                            <small class="text-muted">Full Funded 2024</small>
                        </td>
                        <td>12 April 2024</td>
                        <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Terverifikasi</span></td>
                        <td><small class="text-muted">Dokumen valid, selamat!</small></td>
                        <td class="pe-4 text-end">
                            <button class="btn btn-sm btn-light border rounded-pill px-3">Detail</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-4">
                            <div class="fw-bold">B-2024045</div>
                            <small class="text-muted">Beasiswa Tahfidz</small>
                        </td>
                        <td>10 Mei 2024</td>
                        <td><span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">Antrean</span></td>
                        <td><small class="text-muted">-</small></td>
                        <td class="pe-4 text-end">
                            <button class="btn btn-sm btn-light border rounded-pill px-3">Detail</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
