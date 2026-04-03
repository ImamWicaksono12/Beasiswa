@extends('layouts.auth')

@push('styles')
<style>
    /* ═══════════════════════════════════════════
       AUTH BODY — full viewport split layout
    ═══════════════════════════════════════════ */
    .auth-body {
        min-height: 100vh;
        margin: 0;
        padding: 0;
        display: flex;
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        background: #f0f4ff;
    }

    /* ═══════════════════════════════════════════
       LEFT PANEL — Branding
    ═══════════════════════════════════════════ */
    .auth-branding {
        display: none; /* hidden on mobile */
        width: 45%;
        min-height: 100vh;
        background: linear-gradient(160deg, #0a3580 0%, #1565c0 45%, #1976d2 75%, #42a5f5 100%);
        position: relative;
        overflow: hidden;
        padding: 3rem 3rem;
        flex-direction: column;
        justify-content: space-between;
        color: #fff;
    }

    @media (min-width: 992px) {
        .auth-branding { display: flex; }
        .auth-wrapper   { flex-direction: row; }
    }

    /* decorative blobs */
    .brand-blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(70px);
        opacity: 0.18;
    }
    .blob-a { width: 420px; height: 420px; background: #90caf9; top: -120px; right: -140px; }
    .blob-b { width: 320px; height: 320px; background: #ffffff; bottom: -80px; left: -80px; }
    .blob-c { width: 200px; height: 200px; background: #b3e5fc; top: 45%; left: 55%; }

    /* pattern overlay */
    .brand-pattern {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(circle, rgba(255,255,255,.06) 1px, transparent 1px);
        background-size: 32px 32px;
        pointer-events: none;
    }

    /* top brand logo */
    .brand-logo-wrap {
        display: flex;
        align-items: center;
        gap: 12px;
        position: relative;
        z-index: 2;
    }
    .brand-icon {
        width: 52px; height: 52px;
        background: rgba(255,255,255,.22);
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.6rem;
        backdrop-filter: blur(6px);
        border: 1px solid rgba(255,255,255,.3);
    }
    .brand-name { font-size: 1.15rem; font-weight: 700; letter-spacing: .3px; }
    .brand-tagline { font-size: .75rem; opacity: .75; }

    /* center hero text */
    .brand-hero { position: relative; z-index: 2; }
    .brand-hero h1 {
        font-size: 2.1rem;
        font-weight: 800;
        line-height: 1.25;
        margin-bottom: 1rem;
    }
    .brand-hero p  { opacity: .8; font-size: .95rem; line-height: 1.75; max-width: 360px; }

    /* stats row */
    .brand-stats {
        display: flex;
        gap: 20px;
        margin-top: 1.8rem;
        position: relative;
        z-index: 2;
    }
    .stat-pill {
        background: rgba(255,255,255,.15);
        border: 1px solid rgba(255,255,255,.25);
        backdrop-filter: blur(6px);
        border-radius: 50px;
        padding: 8px 18px;
        font-size: .8rem;
        display: flex; align-items: center; gap: 7px;
        font-weight: 600;
    }

    /* feature list */
    .brand-features { list-style: none; padding: 0; margin: 0; position: relative; z-index: 2; }
    .brand-features li {
        display: flex; align-items: center; gap: 10px;
        font-size: .875rem; opacity: .85; margin-bottom: 12px;
    }
    .brand-features li i {
        width: 28px; height: 28px;
        background: rgba(255,255,255,.18);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; font-size: .85rem;
    }

    /* bottom copyright bar branding */
    .brand-bottom { position: relative; z-index: 2; font-size: .78rem; opacity: .6; }

    /* ═══════════════════════════════════════════
       RIGHT PANEL — Form
    ═══════════════════════════════════════════ */
    .auth-wrapper {
        width: 100%;
        display: flex;
        align-items: stretch;
    }

    .auth-form-panel {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 2.5rem 1.5rem;
        min-height: 100vh;
        background: #f0f4ff;
        overflow-y: auto;
    }

    .auth-form-inner {
        width: 100%;
        max-width: 420px;
    }

    /* ─── Top Navigation bar (inside form panel) ─── */
    .auth-topnav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 8px;
    }
    .auth-topnav .back-link {
        display: flex; align-items: center; gap: 6px;
        font-size: .85rem; color: #6c757d;
        text-decoration: none;
        transition: color .2s;
    }
    .auth-topnav .back-link:hover { color: #0d6efd; }
    .auth-topnav .nav-pills-mini {
        display: flex; gap: 6px;
    }
    .auth-topnav .nav-pills-mini a {
        font-size: .8rem;
        padding: 4px 12px;
        border-radius: 50px;
        border: 1px solid #dee2e6;
        color: #6c757d;
        text-decoration: none;
        transition: all .2s;
    }
    .auth-topnav .nav-pills-mini a:hover {
        background: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
    }

    /* ─── Mobile brand header (visible only <992px) ─── */
    .mobile-brand-header {
        display: flex; align-items: center; gap: 12px;
        margin-bottom: 1.5rem;
        padding-bottom: 1.25rem;
        border-bottom: 1px solid #e2e8f0;
    }
    .mobile-brand-header .mob-icon {
        width: 46px; height: 46px;
        background: linear-gradient(135deg, #0d6efd, #0a58ca);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem; color: #fff;
    }
    .mobile-brand-header h6 { font-weight: 700; margin-bottom: 2px; color: #1a1a2e; font-size: .95rem; }
    .mobile-brand-header small { color: #6c757d; font-size: .78rem; }
    @media (min-width: 992px) { .mobile-brand-header { display: none; } }

    /* ─── Card ─── */
    .login-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 8px 40px rgba(13,110,253,.08), 0 2px 8px rgba(0,0,0,.04);
        overflow: hidden;
    }

    .login-card-header {
        padding: 1.75rem 2rem 1.5rem;
        border-bottom: 1px solid #f1f3f9;
        background: linear-gradient(135deg, #fafbff 0%, #f0f4ff 100%);
    }
    .login-card-header .hdr-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(13,110,253,.1); color: #0d6efd;
        border-radius: 50px; padding: 4px 14px;
        font-size: .75rem; font-weight: 600;
        text-transform: uppercase; letter-spacing: .5px;
        margin-bottom: 10px;
    }
    .login-card-header h5 { font-weight: 800; color: #1a1a2e; font-size: 1.25rem; margin-bottom: 4px; }
    .login-card-header p  { color: #6c757d; font-size: .875rem; margin: 0; }

    .login-card-body { padding: 1.75rem 2rem; }


    /* ─── Input ─── */
    .field-label {
        font-size: .82rem; font-weight: 600; color: #374151; margin-bottom: 6px;
        display: flex; align-items: center; gap: 5px;
    }
    .input-group { border-radius: 12px; overflow: hidden; border: 1.5px solid #dee2e6; transition: border-color .2s; }
    .input-group:focus-within { border-color: #0d6efd; box-shadow: 0 0 0 3px rgba(13,110,253,.12); }
    .input-group .input-group-text {
        background: #f8f9fc; border: none; color: #9ca3af;
        padding: 0 14px; font-size: .95rem;
    }
    .input-group .form-control {
        border: none; padding: 12px 14px; font-size: .9rem; background: #fff;
    }
    .input-group .form-control:focus { box-shadow: none; }
    .input-group .form-control::placeholder { color: #c1c8d1; }
    .password-toggle { background: #f8f9fc !important; border: none !important; cursor: pointer; color: #9ca3af !important; }
    .password-toggle:hover { color: #0d6efd !important; background: #eef2ff !important; }

    /* ─── Submit Button ─── */
    .btn-login {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border: none; border-radius: 12px;
        padding: 13px; font-size: .95rem; font-weight: 700;
        letter-spacing: .3px; color: #fff;
        transition: all .3s; width: 100%;
        box-shadow: 0 4px 15px rgba(13,110,253,.3);
    }
    .btn-login:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(13,110,253,.4); background: linear-gradient(135deg, #0a58ca 0%, #084298 100%); }
    .btn-login:active { transform: translateY(0); }

    /* ─── Footer (inside card) ─── */
    .login-card-footer {
        padding: 1rem 2rem;
        background: #f8f9fc;
        border-top: 1px solid #f1f3f9;
        font-size: .8rem;
        color: #6c757d;
        text-align: center;
    }

    /* ─── Help Nav links below card ─── */
    .auth-help-nav {
        display: flex; flex-direction: column; align-items: center;
        gap: 14px; margin-top: 1.5rem;
    }
    .help-link-row {
        display: flex; gap: 20px; flex-wrap: wrap; justify-content: center;
    }
    .help-link-row a {
        font-size: .82rem; color: #6c757d; text-decoration: none;
        display: flex; align-items: center; gap: 5px;
        transition: color .2s;
    }
    .help-link-row a:hover { color: #0d6efd; }
    .auth-divider { display: flex; align-items: center; gap: 12px; width: 100%; margin: .1rem 0; }
    .auth-divider hr { flex: 1; border-color: #e2e8f0; }
    .auth-divider span { font-size: .75rem; color: #9ca3af; white-space: nowrap; }

    .contact-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 14px 20px;
        width: 100%;
        display: flex; align-items: center; gap: 12px;
    }
    .contact-card .cc-icon {
        width: 38px; height: 38px;
        background: #eef2ff; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem; color: #0d6efd; flex-shrink: 0;
    }
    .contact-card .cc-text { font-size: .8rem; color: #6c757d; }
    .contact-card .cc-text strong { display: block; font-size: .85rem; color: #1a1a2e; margin-bottom: 1px; }
</style>
@endpush

@section('content')

{{-- ════════════════════ LEFT: Branding Panel ════════════════════ --}}
<div class="auth-branding">
    {{-- Decorative blobs --}}
    <div class="brand-blob blob-a"></div>
    <div class="brand-blob blob-b"></div>
    <div class="brand-blob blob-c"></div>
    <div class="brand-pattern"></div>

    {{-- Top: Logo & Name --}}
    <div class="brand-logo-wrap">
        <div class="brand-icon"><i class="bi bi-mortarboard-fill"></i></div>
        <div>
            <div class="brand-name">{{ config('app.name', 'Beasiswa YARSI') }}</div>
            <div class="brand-tagline">Universitas YARSI — Jakarta</div>
        </div>
    </div>

    {{-- Center: Hero --}}
    <div class="brand-hero">
        <h1>Sistem Informasi<br>Manajemen Beasiswa</h1>
        <p>
            Platform terpadu untuk pengelolaan, pengajuan, dan pemantauan beasiswa
            mahasiswa Universitas YARSI secara digital dan transparan.
        </p>

        {{-- Stats pills --}}
        <div class="brand-stats">
            <div class="stat-pill"><i class="bi bi-people-fill"></i> Multi-role Akses</div>
            <div class="stat-pill"><i class="bi bi-shield-check"></i> Terverifikasi</div>
        </div>

        {{-- Feature list --}}
        <ul class="brand-features mt-4">
            <li><i class="bi bi-cloud-upload-fill"></i> Unggah & validasi dokumen online</li>
            <li><i class="bi bi-diagram-3-fill"></i> Alur persetujuan multi-tahap</li>
            <li><i class="bi bi-bell-fill"></i> Notifikasi status real-time</li>
            <li><i class="bi bi-bar-chart-fill"></i> Laporan & monitoring terpusat</li>
        </ul>
    </div>

    {{-- Bottom: Copyright --}}
    <div class="brand-bottom">
        &copy; {{ date('Y') }} Universitas YARSI. Semua Hak Cipta Dilindungi.
    </div>
</div>

{{-- ════════════════════ RIGHT: Form Panel ════════════════════ --}}
<div class="auth-form-panel">
    <div class="auth-form-inner">

        {{-- ── Top Navigation ── --}}
        <div class="auth-topnav">
            <a href="{{ url('/') }}" class="back-link">
                <i class="bi bi-arrow-left"></i> Beranda
            </a>
            <div class="nav-pills-mini">
                <a href="{{ route('guest.faq') }}">
                    <i class="bi bi-question-circle me-1"></i>FAQ
                </a>
                <a href="mailto:helpdesk@yarsi.ac.id">
                    <i class="bi bi-headset me-1"></i>Bantuan
                </a>
            </div>
        </div>

        {{-- ── Mobile Brand Header ── --}}
        <div class="mobile-brand-header">
            <div class="mob-icon"><i class="bi bi-mortarboard-fill"></i></div>
            <div>
                <h6>{{ config('app.name', 'Beasiswa YARSI') }}</h6>
                <small>Sistem Informasi Manajemen Beasiswa</small>
            </div>
        </div>

        {{-- ════ LOGIN CARD ════ --}}
        <div class="login-card">

            {{-- Card Header --}}
            <div class="login-card-header">
                <div class="hdr-badge">
                    <i class="bi bi-lock-fill"></i> SSO Login
                </div>
                <h5>Selamat Datang Kembali!</h5>
                <p>Masuk menggunakan akun YARSI (<strong>username</strong> &amp; <strong>password</strong>) Anda.</p>
            </div>

            {{-- Card Body --}}
            <div class="login-card-body">

                {{-- Alerts --}}
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible d-flex align-items-center gap-2 mb-4 rounded-3 py-2" role="alert">
                        <i class="bi bi-exclamation-triangle-fill flex-shrink-0"></i>
                        <span>{{ session('error') }}</span>
                        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger d-flex align-items-center gap-2 mb-4 rounded-3 py-2" role="alert">
                        <i class="bi bi-exclamation-triangle-fill flex-shrink-0"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                {{-- Form --}}
                <form id="login-form" action="{{ route('login') }}" method="POST" autocomplete="on" novalidate>
                    @csrf

                    {{-- Username --}}
                    <div class="mb-3">
                        <label for="username" class="field-label">
                            <i class="bi bi-person text-primary"></i> Username
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                            <input id="username" type="text" name="username"
                                class="form-control @error('username') is-invalid @enderror"
                                placeholder="Masukkan username YARSI Anda"
                                value="{{ old('username') }}" required autofocus autocomplete="username">
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label for="password" class="field-label mb-0">
                                <i class="bi bi-lock text-primary"></i> Password
                            </label>
                            <a href="mailto:helpdesk@yarsi.ac.id" class="text-primary text-decoration-none"
                               style="font-size:.78rem">Lupa password?</a>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input id="password" type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Masukkan password Anda" required>
                            <button class="input-group-text password-toggle" type="button"
                                id="togglePassword" tabindex="-1">
                                <i class="bi bi-eye-fill" id="togglePasswordIcon"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn-login" id="submit-btn">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Masuk ke Sistem
                    </button>
                </form>
            </div>

            {{-- Card Footer --}}
            <div class="login-card-footer">
                <i class="bi bi-shield-lock-fill me-1 text-primary"></i>
                Koneksi terenkripsi &amp; aman &mdash; Powered by SSO YARSI
            </div>
        </div>

        {{-- ════ HELP NAVIGATION below card ════ --}}
        <div class="auth-help-nav">

            {{-- Quick links --}}
            <div class="help-link-row">
                <a href="{{ route('guest.faq') }}">
                    <i class="bi bi-question-circle-fill text-primary"></i> Panduan & FAQ
                </a>
                <a href="{{ route('guest.faq') }}">
                    <i class="bi bi-diagram-3-fill text-primary"></i> Alur Pendaftaran
                </a>
                <a href="mailto:beasiswa@yarsi.ac.id">
                    <i class="bi bi-envelope-fill text-primary"></i> Email Beasiswa
                </a>
            </div>

            <div class="auth-divider">
                <hr><span>Butuh bantuan teknis?</span><hr>
            </div>

            {{-- Contact card --}}
            <div class="contact-card">
                <div class="cc-icon"><i class="bi bi-headset"></i></div>
                <div class="cc-text">
                    <strong>Helpdesk IT YARSI</strong>
                    Hubungi <a href="mailto:helpdesk@yarsi.ac.id" class="text-primary fw-semibold text-decoration-none">helpdesk@yarsi.ac.id</a>
                    atau datang ke Gedung Rektorat Lt. 2.
                </div>
            </div>

            <p class="text-muted text-center" style="font-size:.75rem; margin-top:.5rem; margin-bottom:0">
                &copy; {{ date('Y') }} Universitas YARSI &mdash; Semua Hak Cipta Dilindungi
            </p>

        </div>
        {{-- end auth-help-nav --}}

    </div>{{-- end auth-form-inner --}}
</div>{{-- end auth-form-panel --}}

@endsection

@push('scripts')
<script>
    // ─── Toggle show/hide password ───
    document.getElementById('togglePassword').addEventListener('click', function () {
        const input = document.getElementById('password');
        const icon  = document.getElementById('togglePasswordIcon');
        const isPass = input.type === 'password';
        input.type   = isPass ? 'text' : 'password';
        icon.className = isPass ? 'bi bi-eye-slash-fill' : 'bi bi-eye-fill';
    });

    // ─── Loading state on submit ───
    document.getElementById('login-form').addEventListener('submit', function () {
        const btn = document.getElementById('submit-btn');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Memproses...';
    });


</script>
@endpush
