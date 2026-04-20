@extends('layouts.student')

@section('title', 'Katalog Beasiswa')
@section('page_title', 'Katalog Beasiswa Tersedia')

@section('content')

<style>
    .search-bar { background:#fff; border-radius:20px; padding:1.5rem 2rem; box-shadow:0 4px 20px rgba(0,0,0,.06); border:1px solid #f1f5f9; margin-bottom:2rem; }
    .beasiswa-card { background:#fff; border-radius:20px; border:1px solid #f1f5f9; box-shadow:0 4px 16px rgba(0,0,0,.06); transition:all .3s ease; overflow:hidden; height:100%; display:flex; flex-direction:column; }
    .beasiswa-card:hover { transform:translateY(-6px); box-shadow:0 12px 32px rgba(59,130,246,.15); border-color:#bfdbfe; }
    .card-top-bar { height:5px; width:100%; }
    .bar-fully    { background:linear-gradient(90deg,#6d28d9,#8b5cf6); }
    .bar-partial  { background:linear-gradient(90deg,#1d4ed8,#3b82f6); }
    .bar-one      { background:linear-gradient(90deg,#b45309,#f59e0b); }
    .card-body-custom { padding:1.5rem; flex:1; display:flex; flex-direction:column; }
    .badge-kategori { padding:5px 14px; border-radius:20px; font-size:.72rem; font-weight:700; display:inline-block; margin-bottom:.75rem; }
    .badge-fully    { background:#ede9fe; color:#6d28d9; }
    .badge-partial  { background:#dbeafe; color:#1d4ed8; }
    .badge-one      { background:#fef3c7; color:#b45309; }
    .card-title-beasiswa { font-size:1.05rem; font-weight:700; color:#0f172a; margin-bottom:.5rem; }
    .card-sumber { font-size:.8rem; color:#64748b; font-weight:500; margin-bottom:1rem; display:flex; align-items:center; gap:6px; }
    .card-nominal { font-size:1.35rem; font-weight:800; color:#1d4ed8; margin-bottom:1rem; }
    .card-nominal small { font-size:.75rem; font-weight:500; color:#64748b; display:block; }
    .card-footer-custom { margin-top:auto; padding-top:1rem; border-top:1px solid #f1f5f9; display:flex; align-items:center; justify-content:space-between; gap:.5rem; }
    .btn-detail { border-radius:50px; padding:.45rem 1.2rem; font-size:.85rem; font-weight:600; border:2px solid #3b82f6; color:#3b82f6; background:transparent; transition:all .2s; text-decoration:none; }
    .btn-detail:hover { background:#3b82f6; color:#fff; }
    .empty-state { text-align:center; padding:4rem 2rem; color:#94a3b8; }
    .empty-state i { font-size:3.5rem; margin-bottom:1rem; display:block; }
    .filter-btn { border-radius:50px; padding:.4rem 1rem; font-size:.8rem; font-weight:600; border:2px solid #e2e8f0; color:#64748b; background:#fff; transition:all .2s; cursor:pointer; text-decoration:none; }
    .filter-btn:hover, .filter-btn.active { border-color:#3b82f6; color:#3b82f6; background:#eff6ff; }
    .stats-mini { display:flex; gap:1rem; flex-wrap:wrap; margin-bottom:1.5rem; }
    .stat-mini-item { background:#fff; border-radius:14px; padding:.75rem 1.25rem; border:1px solid #f1f5f9; box-shadow:0 2px 8px rgba(0,0,0,.05); font-size:.85rem; font-weight:600; display:flex; align-items:center; gap:.5rem; }
</style>

{{-- Statistik Mini --}}
<div class="stats-mini">
    <div class="stat-mini-item">
        <i class="bi bi-award-fill text-primary"></i>
        <span>{{ $beasiswas->count() }} Program Tersedia</span>
    </div>
    <div class="stat-mini-item">
        <i class="bi bi-patch-check-fill" style="color:#6d28d9;"></i>
        <span>{{ $beasiswas->where('kategori_dana','fully_funded')->count() }} Fully Funded</span>
    </div>
    <div class="stat-mini-item">
        <i class="bi bi-half" style="color:#1d4ed8;"></i>
        <span>{{ $beasiswas->where('kategori_dana','partially_funded')->count() }} Partially Funded</span>
    </div>
    <div class="stat-mini-item">
        <i class="bi bi-arrow-right-circle-fill" style="color:#b45309;"></i>
        <span>{{ $beasiswas->where('kategori_dana','one_shoot')->count() }} One Shoot</span>
    </div>
</div>

{{-- Search & Filter --}}
<div class="search-bar">
    <form action="{{ route('mahasiswa.katalog') }}" method="GET">
        <div class="row g-3 align-items-end">
            <div class="col-md-6">
                <label class="form-label fw-600 small text-uppercase text-muted mb-1">Cari Beasiswa</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 border-light">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-start-0 border-light bg-light"
                        placeholder="Nama program atau sumber dana..."
                        value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-600 small text-uppercase text-muted mb-1">Filter Kategori</label>
                <select name="kategori" class="form-select border-light bg-light">
                    <option value="">Semua Kategori</option>
                    <option value="fully_funded"     {{ request('kategori') === 'fully_funded'     ? 'selected' : '' }}>Fully Funded</option>
                    <option value="partially_funded" {{ request('kategori') === 'partially_funded' ? 'selected' : '' }}>Partially Funded</option>
                    <option value="one_shoot"        {{ request('kategori') === 'one_shoot'        ? 'selected' : '' }}>One Shoot</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary rounded-pill px-3 flex-fill fw-600">
                    <i class="bi bi-funnel-fill me-1"></i> Filter
                </button>
                @if(request('search') || request('kategori'))
                    <a href="{{ route('mahasiswa.katalog') }}" class="btn btn-light rounded-pill px-3 border">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>
        </div>
    </form>
</div>

{{-- Daftar Beasiswa --}}
@if($beasiswas->isEmpty())
    <div class="empty-state">
        <i class="bi bi-inbox"></i>
        <h5 class="fw-bold">Tidak Ada Program Ditemukan</h5>
        <p>Coba ubah kata kunci pencarian atau filter kategori Anda.</p>
        <a href="{{ route('mahasiswa.katalog') }}" class="btn btn-primary rounded-pill px-4 mt-2">
            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Pencarian
        </a>
    </div>
@else
    <div class="row g-4">
        @foreach($beasiswas as $b)
        <div class="col-md-6 col-xl-4">
            <div class="beasiswa-card">
                {{-- Warna bar atas berdasarkan kategori --}}
                <div class="card-top-bar
                    @if($b->kategori_dana === 'fully_funded') bar-fully
                    @elseif($b->kategori_dana === 'partially_funded') bar-partial
                    @else bar-one
                    @endif">
                </div>

                <div class="card-body-custom">
                    {{-- Badge kategori --}}
                    <span class="badge-kategori
                        @if($b->kategori_dana === 'fully_funded') badge-fully
                        @elseif($b->kategori_dana === 'partially_funded') badge-partial
                        @else badge-one
                        @endif">
                        @if($b->kategori_dana === 'fully_funded') <i class="bi bi-patch-check-fill me-1"></i> Fully Funded
                        @elseif($b->kategori_dana === 'partially_funded') <i class="bi bi-half me-1"></i> Partially Funded
                        @else <i class="bi bi-arrow-right-circle-fill me-1"></i> One Shoot
                        @endif
                    </span>

                    <h5 class="card-title-beasiswa">{{ $b->nama_beasiswa }}</h5>

                    <p class="card-sumber">
                        <i class="bi bi-building"></i> {{ $b->sumber_dana }}
                    </p>

                    <div class="card-nominal">
                        {{ $b->nominal_rupiah }}
                        <small>Nominal Bantuan</small>
                    </div>

                    <div class="card-footer-custom">
                        @if($b->link_pendaftaran_luar)
                            <a href="{{ $b->link_pendaftaran_luar }}" target="_blank" class="btn-detail">
                                <i class="bi bi-box-arrow-up-right me-1"></i> Daftar Eksternal
                            </a>
                        @else
                            <span class="btn-detail" style="opacity:.5; cursor:default;">Internal YARSI</span>
                        @endif
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3" style="font-size:.75rem;">
                            <i class="bi bi-circle-fill me-1" style="font-size:.5rem;"></i> Aktif
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif

@endsection
