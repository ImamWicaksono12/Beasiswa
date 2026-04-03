@extends('layouts.app')

@push('styles')
<style>
    /* ══════════════════════════════════════════════════════════════
       GOOGLE FONT
    ══════════════════════════════════════════════════════════════ */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

    body { font-family: 'Inter', system-ui, sans-serif; }

    /* ══════════════════════════════════════════════════════════════
       HERO SECTION
    ══════════════════════════════════════════════════════════════ */
    .hero-section {
        background: #ffffff;
        padding: 80px 0 0;
        overflow: hidden;
    }

    /* ── Announcement badge (pill at the top) ── */
    .hero-announce {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 50px;
        padding: 6px 14px 6px 6px;
        font-size: .8rem;
        font-weight: 500;
        color: #1e40af;
        text-decoration: none;
        transition: box-shadow .2s;
        margin-bottom: 24px;
    }
    .hero-announce:hover { box-shadow: 0 0 0 3px rgba(59,130,246,.15); }
    .hero-announce .ann-badge {
        background: #1d4ed8;
        color: #fff;
        border-radius: 50px;
        padding: 3px 10px;
        font-size: .73rem;
        font-weight: 600;
        letter-spacing: .3px;
    }

    /* ── Headings ── */
    .hero-heading {
        font-size: clamp(2rem, 5vw, 3.2rem);
        font-weight: 900;
        line-height: 1.15;
        color: #0f172a;
        letter-spacing: -.5px;
    }
    .hero-heading .text-accent { color: #1d4ed8; }

    .hero-sub {
        font-size: 1.05rem;
        color: #64748b;
        line-height: 1.8;
        max-width: 520px;
    }

    /* ── CTA Buttons ── */
    .btn-hero-primary {
        background: #1d4ed8;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 13px 26px;
        font-size: .95rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all .25s;
        box-shadow: 0 4px 14px rgba(29,78,216,.35);
    }
    .btn-hero-primary:hover {
        background: #1e40af;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(29,78,216,.45);
    }

    .btn-hero-secondary {
        background: transparent;
        color: #374151;
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        padding: 12px 24px;
        font-size: .95rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all .25s;
    }
    .btn-hero-secondary:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #1d4ed8;
    }

    /* ── Review / Trust bar ── */
    .hero-trust {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-top: 2rem;
        flex-wrap: wrap;
    }
    .avatar-stack {
        display: flex;
    }
    .avatar-stack .av {
        width: 36px; height: 36px;
        border-radius: 50%;
        border: 2.5px solid #fff;
        background: #e0e7ff;
        overflow: hidden;
        margin-left: -10px;
        display: flex; align-items: center; justify-content: center;
        font-size: .7rem; font-weight: 700; color: #3b4ac8;
        flex-shrink: 0;
    }
    .avatar-stack .av:first-child { margin-left: 0; }
    .avatar-stack .av img { width: 100%; height: 100%; object-fit: cover; }

    .trust-text { font-size: .82rem; color: #64748b; line-height: 1.5; }
    .trust-text strong { display: block; color: #0f172a; font-weight: 700; font-size: .88rem; }
    .trust-stars { color: #f59e0b; font-size: .85rem; letter-spacing: 1px; }

    .trust-divider {
        width: 1px; height: 36px;
        background: #e5e7eb;
    }

    .trust-stat { text-align: center; }
    .trust-stat .val { font-size: 1.35rem; font-weight: 800; color: #0f172a; line-height: 1; }
    .trust-stat .lbl { font-size: .75rem; color: #94a3b8; margin-top: 2px; }

    /* ── Hero Image Column ── */
    .hero-img-col { position: relative; }

    /* decorative blob behind image */
    .hero-img-col::before {
        content: '';
        position: absolute;
        top: 30px; right: -20px;
        width: 90%; height: 90%;
        background: #eff6ff;
        border-radius: 24px;
        z-index: 0;
    }
    .hero-img-wrap {
        position: relative;
        z-index: 1;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 24px 60px rgba(0,0,0,.12);
    }
    .hero-img-wrap img {
        width: 100%;
        height: 480px;
        object-fit: cover;
        display: block;
    }

    /* floating review card */
    .review-float-card {
        position: absolute;
        bottom: -20px;
        left: -30px;
        z-index: 2;
        background: #fff;
        border-radius: 16px;
        padding: 14px 18px;
        box-shadow: 0 10px 40px rgba(0,0,0,.12);
        min-width: 220px;
        border: 1px solid #f1f5f9;
    }
    .review-float-card .rf-stars { color: #f59e0b; font-size: .9rem; }
    .review-float-card .rf-quote {
        font-size: .8rem; color: #374151; line-height: 1.5; margin: 6px 0 10px;
        font-style: italic;
    }
    .review-float-card .rf-author { display: flex; align-items: center; gap: 8px; }
    .review-float-card .rf-av {
        width: 30px; height: 30px; border-radius: 50%;
        background: linear-gradient(135deg, #1d4ed8, #7c3aed);
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: .65rem; font-weight: 700; flex-shrink: 0;
    }
    .review-float-card .rf-name { font-size: .78rem; font-weight: 700; color: #0f172a; }
    .review-float-card .rf-role { font-size: .7rem; color: #94a3b8; }

    /* badge floating top-right */
    .badge-float {
        position: absolute;
        top: 20px; right: -16px;
        z-index: 2;
        background: #fff;
        border-radius: 12px;
        padding: 10px 14px;
        box-shadow: 0 8px 24px rgba(0,0,0,.1);
        text-align: center;
        border: 1px solid #f1f5f9;
    }
    .badge-float .bf-val { font-size: 1.4rem; font-weight: 900; color: #1d4ed8; line-height: 1; }
    .badge-float .bf-lbl { font-size: .65rem; color: #64748b; margin-top: 2px; }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       LOGO / PARTNER BAR
    ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    .partner-bar {
        background: #fafafa;
        border-top: 1px solid #f1f3f9;
        border-bottom: 1px solid #f1f3f9;
        padding: 28px 0;
        margin-top: 60px;
    }
    .partner-bar .pb-label {
        font-size: .75rem;
        font-weight: 600;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 1px;
        white-space: nowrap;
    }
    .partner-logos {
        display: flex;
        align-items: center;
        gap: 40px;
        flex-wrap: wrap;
        justify-content: center;
    }
    .partner-logo-item {
        font-size: .78rem;
        font-weight: 700;
        color: #cbd5e1;
        letter-spacing: .5px;
        display: flex;
        align-items: center;
        gap: 7px;
        transition: color .2s;
    }
    .partner-logo-item:hover { color: #94a3b8; }
    .partner-logo-item i { font-size: 1.1rem; }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       FEATURE CARDS SECTION
    ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    .features-section { padding: 80px 0; background: #fff; }

    .feature-card {
        border: 1px solid #e8edf5;
        border-radius: 18px;
        padding: 30px 26px;
        height: 100%;
        transition: transform .3s, box-shadow .3s;
        background: #fff;
        position: relative;
        overflow: hidden;
    }
    .feature-card::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, #1d4ed8, #7c3aed);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform .3s;
    }
    .feature-card:hover { transform: translateY(-6px); box-shadow: 0 20px 48px rgba(29,78,216,.1); }
    .feature-card:hover::after { transform: scaleX(1); }

    .fc-icon {
        width: 52px; height: 52px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 18px;
    }
    .fc-icon-blue   { background: #eff6ff; color: #1d4ed8; }
    .fc-icon-purple { background: #f5f3ff; color: #7c3aed; }
    .fc-icon-green  { background: #f0fdf4; color: #15803d; }
    .fc-icon-amber  { background: #fffbeb; color: #b45309; }

    .fc-title { font-weight: 700; font-size: 1rem; color: #0f172a; margin-bottom: 8px; }
    .fc-desc  { font-size: .875rem; color: #64748b; line-height: 1.7; margin: 0; }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       SCHOLARSHIP TYPE CARDS
    ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    .scholarship-section {
        background: #f8faff;
        padding: 80px 0;
    }
    .sec-label {
        font-size: .75rem;
        font-weight: 700;
        color: #1d4ed8;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 10px;
    }
    .sec-title {
        font-size: clamp(1.6rem, 3vw, 2.2rem);
        font-weight: 800;
        color: #0f172a;
        line-height: 1.25;
        margin-bottom: 12px;
    }
    .sec-sub { font-size: .95rem; color: #64748b; line-height: 1.75; max-width: 520px; }

    .schol-card {
        background: #fff;
        border: 1px solid #e8edf5;
        border-radius: 20px;
        padding: 28px;
        height: 100%;
        transition: all .3s;
        position: relative;
        overflow: hidden;
    }
    .schol-card.featured {
        background: linear-gradient(145deg, #1d4ed8, #1e40af);
        border-color: transparent;
        color: #fff;
    }
    .schol-card.featured .sc-desc,
    .schol-card.featured .sc-item  { color: rgba(255,255,255,.8); }
    .schol-card.featured .sc-title { color: #fff; }
    .schol-card:hover:not(.featured) { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(0,0,0,.08); }
    .schol-card.featured:hover       { transform: translateY(-4px); box-shadow: 0 20px 50px rgba(29,78,216,.4); }

    .sc-badge {
        display: inline-flex; align-items: center; gap: 6px;
        border-radius: 50px; padding: 4px 12px;
        font-size: .72rem; font-weight: 700;
        margin-bottom: 16px;
    }
    .sc-badge-blue   { background: #eff6ff; color: #1d4ed8; }
    .sc-badge-white  { background: rgba(255,255,255,.2); color: #fff; }
    .sc-badge-purple { background: #f5f3ff; color: #7c3aed; }
    .sc-badge-amber  { background: #fffbeb; color: #b45309; }

    .sc-title { font-size: 1.25rem; font-weight: 800; color: #0f172a; margin-bottom: 8px; }
    .sc-desc  { font-size: .85rem; color: #64748b; line-height: 1.7; margin-bottom: 16px; }
    .sc-items { list-style: none; padding: 0; margin: 0; }
    .sc-item  { font-size: .82rem; color: #374151; display: flex; align-items: center; gap: 8px; margin-bottom: 8px; }
    .sc-item i { color: #1d4ed8; flex-shrink: 0; }
    .schol-card.featured .sc-item i { color: #93c5fd; }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       CTA BANNER
    ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    .cta-banner {
        background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
        padding: 80px 0;
        position: relative;
        overflow: hidden;
    }
    .cta-banner::before {
        content: '';
        position: absolute; inset: 0;
        background-image: radial-gradient(circle at 80% 20%, rgba(59,130,246,.15) 0%, transparent 50%),
                          radial-gradient(circle at 20% 80%, rgba(124,58,237,.1) 0%, transparent 50%);
        pointer-events: none;
    }
    .cta-banner h2 { font-size: clamp(1.6rem, 3vw, 2.4rem); font-weight: 800; color: #fff; }
    .cta-banner p  { color: rgba(255,255,255,.7); font-size: 1rem; }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       SCROLL ANIMATION
    ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    .fade-up { opacity: 0; transform: translateY(28px); transition: opacity .6s ease, transform .6s ease; }
    .fade-up.visible { opacity: 1; transform: translateY(0); }

    /* ── Responsive tweaks ── */
    @media (max-width: 991.98px) {
        .hero-img-col::before { display: none; }
        .review-float-card { left: 0; bottom: -10px; min-width: 180px; padding: 10px 14px; }
        .badge-float { right: 0; top: 10px; }
        .hero-img-wrap img { height: 340px; }
        .hero-trust { gap: 14px; }
    }
    @media (max-width: 767.98px) {
        .hero-section { padding: 70px 0 0; }
        .review-float-card { display: none; }
        .badge-float       { display: none; }
        .hero-img-wrap img { height: 270px; border-radius: 16px; }
    }
</style>
@endpush

@section('content')

{{-- ═══════════════════════════════════════════════════
     HERO SECTION — Two-column: Text Left  |  Image Right
═══════════════════════════════════════════════════ --}}
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center g-5">

            {{-- ── LEFT: Copy ── --}}
            <div class="col-lg-6 pb-lg-5">

                {{-- Announcement pill --}}
                <a href="{{ route('guest.faq') }}" class="hero-announce d-inline-flex">
                    <span class="ann-badge">Baru</span>
                    <span>Pendaftaran Beasiswa Semester Genap 2025/2026 <i class="bi bi-arrow-right ms-1"></i></span>
                </a>

                {{-- Heading --}}
                <h1 class="hero-heading mb-4">
                    Raih Masa Depan<br>
                    Cerah Bersama<br>
                    <span class="text-accent">Beasiswa YARSI</span>
                </h1>

                {{-- Sub --}}
                <p class="hero-sub mb-4">
                    Platform resmi pengelolaan dan pengajuan beasiswa mahasiswa Universitas YARSI.
                    Proses transparan, cepat, dan mudah — dari pendaftaran hingga pencairan, semua dalam satu sistem.
                </p>

                {{-- CTA Buttons --}}
                <div class="d-flex flex-wrap gap-3 mb-2">
                    <a href="{{ route('login') }}" class="btn-hero-primary">
                        Mulai Pendaftaran <i class="bi bi-arrow-right"></i>
                    </a>
                    <a href="{{ route('guest.faq') }}" class="btn-hero-secondary">
                        <i class="bi bi-play-circle"></i> Lihat Panduan
                    </a>
                </div>

                {{-- Trust bar / Review strip --}}
                <div class="hero-trust">

                    {{-- Avatar stack --}}
                    <div class="avatar-stack">
                        <div class="av">AR</div>
                        <div class="av">DN</div>
                        <div class="av">SF</div>
                        <div class="av">MR</div>
                        <div class="av" style="background:#dbeafe;color:#1d4ed8">+</div>
                    </div>

                    <div class="trust-text">
                        <strong>1.200+ Mahasiswa Penerima</strong>
                        <span class="trust-stars">★★★★★</span>
                        4.8/5 kepuasan pengguna sistem
                    </div>

                    <div class="trust-divider"></div>

                    <div class="trust-stat">
                        <div class="val">98%</div>
                        <div class="lbl">Dokumen diproses<br>tepat waktu</div>
                    </div>

                    <div class="trust-divider"></div>

                    <div class="trust-stat">
                        <div class="val">3 Tipe</div>
                        <div class="lbl">Program<br>Beasiswa</div>
                    </div>

                </div>
            </div>

            {{-- ── RIGHT: Image ── --}}
            <div class="col-lg-6 hero-img-col">

                {{-- Floating badge top-right --}}
                <div class="badge-float">
                    <div class="bf-val">500+</div>
                    <div class="bf-lbl">Beasiswa<br>Aktif</div>
                </div>

                {{-- Main image --}}
                <div class="hero-img-wrap">
                    <img src="{{ asset('images/hero-students.png') }}"
                         alt="Mahasiswa penerima beasiswa YARSI belajar bersama di perpustakaan kampus">
                </div>

                {{-- Floating review card --}}
                <div class="review-float-card">
                    <div class="rf-stars">★★★★★</div>
                    <p class="rf-quote">"Sistem beasiswa YARSI sangat membantu dan prosesnya sangat mudah!"</p>
                    <div class="rf-author">
                        <div class="rf-av">AS</div>
                        <div>
                            <div class="rf-name">Anisa Septiani</div>
                            <div class="rf-role">Mahasiswi FK, Penerima KIP-K</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ── Partner / Recognition Bar ── --}}
    <div class="partner-bar mt-5">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-auto">
                    <span class="pb-label">Didukung oleh</span>
                </div>
                <div class="col">
                    <div class="partner-logos">
                        <span class="partner-logo-item">
                            <i class="bi bi-bank2"></i> Kemendikbudristek
                        </span>
                        <span class="partner-logo-item">
                            <i class="bi bi-award"></i> KIP Kuliah
                        </span>
                        <span class="partner-logo-item">
                            <i class="bi bi-globe"></i> LPDP
                        </span>
                        <span class="partner-logo-item">
                            <i class="bi bi-shield-check"></i> Yayasan YARSI
                        </span>
                        <span class="partner-logo-item">
                            <i class="bi bi-star"></i> Baznas
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     FEATURES SECTION
═══════════════════════════════════════════════════ --}}
<section class="features-section">
    <div class="container">

        {{-- Section header --}}
        <div class="row justify-content-center text-center mb-5 fade-up">
            <div class="col-lg-6">
                <p class="sec-label">Kenapa memilih kami</p>
                <h2 class="sec-title">Sistem yang Dirancang<br>untuk Kemudahan Anda</h2>
                <p class="sec-sub mx-auto">
                    Kami menghilangkan birokrasi yang rumit agar Anda bisa fokus pada yang terpenting — prestasi akademik.
                </p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-sm-6 col-lg-3 fade-up" style="transition-delay:.05s">
                <div class="feature-card">
                    <div class="fc-icon fc-icon-blue"><i class="bi bi-cloud-upload-fill"></i></div>
                    <h3 class="fc-title">Unggah Dokumen Online</h3>
                    <p class="fc-desc">Upload SK dan berkas pendukung kapan saja, di mana saja, tanpa harus datang ke kantor administrasi.</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 fade-up" style="transition-delay:.1s">
                <div class="feature-card">
                    <div class="fc-icon fc-icon-purple"><i class="bi bi-diagram-3-fill"></i></div>
                    <h3 class="fc-title">Validasi Multi-Tahap</h3>
                    <p class="fc-desc">Alur persetujuan terstruktur: Kaprodi → Admin → Warek, memastikan transparansi di setiap langkah.</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 fade-up" style="transition-delay:.15s">
                <div class="feature-card">
                    <div class="fc-icon fc-icon-green"><i class="bi bi-bell-fill"></i></div>
                    <h3 class="fc-title">Notifikasi Real-Time</h3>
                    <p class="fc-desc">Pantau status pengajuan secara langsung. Dapatkan pemberitahuan di setiap perubahan status beasiswa Anda.</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 fade-up" style="transition-delay:.2s">
                <div class="feature-card">
                    <div class="fc-icon fc-icon-amber"><i class="bi bi-bar-chart-fill"></i></div>
                    <h3 class="fc-title">Laporan Terpusat</h3>
                    <p class="fc-desc">Admin dan pimpinan dapat melihat rekap data beasiswa secara lengkap untuk pengambilan keputusan yang tepat.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     SCHOLARSHIP TYPES SECTION
═══════════════════════════════════════════════════ --}}
<section class="scholarship-section">
    <div class="container">

        <div class="row justify-content-between align-items-end mb-5 fade-up">
            <div class="col-lg-6">
                <p class="sec-label">Program Beasiswa</p>
                <h2 class="sec-title">Tiga Jenis Beasiswa<br>yang Tersedia</h2>
                <p class="sec-sub">Pilih program beasiswa yang sesuai dengan kebutuhan dan kondisi Anda saat ini.</p>
            </div>
            <div class="col-lg-auto mt-3 mt-lg-0">
                <a href="{{ route('guest.faq') }}" class="btn-hero-secondary">
                    Lihat Panduan Lengkap <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="row g-4">
            {{-- Full Funded --}}
            <div class="col-md-4 fade-up" style="transition-delay:.05s">
                <div class="schol-card featured">
                    <div class="sc-badge sc-badge-white"><i class="bi bi-trophy-fill"></i> Paling Diminati</div>
                    <h3 class="sc-title">Full Funded</h3>
                    <p class="sc-desc">Beasiswa penuh yang menanggung seluruh komponen biaya pendidikan selama masa studi.</p>
                    <ul class="sc-items">
                        <li class="sc-item"><i class="bi bi-check-circle-fill"></i> Biaya kuliah (UKT) penuh</li>
                        <li class="sc-item"><i class="bi bi-check-circle-fill"></i> Tunjangan hidup bulanan</li>
                        <li class="sc-item"><i class="bi bi-check-circle-fill"></i> Biaya buku & penelitian</li>
                        <li class="sc-item"><i class="bi bi-check-circle-fill"></i> Berlaku s.d. lulus tepat waktu</li>
                    </ul>
                </div>
            </div>

            {{-- Partially Funded --}}
            <div class="col-md-4 fade-up" style="transition-delay:.1s">
                <div class="schol-card">
                    <div class="sc-badge sc-badge-purple"><i class="bi bi-award-fill"></i> Populer</div>
                    <h3 class="sc-title">Partially Funded</h3>
                    <p class="sc-desc">Bantuan sebagian biaya pendidikan, meringankan beban mahasiswa tanpa menanggung seluruhnya.</p>
                    <ul class="sc-items">
                        <li class="sc-item"><i class="bi bi-check-circle-fill"></i> Subsidi UKT sebagian</li>
                        <li class="sc-item"><i class="bi bi-check-circle-fill"></i> Bantuan biaya pendidikan</li>
                        <li class="sc-item"><i class="bi bi-check-circle-fill"></i> Perpanjangan per semester</li>
                        <li class="sc-item"><i class="bi bi-check-circle-fill"></i> Syarat IPK minimal 3.00</li>
                    </ul>
                </div>
            </div>

            {{-- One Shot --}}
            <div class="col-md-4 fade-up" style="transition-delay:.15s">
                <div class="schol-card">
                    <div class="sc-badge sc-badge-amber"><i class="bi bi-lightning-fill"></i> Cepat Cair</div>
                    <h3 class="sc-title">One Shot</h3>
                    <p class="sc-desc">Bantuan insidental satu kali untuk mahasiswa yang mengalami kesulitan ekonomi mendadak.</p>
                    <ul class="sc-items">
                        <li class="sc-item"><i class="bi bi-check-circle-fill"></i> Diberikan satu kali</li>
                        <li class="sc-item"><i class="bi bi-check-circle-fill"></i> Proses persetujuan cepat</li>
                        <li class="sc-item"><i class="bi bi-check-circle-fill"></i> Tidak menutup beasiswa lain</li>
                        <li class="sc-item"><i class="bi bi-check-circle-fill"></i> Untuk keperluan mendesak</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     CTA BANNER
═══════════════════════════════════════════════════ --}}
<section class="cta-banner">
    <div class="container position-relative">
        <div class="row justify-content-between align-items-center g-4 fade-up">
            <div class="col-lg-7">
                <p class="sec-label" style="color:#93c5fd">Mulai Sekarang</p>
                <h2 class="mb-3">Siap Meraih Beasiswa<br>Impian Anda?</h2>
                <p class="mb-0">Bergabunglah bersama lebih dari 1.200 mahasiswa YARSI yang telah merasakan manfaat program beasiswa kami. Proses mudah, transparan, dan terpercaya.</p>
            </div>
            <div class="col-lg-auto">
                <div class="d-flex flex-column gap-3">
                    <a href="{{ route('login') }}" class="btn-hero-primary justify-content-center">
                        <i class="bi bi-box-arrow-in-right"></i> Masuk & Daftar Sekarang
                    </a>
                    <a href="{{ route('guest.faq') }}" class="btn-hero-secondary justify-content-center"
                       style="background:rgba(255,255,255,.08); color:#fff; border-color:rgba(255,255,255,.2)">
                        <i class="bi bi-question-circle"></i> Pelajari FAQ Dulu
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // ─── Fade-up on scroll ───
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });

    document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
</script>
@endpush
