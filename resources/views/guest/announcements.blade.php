@extends('layouts.app')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
    body { font-family: 'Inter', system-ui, sans-serif; }

    /* ─── Hero Banner ─── */
    .ann-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 55%, #1d4ed8 100%);
        padding: 80px 0 70px;
        position: relative;
        overflow: hidden;
    }
    .ann-hero::before {
        content: '';
        position: absolute; inset: 0;
        background-image: radial-gradient(circle at 75% 30%, rgba(99,102,241,.18) 0%, transparent 55%),
                          radial-gradient(circle at 15% 80%, rgba(59,130,246,.12) 0%, transparent 45%);
        pointer-events: none;
    }
    .ann-hero .dot-grid {
        position: absolute; inset: 0;
        background-image: radial-gradient(circle, rgba(255,255,255,.06) 1px, transparent 1px);
        background-size: 28px 28px;
        pointer-events: none;
    }

    /* ─── Section labels ─── */
    .sec-label {
        font-size: .72rem; font-weight: 700; letter-spacing: 1.5px;
        text-transform: uppercase; color: #1d4ed8; margin-bottom: 6px;
    }
    .sec-title {
        font-size: clamp(1.4rem, 2.5vw, 1.9rem);
        font-weight: 800; color: #0f172a; line-height: 1.25;
    }

    /* ─── Filter tabs ─── */
    .filter-tabs { display: flex; gap: 8px; flex-wrap: wrap; }
    .filter-tab {
        padding: 6px 16px; border-radius: 50px;
        font-size: .8rem; font-weight: 600;
        border: 1.5px solid #e5e7eb;
        background: #fff; color: #64748b;
        cursor: pointer; transition: all .2s;
    }
    .filter-tab.active, .filter-tab:hover {
        background: #1d4ed8; color: #fff; border-color: #1d4ed8;
    }

    /* ─── Scholarship Open Cards ─── */
    .schol-open-card {
        background: #fff;
        border: 1px solid #e8edf5;
        border-radius: 18px;
        padding: 24px;
        height: 100%;
        transition: transform .3s, box-shadow .3s;
        position: relative;
        overflow: hidden;
    }
    .schol-open-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 40px rgba(29,78,216,.1);
    }
    .schol-open-card .card-strip {
        position: absolute; top: 0; left: 0; right: 0; height: 4px;
    }

    .deadline-bar {
        background: #f8faff;
        border: 1px solid #e0e9ff;
        border-radius: 10px;
        padding: 10px 14px;
        display: flex; align-items: center; justify-content: space-between;
        margin-top: 16px;
    }
    .deadline-bar .dl-label { font-size: .73rem; color: #94a3b8; font-weight: 500; }
    .deadline-bar .dl-val   { font-size: .82rem; color: #0f172a; font-weight: 700; }

    .progress-thin {
        height: 5px; border-radius: 50px; background: #e8edf5; margin: 8px 0 4px;
    }
    .progress-thin .bar { height: 100%; border-radius: 50px; }

    /* ─── Timeline ─── */
    .timeline { position: relative; padding-left: 30px; }
    .timeline::before {
        content: '';
        position: absolute; left: 11px; top: 8px; bottom: 8px;
        width: 2px; background: linear-gradient(to bottom, #1d4ed8, #e0e9ff);
    }
    .tl-item { position: relative; margin-bottom: 0; padding-bottom: 28px; }
    .tl-item:last-child { padding-bottom: 0; }
    .tl-dot {
        position: absolute; left: -34px; top: 4px;
        width: 24px; height: 24px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: .65rem; font-weight: 700; border: 2.5px solid #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,.12);
        flex-shrink: 0;
    }
    .tl-card {
        background: #fff;
        border: 1px solid #e8edf5;
        border-radius: 14px;
        padding: 18px 20px;
        transition: box-shadow .25s;
    }
    .tl-card:hover { box-shadow: 0 8px 24px rgba(29,78,216,.08); }
    .tl-date { font-size: .73rem; color: #94a3b8; font-weight: 500; margin-bottom: 5px; }
    .tl-title { font-weight: 700; font-size: .92rem; color: #0f172a; margin-bottom: 6px; }
    .tl-body  { font-size: .82rem; color: #64748b; line-height: 1.65; margin: 0; }

    /* ─── News List Group ─── */
    .news-list-item {
        background: #fff;
        border: 1px solid #e8edf5 !important;
        border-radius: 14px !important;
        padding: 18px 20px;
        margin-bottom: 12px;
        display: flex; align-items: flex-start; gap: 14px;
        transition: box-shadow .25s;
        text-decoration: none;
    }
    .news-list-item:hover { box-shadow: 0 8px 24px rgba(29,78,216,.08); border-color: #bfdbfe !important; }
    .news-icon {
        width: 42px; height: 42px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem; flex-shrink: 0;
    }
    .news-title { font-size: .9rem; font-weight: 700; color: #0f172a; margin-bottom: 4px; }
    .news-meta  { font-size: .75rem; color: #94a3b8; display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
    .news-excerpt { font-size: .82rem; color: #64748b; line-height: 1.6; margin: 6px 0 0; }

    /* ─── Sidebar Widgets ─── */
    .sidebar-widget {
        background: #fff; border: 1px solid #e8edf5;
        border-radius: 18px; padding: 22px; margin-bottom: 20px;
    }
    .widget-title {
        font-size: .85rem; font-weight: 700; color: #0f172a;
        margin-bottom: 16px; padding-bottom: 12px;
        border-bottom: 1px solid #f1f5f9;
        display: flex; align-items: center; gap: 8px;
    }
    .stat-row {
        display: flex; align-items: center; justify-content: space-between;
        padding: 10px 0; border-bottom: 1px solid #f8fafc;
        font-size: .82rem;
    }
    .stat-row:last-child { border-bottom: none; padding-bottom: 0; }
    .stat-val { font-weight: 800; font-size: 1.15rem; color: #1d4ed8; }
    .stat-lbl { color: #64748b; }

    .quick-link-item {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 0; border-bottom: 1px solid #f8fafc;
        color: #374151; font-size: .82rem; text-decoration: none;
        transition: color .2s;
    }
    .quick-link-item:last-child { border-bottom: none; }
    .quick-link-item:hover { color: #1d4ed8; }
    .quick-link-item i { width: 22px; text-align: center; color: #1d4ed8; }

    /* ─── Badge overrides ─── */
    .bdg { display: inline-flex; align-items: center; gap: 4px; border-radius: 50px; padding: 3px 10px; font-size: .72rem; font-weight: 700; }
    .bdg-blue   { background: #eff6ff; color: #1d4ed8; }
    .bdg-green  { background: #f0fdf4; color: #15803d; }
    .bdg-amber  { background: #fffbeb; color: #b45309; }
    .bdg-red    { background: #fef2f2; color: #991b1b; }
    .bdg-purple { background: #f5f3ff; color: #6d28d9; }
    .bdg-slate  { background: #f8fafc; color: #475569; }
    .bdg-pulse::before {
        content: ''; display: inline-block;
        width: 6px; height: 6px; border-radius: 50%;
        background: currentColor; animation: pulse-dot 1.5s infinite;
    }
    @keyframes pulse-dot {
        0%, 100% { opacity: 1; } 50% { opacity: .3; }
    }

    /* ─── Animate ─── */
    .fade-up { opacity: 0; transform: translateY(24px); transition: opacity .55s ease, transform .55s ease; }
    .fade-up.visible { opacity: 1; transform: translateY(0); }
</style>
@endpush

@section('content')

{{-- ══════════ HERO ══════════ --}}
<section class="ann-hero">
    <div class="dot-grid"></div>
    <div class="container position-relative text-white">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="bdg bdg-pulse mb-3" style="background:rgba(255,255,255,.15);color:#93c5fd">
                    <i class="bi bi-broadcast"></i> Live Update
                </span>
                <h1 class="fw-bolder mb-3" style="font-size:clamp(1.8rem,4vw,2.8rem);line-height:1.2">
                    Pengumuman &amp;<br>Informasi Beasiswa
                </h1>
                <p class="mb-0" style="color:rgba(255,255,255,.75);font-size:1rem;max-width:520px;line-height:1.75">
                    Pantau beasiswa yang sedang dibuka, hasil seleksi terkini, dan pembaruan sistem
                    Beasiswa YARSI — semua tersaji di satu halaman.
                </p>
            </div>
            <div class="col-lg-5">
                <div class="d-flex gap-3 justify-content-lg-end flex-wrap">
                    <div class="text-center px-4 py-3 rounded-4" style="background:rgba(255,255,255,.1);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.15)">
                        <div class="fw-black" style="font-size:2rem;line-height:1">3</div>
                        <div style="font-size:.75rem;opacity:.75">Beasiswa Aktif</div>
                    </div>
                    <div class="text-center px-4 py-3 rounded-4" style="background:rgba(255,255,255,.1);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.15)">
                        <div class="fw-black" style="font-size:2rem;line-height:1">12</div>
                        <div style="font-size:.75rem;opacity:.75">Pengumuman Baru</div>
                    </div>
                    <div class="text-center px-4 py-3 rounded-4" style="background:rgba(255,255,255,.1);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.15)">
                        <div class="fw-black" style="font-size:2rem;line-height:1">5</div>
                        <div style="font-size:.75rem;opacity:.75">Hari Tersisa</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════ MAIN CONTENT ══════════ --}}
<section class="py-5" style="background:#f8faff;min-height:60vh">
    <div class="container py-3">
        <div class="row g-4">

            {{-- ══ LEFT / MAIN COLUMN ══ --}}
            <div class="col-lg-8">

                {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
                     SECTION 1 — Beasiswa yang Sedang Dibuka
                ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
                <div class="mb-5 fade-up">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <p class="sec-label mb-1"><i class="bi bi-collection-fill me-1"></i>Pendaftaran Dibuka</p>
                            <h2 class="sec-title">Daftar Beasiswa Aktif</h2>
                        </div>
                        <span class="bdg bdg-green bdg-pulse">Sedang Berjalan</span>
                    </div>

                    <div class="row g-3">

                        {{-- Card 1: KIP Kuliah --}}
                        <div class="col-md-6 fade-up" style="transition-delay:.05s">
                            <div class="schol-open-card">
                                <div class="card-strip" style="background:linear-gradient(90deg,#1d4ed8,#6366f1)"></div>
                                <div class="d-flex justify-content-between align-items-start mb-3 mt-1">
                                    <span class="bdg bdg-blue"><i class="bi bi-mortarboard-fill"></i> Full Funded</span>
                                    <span class="bdg bdg-green bdg-pulse">Dibuka</span>
                                </div>
                                <h3 class="fw-bold mb-1" style="font-size:1rem;color:#0f172a">KIP Kuliah 2025/2026</h3>
                                <p class="mb-0" style="font-size:.8rem;color:#64748b;line-height:1.6">
                                    Beasiswa pemerintah untuk mahasiswa kurang mampu berprestasi. Menanggung biaya UKT penuh + biaya hidup.
                                </p>
                                <div class="deadline-bar">
                                    <div>
                                        <div class="dl-label">Deadline Pendaftaran</div>
                                        <div class="dl-val">30 April 2025</div>
                                    </div>
                                    <span class="bdg bdg-amber"><i class="bi bi-clock-fill"></i> 5 Hari Lagi</span>
                                </div>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-between" style="font-size:.73rem;color:#94a3b8">
                                        <span>Kuota terisi</span><span class="fw-bold text-dark">68 / 100 Slot</span>
                                    </div>
                                    <div class="progress-thin">
                                        <div class="bar" style="width:68%;background:linear-gradient(90deg,#1d4ed8,#6366f1)"></div>
                                    </div>
                                </div>
                                <a href="{{ route('login') }}" class="btn btn-primary w-100 rounded-3 mt-3 fw-semibold" style="font-size:.85rem">
                                    <i class="bi bi-box-arrow-in-right me-1"></i> Daftar Sekarang
                                </a>
                            </div>
                        </div>

                        {{-- Card 2: Beasiswa Yayasan YARSI --}}
                        <div class="col-md-6 fade-up" style="transition-delay:.1s">
                            <div class="schol-open-card">
                                <div class="card-strip" style="background:linear-gradient(90deg,#7c3aed,#a855f7)"></div>
                                <div class="d-flex justify-content-between align-items-start mb-3 mt-1">
                                    <span class="bdg bdg-purple"><i class="bi bi-award-fill"></i> Partially Funded</span>
                                    <span class="bdg bdg-green bdg-pulse">Dibuka</span>
                                </div>
                                <h3 class="fw-bold mb-1" style="font-size:1rem;color:#0f172a">Beasiswa Yayasan YARSI</h3>
                                <p class="mb-0" style="font-size:.8rem;color:#64748b;line-height:1.6">
                                    Bantuan biaya pendidikan 50% dari Yayasan YARSI untuk mahasiswa berprestasi dengan IPK ≥ 3.25.
                                </p>
                                <div class="deadline-bar">
                                    <div>
                                        <div class="dl-label">Deadline Pendaftaran</div>
                                        <div class="dl-val">15 Mei 2025</div>
                                    </div>
                                    <span class="bdg bdg-blue"><i class="bi bi-clock-fill"></i> 20 Hari Lagi</span>
                                </div>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-between" style="font-size:.73rem;color:#94a3b8">
                                        <span>Kuota terisi</span><span class="fw-bold text-dark">30 / 50 Slot</span>
                                    </div>
                                    <div class="progress-thin">
                                        <div class="bar" style="width:60%;background:linear-gradient(90deg,#7c3aed,#a855f7)"></div>
                                    </div>
                                </div>
                                <a href="{{ route('login') }}" class="btn btn-outline-primary w-100 rounded-3 mt-3 fw-semibold" style="font-size:.85rem">
                                    <i class="bi bi-box-arrow-in-right me-1"></i> Daftar Sekarang
                                </a>
                            </div>
                        </div>

                        {{-- Card 3: Beasiswa One Shot --}}
                        <div class="col-md-6 fade-up" style="transition-delay:.15s">
                            <div class="schol-open-card">
                                <div class="card-strip" style="background:linear-gradient(90deg,#f59e0b,#f97316)"></div>
                                <div class="d-flex justify-content-between align-items-start mb-3 mt-1">
                                    <span class="bdg bdg-amber"><i class="bi bi-lightning-fill"></i> One Shot</span>
                                    <span class="bdg bdg-green bdg-pulse">Dibuka</span>
                                </div>
                                <h3 class="fw-bold mb-1" style="font-size:1rem;color:#0f172a">Bantuan Insidental Semester Genap</h3>
                                <p class="mb-0" style="font-size:.8rem;color:#64748b;line-height:1.6">
                                    Dana bantuan sekali pemberian untuk mahasiswa yang mengalami kondisi darurat atau kesulitan tiba-tiba.
                                </p>
                                <div class="deadline-bar">
                                    <div>
                                        <div class="dl-label">Deadline Pendaftaran</div>
                                        <div class="dl-val">30 April 2025</div>
                                    </div>
                                    <span class="bdg bdg-amber"><i class="bi bi-clock-fill"></i> 5 Hari Lagi</span>
                                </div>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-between" style="font-size:.73rem;color:#94a3b8">
                                        <span>Kuota terisi</span><span class="fw-bold text-dark">12 / 25 Slot</span>
                                    </div>
                                    <div class="progress-thin">
                                        <div class="bar" style="width:48%;background:linear-gradient(90deg,#f59e0b,#f97316)"></div>
                                    </div>
                                </div>
                                <a href="{{ route('login') }}" class="btn btn-outline-warning w-100 rounded-3 mt-3 fw-semibold text-dark" style="font-size:.85rem">
                                    <i class="bi bi-box-arrow-in-right me-1"></i> Ajukan Bantuan
                                </a>
                            </div>
                        </div>

                        {{-- Card 4: Segera Dibuka --}}
                        <div class="col-md-6 fade-up" style="transition-delay:.2s">
                            <div class="schol-open-card" style="opacity:.75">
                                <div class="card-strip" style="background:#e5e7eb"></div>
                                <div class="d-flex justify-content-between align-items-start mb-3 mt-1">
                                    <span class="bdg bdg-slate"><i class="bi bi-globe"></i> LPDP</span>
                                    <span class="bdg bdg-slate"><i class="bi bi-hourglass-split"></i> Segera Dibuka</span>
                                </div>
                                <h3 class="fw-bold mb-1" style="font-size:1rem;color:#0f172a">LPDP Reguler 2025</h3>
                                <p class="mb-0" style="font-size:.8rem;color:#64748b;line-height:1.6">
                                    Beasiswa pemerintah untuk jenjang S2/S3 dalam negeri & luar negeri. Akan dibuka bulan Juni 2025.
                                </p>
                                <div class="deadline-bar" style="background:#f8f9fa">
                                    <div>
                                        <div class="dl-label">Perkiraan Pembukaan</div>
                                        <div class="dl-val">1 Juni 2025</div>
                                    </div>
                                    <span class="bdg bdg-slate"><i class="bi bi-bell"></i> Ingatkan Saya</span>
                                </div>
                                <button class="btn btn-outline-secondary w-100 rounded-3 mt-3 fw-semibold" style="font-size:.85rem" disabled>
                                    <i class="bi bi-lock-fill me-1"></i> Belum Dibuka
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
                     SECTION 2 — Pengumuman Hasil Seleksi (Timeline)
                ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
                <div class="mb-5 fade-up">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <p class="sec-label mb-1"><i class="bi bi-journal-check me-1"></i>Hasil Seleksi</p>
                            <h2 class="sec-title">Pengumuman Hasil Seleksi</h2>
                        </div>
                    </div>

                    <div class="timeline">

                        <div class="tl-item fade-up" style="transition-delay:.05s">
                            <div class="tl-dot" style="background:#16a34a;color:#fff"><i class="bi bi-check-lg" style="font-size:.7rem"></i></div>
                            <div class="tl-card">
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
                                    <div class="tl-date"><i class="bi bi-calendar3 me-1"></i>28 Maret 2025</div>
                                    <span class="bdg bdg-green"><i class="bi bi-check-circle-fill"></i> Diumumkan</span>
                                </div>
                                <h3 class="tl-title">Hasil Seleksi KIP Kuliah Tahap 1 — Semester Genap 2024/2025</h3>
                                <p class="tl-body">Sebanyak <strong>45 mahasiswa</strong> dinyatakan lolos seleksi administrasi KIP Kuliah Tahap 1. Peserta lolos dimohon untuk melengkapi berkas fisik paling lambat 10 April 2025.</p>
                                <div class="d-flex gap-2 mt-3 flex-wrap">
                                    <span class="bdg bdg-green">45 Lolos</span>
                                    <span class="bdg bdg-red">12 Tidak Lolos</span>
                                    <span class="bdg bdg-amber">8 Cadangan</span>
                                    <a href="{{ route('login') }}" class="bdg bdg-blue ms-auto text-decoration-none"><i class="bi bi-eye-fill"></i> Lihat Daftar</a>
                                </div>
                            </div>
                        </div>

                        <div class="tl-item fade-up" style="transition-delay:.1s">
                            <div class="tl-dot" style="background:#1d4ed8;color:#fff"><i class="bi bi-check-lg" style="font-size:.7rem"></i></div>
                            <div class="tl-card">
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
                                    <div class="tl-date"><i class="bi bi-calendar3 me-1"></i>20 Maret 2025</div>
                                    <span class="bdg bdg-blue"><i class="bi bi-check-circle-fill"></i> Diumumkan</span>
                                </div>
                                <h3 class="tl-title">Pengumuman Penerima Beasiswa Yayasan YARSI — Semester Gasal 2024/2025</h3>
                                <p class="tl-body"><strong>28 mahasiswa</strong> terpilih sebagai penerima Beasiswa Yayasan YARSI untuk semester gasal 2024/2025. Selamat kepada seluruh penerima! Pencairan akan dilakukan pada 1 April 2025.</p>
                                <div class="d-flex gap-2 mt-3 flex-wrap">
                                    <span class="bdg bdg-blue">28 Penerima</span>
                                    <span class="bdg bdg-purple">Partially Funded</span>
                                    <a href="{{ route('login') }}" class="bdg bdg-blue ms-auto text-decoration-none"><i class="bi bi-eye-fill"></i> Lihat Daftar</a>
                                </div>
                            </div>
                        </div>

                        <div class="tl-item fade-up" style="transition-delay:.15s">
                            <div class="tl-dot" style="background:#7c3aed;color:#fff"><i class="bi bi-check-lg" style="font-size:.7rem"></i></div>
                            <div class="tl-card">
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
                                    <div class="tl-date"><i class="bi bi-calendar3 me-1"></i>10 Maret 2025</div>
                                    <span class="bdg bdg-purple"><i class="bi bi-check-circle-fill"></i> Diumumkan</span>
                                </div>
                                <h3 class="tl-title">Hasil Verifikasi Dokumen Bantuan Insidental One Shot — Batch Q1 2025</h3>
                                <p class="tl-body">Proses verifikasi dokumen untuk <strong>Batch Q1 2025</strong> telah selesai. Dari 25 pengajuan, 18 berhasil diverifikasi dan 7 dikembalikan untuk perbaikan dokumen.</p>
                                <div class="d-flex gap-2 mt-3 flex-wrap">
                                    <span class="bdg bdg-green">18 Disetujui</span>
                                    <span class="bdg bdg-amber">7 Revisi Dokumen</span>
                                    <a href="{{ route('login') }}" class="bdg bdg-blue ms-auto text-decoration-none"><i class="bi bi-eye-fill"></i> Lihat Detail</a>
                                </div>
                            </div>
                        </div>

                        <div class="tl-item fade-up" style="transition-delay:.2s">
                            <div class="tl-dot" style="background:#94a3b8;color:#fff"><i class="bi bi-clock-fill" style="font-size:.55rem"></i></div>
                            <div class="tl-card" style="border-style:dashed;background:#fafbff">
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
                                    <div class="tl-date"><i class="bi bi-calendar3 me-1"></i>Dijadwalkan: 10 Mei 2025</div>
                                    <span class="bdg bdg-slate"><i class="bi bi-hourglass-split"></i> Akan Datang</span>
                                </div>
                                <h3 class="tl-title">Pengumuman Hasil Seleksi KIP Kuliah Tahap 2 — Semester Genap 2024/2025</h3>
                                <p class="tl-body text-muted">Pengumuman tahap 2 dijadwalkan pada 10 Mei 2025. Pastikan Anda telah melengkapi semua dokumen persyaratan sebelum tanggal tersebut.</p>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
                     SECTION 3 — Berita & Pembaruan Sistem (List Group)
                ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
                <div class="fade-up">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <p class="sec-label mb-1"><i class="bi bi-newspaper me-1"></i>Berita & Sistem</p>
                            <h2 class="sec-title">Berita &amp; Pembaruan Sistem</h2>
                        </div>
                        <div class="filter-tabs">
                            <button class="filter-tab active" data-filter="all">Semua</button>
                            <button class="filter-tab" data-filter="berita">Berita</button>
                            <button class="filter-tab" data-filter="sistem">Sistem</button>
                        </div>
                    </div>

                    <div id="newsList">

                        <a href="#" class="news-list-item d-flex" data-category="sistem">
                            <div class="news-icon" style="background:#eff6ff;color:#1d4ed8"><i class="bi bi-lightning-charge-fill"></i></div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                                    <span class="news-title">Sistem Beasiswa YARSI v2.0 Resmi Diluncurkan</span>
                                </div>
                                <div class="news-meta">
                                    <span><i class="bi bi-calendar3"></i> 1 April 2025</span>
                                    <span class="bdg bdg-blue" style="padding:2px 8px;font-size:.68rem"><i class="bi bi-gear-fill"></i> Update Sistem</span>
                                    <span class="bdg bdg-green" style="padding:2px 8px;font-size:.68rem">Baru</span>
                                </div>
                                <p class="news-excerpt">Platform baru hadir dengan tampilan yang lebih modern, proses upload dokumen lebih cepat, dan notifikasi real-time untuk setiap perubahan status pengajuan beasiswa.</p>
                            </div>
                            <div class="ms-2 text-muted" style="font-size:.8rem;white-space:nowrap;padding-top:2px">
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </a>

                        <a href="#" class="news-list-item d-flex" data-category="berita">
                            <div class="news-icon" style="background:#f0fdf4;color:#15803d"><i class="bi bi-trophy-fill"></i></div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                                    <span class="news-title">YARSI Raih Penghargaan Perguruan Tinggi Terbaik dalam Pengelolaan Beasiswa 2025</span>
                                </div>
                                <div class="news-meta">
                                    <span><i class="bi bi-calendar3"></i> 28 Maret 2025</span>
                                    <span class="bdg bdg-green" style="padding:2px 8px;font-size:.68rem"><i class="bi bi-newspaper"></i> Berita</span>
                                </div>
                                <p class="news-excerpt">Universitas YARSI berhasil meraih penghargaan dari Kemendikbudristek atas keberhasilan dalam pengelolaan dan penyaluran beasiswa mahasiswa yang transparan dan tepat sasaran.</p>
                            </div>
                            <div class="ms-2 text-muted" style="font-size:.8rem;white-space:nowrap;padding-top:2px">
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </a>

                        <a href="#" class="news-list-item d-flex" data-category="sistem">
                            <div class="news-icon" style="background:#fffbeb;color:#b45309"><i class="bi bi-tools"></i></div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                                    <span class="news-title">Pemeliharaan Sistem Dijadwalkan 5 April 2025 Pukul 00.00–04.00 WIB</span>
                                </div>
                                <div class="news-meta">
                                    <span><i class="bi bi-calendar3"></i> 25 Maret 2025</span>
                                    <span class="bdg bdg-amber" style="padding:2px 8px;font-size:.68rem"><i class="bi bi-exclamation-triangle-fill"></i> Maintenance</span>
                                </div>
                                <p class="news-excerpt">Sistem akan mengalami downtime terjadwal untuk peningkatan performa server dan pembaruan keamanan. Harap simpan semua pekerjaan sebelum waktu pemeliharaan.</p>
                            </div>
                            <div class="ms-2 text-muted" style="font-size:.8rem;white-space:nowrap;padding-top:2px">
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </a>

                        <a href="#" class="news-list-item d-flex" data-category="berita">
                            <div class="news-icon" style="background:#f5f3ff;color:#6d28d9"><i class="bi bi-people-fill"></i></div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                                    <span class="news-title">Sosialisasi Program Beasiswa Semester Genap untuk Mahasiswa Baru</span>
                                </div>
                                <div class="news-meta">
                                    <span><i class="bi bi-calendar3"></i> 20 Maret 2025</span>
                                    <span class="bdg bdg-purple" style="padding:2px 8px;font-size:.68rem"><i class="bi bi-newspaper"></i> Berita</span>
                                </div>
                                <p class="news-excerpt">Panitia beasiswa YARSI mengadakan sesi sosialisasi online via Zoom untuk mahasiswa baru angkatan 2024. Rekaman tersedia di kanal YouTube resmi YARSI.</p>
                            </div>
                            <div class="ms-2 text-muted" style="font-size:.8rem;white-space:nowrap;padding-top:2px">
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </a>

                        <a href="#" class="news-list-item d-flex" data-category="sistem">
                            <div class="news-icon" style="background:#fef2f2;color:#991b1b"><i class="bi bi-shield-exclamation"></i></div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                                    <span class="news-title">Peringatan: Jangan Bagikan Kredensial Akun SSO YARSI kepada Siapapun</span>
                                </div>
                                <div class="news-meta">
                                    <span><i class="bi bi-calendar3"></i> 15 Maret 2025</span>
                                    <span class="bdg bdg-red" style="padding:2px 8px;font-size:.68rem"><i class="bi bi-shield-x"></i> Keamanan</span>
                                </div>
                                <p class="news-excerpt">Tim IT mengingatkan seluruh civitas akademika untuk tidak membagikan username dan password sistem kepada pihak lain. Laporan penipuan mengatasnamakan panitia beasiswa semakin meningkat.</p>
                            </div>
                            <div class="ms-2 text-muted" style="font-size:.8rem;white-space:nowrap;padding-top:2px">
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </a>

                    </div>
                </div>

            </div>{{-- /main col --}}

            {{-- ══ RIGHT SIDEBAR ══ --}}
            <div class="col-lg-4">

                {{-- Widget: Statistik --}}
                <div class="sidebar-widget fade-up">
                    <div class="widget-title">
                        <i class="bi bi-bar-chart-fill text-primary"></i> Statistik Beasiswa
                    </div>
                    <div class="stat-row">
                        <span class="stat-lbl">Total Penerima Aktif</span>
                        <span class="stat-val">1.247</span>
                    </div>
                    <div class="stat-row">
                        <span class="stat-lbl">Pengajuan Bulan Ini</span>
                        <span class="stat-val">87</span>
                    </div>
                    <div class="stat-row">
                        <span class="stat-lbl">Sedang Divalidasi</span>
                        <span class="stat-val" style="color:#f59e0b">23</span>
                    </div>
                    <div class="stat-row">
                        <span class="stat-lbl">Disetujui Bulan Ini</span>
                        <span class="stat-val" style="color:#15803d">64</span>
                    </div>
                    <div class="stat-row">
                        <span class="stat-lbl">Ditolak / Revisi</span>
                        <span class="stat-val" style="color:#dc2626">12</span>
                    </div>
                </div>

                {{-- Widget: Kalender Deadline --}}
                <div class="sidebar-widget fade-up" style="transition-delay:.05s">
                    <div class="widget-title">
                        <i class="bi bi-calendar-event-fill text-primary"></i> Kalender Deadline
                    </div>
                    @php
                        $deadlines = [
                            ['tanggal'=>'30 Apr', 'nama'=>'KIP Kuliah Tahap 1', 'sisa'=>5, 'color'=>'#dc2626'],
                            ['tanggal'=>'10 Mei', 'nama'=>'Pengumuman KIP Tahap 2', 'sisa'=>15, 'color'=>'#f59e0b'],
                            ['tanggal'=>'15 Mei', 'nama'=>'Beasiswa Yayasan YARSI', 'sisa'=>20, 'color'=>'#1d4ed8'],
                            ['tanggal'=>'30 Mei', 'nama'=>'One Shot Batch Q2', 'sisa'=>35, 'color'=>'#7c3aed'],
                            ['tanggal'=>'1 Jun',  'nama'=>'Pembukaan LPDP Reguler', 'sisa'=>37, 'color'=>'#64748b'],
                        ];
                    @endphp
                    @foreach($deadlines as $dl)
                    <div class="d-flex align-items-center gap-3 py-2 border-bottom" style="border-color:#f8fafc!important;font-size:.82rem">
                        <div class="text-center flex-shrink-0" style="width:38px">
                            <div class="fw-black" style="font-size:.9rem;color:{{ $dl['color'] }};line-height:1">{{ explode(' ',$dl['tanggal'])[0] }}</div>
                            <div style="font-size:.62rem;color:#94a3b8;text-transform:uppercase">{{ explode(' ',$dl['tanggal'])[1] }}</div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-semibold text-dark">{{ $dl['nama'] }}</div>
                        </div>
                        <span class="bdg" style="background:{{ $dl['color'] }}18;color:{{ $dl['color'] }};padding:2px 8px;font-size:.65rem;white-space:nowrap">
                            {{ $dl['sisa'] }}h
                        </span>
                    </div>
                    @endforeach
                </div>

                {{-- Widget: Tautan Cepat --}}
                <div class="sidebar-widget fade-up" style="transition-delay:.1s">
                    <div class="widget-title">
                        <i class="bi bi-grid-fill text-primary"></i> Tautan Cepat
                    </div>
                    <a href="{{ route('login') }}" class="quick-link-item">
                        <i class="bi bi-person-plus-fill"></i> Daftar Beasiswa Baru
                    </a>
                    <a href="{{ route('login') }}" class="quick-link-item">
                        <i class="bi bi-search"></i> Cek Status Pengajuan
                    </a>
                    <a href="{{ route('guest.faq') }}" class="quick-link-item">
                        <i class="bi bi-question-circle-fill"></i> Panduan & FAQ
                    </a>
                    <a href="{{ route('guest.faq') }}" class="quick-link-item">
                        <i class="bi bi-diagram-3-fill"></i> Alur Pendaftaran
                    </a>
                    <a href="mailto:beasiswa@yarsi.ac.id" class="quick-link-item">
                        <i class="bi bi-envelope-fill"></i> Hubungi Panitia
                    </a>
                    <a href="tel:+62214206674" class="quick-link-item">
                        <i class="bi bi-telephone-fill"></i> +62 21 420 6674
                    </a>
                </div>

                {{-- Widget: CTA Login --}}
                <div class="fade-up" style="transition-delay:.15s">
                    <div class="rounded-4 p-4 text-white text-center"
                         style="background:linear-gradient(135deg,#1d4ed8,#7c3aed)">
                        <i class="bi bi-bell-fill fs-2 mb-3 d-block" style="opacity:.9"></i>
                        <h6 class="fw-bold mb-2">Aktifkan Notifikasi</h6>
                        <p style="font-size:.82rem;opacity:.85;line-height:1.6">
                            Masuk ke sistem untuk mendapatkan notifikasi otomatis saat ada pengumuman baru.
                        </p>
                        <a href="{{ route('login') }}" class="btn btn-light btn-sm rounded-pill px-4 fw-semibold">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Sekarang
                        </a>
                    </div>
                </div>

            </div>{{-- /sidebar --}}

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // ── Scroll animation ──
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); }
        });
    }, { threshold: 0.08 });
    document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

    // ── News category filter ──
    document.querySelectorAll('.filter-tab').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.filter-tab').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const filter = this.dataset.filter;
            document.querySelectorAll('#newsList .news-list-item').forEach(item => {
                const cat = item.dataset.category;
                item.style.display = (filter === 'all' || cat === filter) ? 'flex' : 'none';
            });
        });
    });
</script>
@endpush
