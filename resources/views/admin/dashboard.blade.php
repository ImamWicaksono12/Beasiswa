<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Sistem Beasiswa YARSI</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 280px;
            --primary-bg: #f8fafc;
            --sidebar-dark: #0f172a;
            --accent-blue: #3b82f6;
            --accent-indigo: #6366f1;
            --accent-success: #10b981;
            --accent-warning: #f59e0b;
            --accent-danger: #ef4444;
            --glass-bg: rgba(255, 255, 255, 0.7);
            --card-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--primary-bg);
            color: #1e293b;
            margin: 0;
            overflow-x: hidden;
        }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            color: #f8fafc;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 2.5rem;
            padding: 0.5rem;
        }

        .brand-logo-icon {
            width: 52px;
            height: 52px;
            background: #fff;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            flex-shrink: 0;
        }

        .brand-logo-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 4px;
        }

        .brand-name {
            font-weight: 800;
            font-size: 1.25rem;
            letter-spacing: -0.5px;
            line-height: 1;
        }

        .nav-section {
            margin-bottom: 2rem;
        }

        .nav-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #64748b;
            margin-bottom: 1rem;
            font-weight: 700;
            padding-left: 0.5rem;
        }

        .nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.8rem 1rem;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.05);
            transform: translateX(4px);
        }

        .nav-link.active {
            background: var(--accent-blue);
            color: #fff;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .nav-link i {
            font-size: 1.2rem;
        }

        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            padding-bottom: 3rem;
        }

        /* Top Header */
        .top-header {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1rem 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .page-title h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            color: #0f172a;
        }

        .page-title p {
            font-size: 0.875rem;
            color: #64748b;
            margin: 0;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            background: #fff;
            border: 1px solid #e2e8f0;
            cursor: pointer;
            transition: all 0.2s;
        }

        .user-profile:hover {
            border-color: var(--accent-blue);
            background: #f1f5f9;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-weight: 700;
        }

        .user-info .u-name {
            display: block;
            font-weight: 600;
            font-size: 0.875rem;
            line-height: 1.2;
        }

        .user-info .u-role {
            display: block;
            font-size: 0.75rem;
            color: #64748b;
        }

        .btn-logout-circle {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: #fee2e2;
            color: var(--accent-danger);
            transition: all 0.2s;
        }

        .btn-logout-circle:hover {
            background: var(--accent-danger);
            color: #fff;
            transform: rotate(90deg);
        }

        .content-body {
            padding: 2.5rem;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .stat-card {
            background: #fff;
            padding: 1.5rem;
            border-radius: 20px;
            border: 1px solid #f1f5f9;
            box-shadow: var(--card-shadow);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }

        .sc-blue {
            background: rgba(59, 130, 246, 0.1);
            color: var(--accent-blue);
        }

        .sc-purple {
            background: rgba(139, 92, 246, 0.1);
            color: #8b5cf6;
        }

        .sc-orange {
            background: rgba(245, 158, 11, 0.1);
            color: var(--accent-warning);
        }

        .sc-green {
            background: rgba(16, 185, 129, 0.1);
            color: var(--accent-success);
        }

        .stat-val {
            font-size: 1.75rem;
            font-weight: 800;
            display: block;
            margin-bottom: 4px;
        }

        .stat-lbl {
            font-size: 0.875rem;
            font-weight: 500;
            color: #64748b;
        }

        /* Generic Section Card */
        .section-card {
            background: #fff;
            border-radius: 24px;
            border: 1px solid #f1f5f9;
            box-shadow: var(--card-shadow);
            margin-bottom: 2.5rem;
            overflow: hidden;
        }

        .section-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section-title {
            font-weight: 700;
            font-size: 1.1rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-body {
            padding: 1.5rem 2rem;
        }

        /* Customized Tables */
        .table-custom {
            margin: 0;
        }

        .table-custom thead th {
            background: #f8fafc;
            border-bottom: 2px solid #f1f5f9;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.05em;
            padding: 1rem;
        }

        .table-custom tbody td {
            padding: 1.2rem 1rem;
            vertical-align: middle;
            font-size: 0.9rem;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
        }

        .badge-prodi {
            background: #eff6ff;
            color: #1d4ed8;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .btn-premium {
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-indigo));
            border: none;
            color: #fff;
            padding: 0.6rem 1.4rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        }

        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(99, 102, 241, 0.3);
            color: #fff;
        }

        /* Status Toggles */
        .status-toggle {
            cursor: pointer;
        }

        /* Audit Trail Timeline */
        .timeline {
            position: relative;
            padding-left: 2rem;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 7px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e2e8f0;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .timeline-item::after {
            content: '';
            position: absolute;
            left: -2rem;
            top: 5px;
            width: 16px;
            height: 16px;
            background: #fff;
            border: 3px solid var(--accent-blue);
            border-radius: 50%;
            z-index: 2;
        }

        .time-meta {
            font-size: 0.75rem;
            color: #94a3b8;
            margin-bottom: 4px;
            display: block;
        }

        .log-content {
            background: #f8fafc;
            padding: 10px 15px;
            border-radius: 10px;
            font-size: 0.85rem;
        }

        /* Hide Scrollbar for Chrome, Safari and Opera */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 50px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>

<body>
    <aside class="sidebar">
        <div class="brand-logo">
            <div class="brand-logo-icon">
                <img src="{{ asset('images/logo-yarsi.png') }}" alt="Logo YARSI">
            </div>
            <div class="brand-name">
                YARSI<br><span style="font-size: 0.9rem; font-weight: 500; color: #94a3b8;">Scholarship</span>
            </div>
        </div>

        <nav class="nav-section">
            <div class="nav-label">Utama</div>
            <ul class="nav-links">
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="bi bi-grid-fill"></i> Dashboard
                    </a>
                </li>
            </ul>
        </nav>

        <nav class="nav-section">
            <div class="nav-label">Manajemen</div>
            <ul class="nav-links">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-people-fill"></i> Manajemen Akun
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.beasiswa.index') }}" class="nav-link">
                        <i class="bi bi-award-fill"></i> Program Beasiswa
                    </a>
                </li>
            </ul>
        </nav>

        <nav class="nav-section">
            <div class="nav-label">Proses</div>
            <ul class="nav-links">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-file-earmark-check-fill"></i> Verifikasi SK
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-activity"></i> Monitoring
                    </a>
                </li>
            </ul>
        </nav>

        <nav class="nav-section" style="margin-top: auto;">
            <div class="nav-label">System</div>
            <ul class="nav-links">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-journal-text"></i> Laporan
                    </a>
                </li>
            </ul>
        </nav>
    </aside>
    <main class="main-wrapper">

        <!-- TOP HEADER -->
        <header class="top-header">
            <div class="page-title">
                <h1>Admin Dashboard</h1>
                <p>Welcome back, Administrator. Here's what's happening today.</p>
            </div>

            <div class="header-actions">
                <div class="user-profile">
                    <div class="user-avatar">AD</div>
                    <div class="user-info">
                        <span class="u-name">Admin YARSI</span>
                        <span class="u-role">Super Administrator</span>
                    </div>
                    <i class="bi bi-chevron-down ms-2 fs-xs" style="font-size: 0.7rem;"></i>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout-circle" title="Keluar">
                        <i class="bi bi-power"></i>
                    </button>
                </form>
            </div>
        </header>

        <div class="content-body">

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-card-icon sc-blue"><i class="bi bi-people"></i></div>
                    <span class="stat-val">1,248</span>
                    <span class="stat-lbl">Total Pendaftar</span>
                </div>
                <div class="stat-card">
                    <div class="stat-card-icon sc-green"><i class="bi bi-check-circle"></i></div>
                    <span class="stat-val">452</span>
                    <span class="stat-lbl">Penerima Aktif</span>
                </div>
                <div class="stat-card">
                    <div class="stat-card-icon sc-orange"><i class="bi bi-hourglass-split"></i></div>
                    <span class="stat-val">12</span>
                    <span class="stat-lbl">Monitoring Pending</span>
                </div>
                <div class="stat-card">
                    <div class="stat-card-icon sc-purple"><i class="bi bi-stack"></i></div>
                    <span class="stat-val">3</span>
                    <span class="stat-lbl">Beasiswa Berjalan</span>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="section-card">
                        <div class="section-header">
                            <h2 class="section-title"><i class="bi bi-shield-check"></i> Manajemen Akun & Verifikator
                            </h2>
                            <button class="btn btn-premium btn-sm"><i class="bi bi-plus-lg me-1"></i> Tambah
                                Akun</button>
                        </div>
                        <div class="section-body p-0">
                            <div class="table-responsive">
                                <table class="table table-custom">
                                    <thead>
                                        <tr>
                                            <th>Nama Verifikator</th>
                                            <th>Peran / Jabatan</th>
                                            <th>Unit Kerja / Prodi</th>
                                            <th>Status Akses</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Dr. Ahmad Sujadi</strong></td>
                                            <td>Kaprodi</td>
                                            <td><span class="badge-prodi">Teknik Informatika</span></td>
                                            <td><span
                                                    class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Aktif</span>
                                            </td>
                                            <td>
                                                <button
                                                    class="btn btn-light btn-sm rounded-pill px-3 border">Edit</button>
                                                <button
                                                    class="btn btn-light btn-sm rounded-pill px-3 border text-danger">Banned</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Prof. Siti Aminah</strong></td>
                                            <td>Wadek Akademik</td>
                                            <td><span class="badge-prodi">Kedokteran Umum</span></td>
                                            <td><span
                                                    class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Aktif</span>
                                            </td>
                                            <td>
                                                <button
                                                    class="btn btn-light btn-sm rounded-pill px-3 border">Edit</button>
                                                <button
                                                    class="btn btn-light btn-sm rounded-pill px-3 border text-danger">Banned</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Budi Hartono, M.Kom</strong></td>
                                            <td>Puskaka</td>
                                            <td><span class="badge-prodi">Pusat Karir</span></td>
                                            <td><span
                                                    class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">Suspended</span>
                                            </td>
                                            <td>
                                                <button
                                                    class="btn btn-light btn-sm rounded-pill px-3 border text-success">Restore</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="section-card">
                        <div class="section-header">
                            <h2 class="section-title"><i class="bi bi-file-earmark-diff"></i> Workspace Validasi SK
                            </h2>
                            <span class="badge bg-primary rounded-pill px-3">5 Queue Pending</span>
                        </div>
                        <div class="section-body">
                            <div
                                class="alert alert-info border-0 bg-primary bg-opacity-10 text-primary d-flex align-items-center gap-3 rounded-4 mb-4">
                                <i class="bi bi-info-circle-fill fs-4"></i>
                                <span>Verifikasi Surat Keputusan dilakukan setelah evaluasi prodi selesai. Silakan cek
                                    queue list di bawah.</span>
                            </div>

                            <ul class="list-group list-group-flush">
                                <li
                                    class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center border-bottom border-light">
                                    <div>
                                        <h6 class="mb-1 fw-bold">SK.2024.001 - Beasiswa Prestasi</h6>
                                        <small class="text-muted">Diajukan: 2 jam yang lalu oleh Prodi TI</small>
                                    </div>
                                    <button class="btn btn-outline-primary btn-sm rounded-pill px-4">Review SK</button>
                                </li>
                                <li
                                    class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center border-bottom border-light">
                                    <div>
                                        <h6 class="mb-1 fw-bold">SK.2024.002 - Beasiswa Tahfidz</h6>
                                        <small class="text-muted">Diajukan: Kemarin oleh Puskaka</small>
                                    </div>
                                    <button class="btn btn-outline-primary btn-sm rounded-pill px-4">Review SK</button>
                                </li>
                            </ul>

                            <div class="mt-4">
                                <label class="form-label fw-bold small text-uppercase">Catatan Verifikasi</label>
                                <textarea class="form-control rounded-4 bg-light border-0" rows="3"
                                    placeholder="Tulis catatan di sini..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="section-card">
                        <div class="section-header">
                            <h2 class="section-title"><i class="bi bi-gear-wide-connected"></i> Kontrol Periode &
                                Monitoring</h2>
                        </div>
                        <div class="section-body">
                            <div class="p-4 rounded-4 border border-dashed text-center mb-4 bg-light bg-opacity-50">
                                <div class="badge bg-success bg-opacity-25 text-success rounded-pill px-3 mb-2">Periode
                                    Berjalan: Ganjil 2024/2025</div>
                                <h4 class="fw-bold">Pendaftaran Dibuka</h4>
                                <p class="small text-muted mb-3">Batas Akhir: 30 Agustus 2024</p>
                                <button class="btn btn-accent-dark btn-sm border-dark rounded-pill px-4">Ubah Setting
                                    Periode</button>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="mb-0 fw-bold">Aktivasi Monitoring Tracker</h6>
                                    <small class="text-muted">Pantau progress pendaftaran real-time</small>
                                </div>
                                <div class="form-check form-switch fs-4">
                                    <input class="form-check-input" type="checkbox" id="monActive" checked>
                                </div>
                            </div>
                            <hr>
                            <label class="form-label fw-bold small text-uppercase mb-3">Monitoring Tracker
                                Progress</label>
                            <div class="progress rounded-pill mb-2" style="height: 8px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 75%;"
                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between small text-muted">
                                <span>Proses Validasi Akademik</span>
                                <span>75% Selesai</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="section-card">
                        <div class="section-header">
                            <h2 class="section-title"><i class="bi bi-people"></i> Manajemen Penerima & Kontrol</h2>
                            <div class="d-flex gap-2">
                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <span class="input-group-text bg-white border-end-0"><i
                                            class="bi bi-search"></i></span>
                                    <input type="text" class="form-control border-start-0"
                                        placeholder="Cari Mahasiswa...">
                                </div>
                                <button class="btn btn-outline-secondary btn-sm rounded-pill px-3"><i
                                        class="bi bi-download me-1"></i> Export Excel</button>
                            </div>
                        </div>
                        <div class="section-body p-0">
                            <div class="table-responsive">
                                <table class="table table-custom">
                                    <thead>
                                        <tr>
                                            <th>Mahasiswa</th>
                                            <th>Prodi</th>
                                            <th>Tipe Beasiswa</th>
                                            <th>Status</th>
                                            <th>Toggle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="user-avatar"
                                                        style="width:32px; height:32px; font-size:0.7rem">RF</div>
                                                    <div>
                                                        <span class="fw-bold d-block">Rizky Fauzan</span>
                                                        <small class="text-muted">NPM: 1402021001</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge-prodi">TI</span></td>
                                            <td>Beasiswa Full Funded</td>
                                            <td><span
                                                    class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Aktif</span>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        checked>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="user-avatar"
                                                        style="width:32px; height:32px; font-size:0.7rem">SN</div>
                                                    <div>
                                                        <span class="fw-bold d-block">Siti Nurhaliza</span>
                                                        <small class="text-muted">NPM: 1102022045</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge-prodi">Kedokteran</span></td>
                                            <td>Beasiswa Prestasi</td>
                                            <td><span
                                                    class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3">Non-Aktif</span>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input status-toggle" type="checkbox">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4">
                    <div class="section-card">
                        <div class="section-header">
                            <h2 class="section-title"><i class="bi bi-history"></i> Log Aktivitas (Audit Trail)</h2>
                        </div>
                        <div class="section-body">
                            <div class="timeline">
                                <div class="timeline-item">
                                    <span class="time-meta">Hari ini, 10:45 AM</span>
                                    <div class="log-content">
                                        <strong>Admin YARSI</strong> mengubah status <strong>Rizky Fauzan</strong>
                                        menjadi <strong>Aktif</strong>.
                                        <p class="mb-0 mt-2 italic text-muted small">"Data dokumen lengkap & verifikasi
                                            akademik oke"</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <span class="time-meta">Hari ini, 09:12 AM</span>
                                    <div class="log-content">
                                        <strong>Kaprodi TI</strong> memvalidasi berkas pendaftaran 12 mahasiswa baru.
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <span class="time-meta">Kemarin, 04:30 PM</span>
                                    <div class="log-content">
                                        <strong>Admin YARSI</strong> menonaktifkan akun verifikator <strong>Budi
                                            Hartono</strong>.
                                        <p class="mb-0 mt-2 italic text-muted small">"Mutasi jabatan ke unit lain"</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <span class="time-meta">Kemarin, 02:00 PM</span>
                                    <div class="log-content">
                                        Sistem mengirimkan notifikasi pengumuman beasiswa ganjil 2024.
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-light w-100 rounded-pill mt-3 border small fw-bold text-muted">Lihat
                                Semua Log</button>
                        </div>
                    </div>
                </div>

            </div> <!-- end row -->

        </div> <!-- end content body -->
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>