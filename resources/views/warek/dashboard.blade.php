<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dashboard Wakil Rektor – Pemantauan Beasiswa Universitas YARSI">
    <title>Dashboard Warek | YARSI Scholarship</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <style>
        /* ─────────────────────────────────────────
           RESET & BASE
        ───────────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary:       #1E40AF;
            --primary-dark:  #1730A0;
            --primary-glow:  rgba(30, 64, 175, 0.25);
            --accent:        #F59E0B;
            --accent2:       #10B981;
            --danger:        #EF4444;
            --info:          #3B82F6;
            --sidebar-w:     270px;
            --header-h:      68px;
            --bg:            #0A0E1A;
            --bg2:           #111827;
            --bg3:           #1F2937;
            --border:        rgba(255,255,255,0.07);
            --text:          #E2E8F0;
            --text-muted:    #8892A4;
            --radius:        14px;
            --shadow:        0 8px 32px rgba(0,0,0,0.45);
            --transition:    .25s cubic-bezier(.4,0,.2,1);
        }

        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; overflow-x: hidden; }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg2); }
        ::-webkit-scrollbar-thumb { background: var(--primary); border-radius: 99px; }

        .overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,.55); z-index:99; backdrop-filter:blur(2px); }
        .overlay.active { display:block; }

        /* ─── SIDEBAR ─── */
        .sidebar {
            position: fixed; top:0; left:0; width:var(--sidebar-w); height:100vh;
            background: var(--bg2); border-right: 1px solid var(--border);
            display: flex; flex-direction: column; z-index: 100;
            transition: transform var(--transition);
        }

        .sidebar-logo {
            display: flex; align-items: center; gap: 12px;
            padding: 22px 20px; border-bottom: 1px solid var(--border);
        }
        .sidebar-logo .logo-icon {
            width:44px; height:44px;
            background: linear-gradient(135deg, var(--primary), #3B82F6);
            border-radius: 12px; display:grid; place-items:center;
            font-size:20px; flex-shrink:0; box-shadow: 0 0 20px var(--primary-glow);
        }
        .sidebar-logo .name { font-size:15px; font-weight:700; display:block; }
        .sidebar-logo .sub  { font-size:11px; color:var(--text-muted); display:block; }

        .sidebar-nav { flex:1; padding:14px 12px; overflow-y:auto; }
        .nav-label {
            font-size:10px; font-weight:600; letter-spacing:.1em;
            color:var(--text-muted); text-transform:uppercase; padding:10px 10px 6px;
        }
        .nav-item {
            display:flex; align-items:center; gap:12px; padding:11px 14px;
            border-radius:10px; cursor:pointer; font-size:14px; font-weight:500;
            color:var(--text-muted); transition: background var(--transition), color var(--transition), transform var(--transition);
            text-decoration:none; margin-bottom:2px; border:none; background:none;
            width:100%; font-family:inherit; position:relative;
        }
        .nav-item i { width:18px; text-align:center; font-size:15px; }
        .nav-item:hover { background:rgba(30,64,175,.12); color:var(--text); transform:translateX(3px); }
        .nav-item.active { background:linear-gradient(90deg,rgba(30,64,175,.28),rgba(30,64,175,.08)); color:#fff; border-left:3px solid var(--primary); }
        .nav-item.active i { color: #60A5FA; }
        .nav-badge { margin-left:auto; background:var(--danger); color:#fff; font-size:10px; font-weight:700; padding:2px 7px; border-radius:99px; }

        .sidebar-footer { padding:14px 12px; border-top:1px solid var(--border); }
        .logout-btn {
            display:flex; align-items:center; gap:10px; width:100%; padding:11px 14px;
            border-radius:10px; border:none; background:rgba(239,68,68,.1); color:#EF4444;
            font-size:14px; font-weight:600; cursor:pointer; transition: background var(--transition), transform var(--transition);
            font-family:inherit;
        }
        .logout-btn:hover { background:rgba(239,68,68,.2); transform:translateX(3px); }

        /* ─── MAIN ─── */
        .main { margin-left:var(--sidebar-w); min-height:100vh; display:flex; flex-direction:column; }

        .topbar {
            position:sticky; top:0; height:var(--header-h);
            background:rgba(10,14,26,.88); backdrop-filter:blur(14px);
            border-bottom:1px solid var(--border); display:flex; align-items:center;
            padding:0 28px; gap:14px; z-index:90;
        }
        .hamburger { display:none; background:none; border:none; color:var(--text); font-size:20px; cursor:pointer; padding:6px; border-radius:8px; }
        .hamburger:hover { background:var(--bg3); }
        .topbar-title { font-size:18px; font-weight:700; flex:1; }
        .topbar-title span { color:#60A5FA; }

        .topbar-actions { display:flex; align-items:center; gap:10px; }
        .icon-btn {
            position:relative; width:40px; height:40px; background:var(--bg3);
            border:1px solid var(--border); border-radius:10px; display:grid;
            place-items:center; cursor:pointer; color:var(--text-muted); font-size:15px;
            transition: all var(--transition);
        }
        .icon-btn:hover { border-color:var(--primary); color:var(--primary); background:var(--primary-glow); }
        .icon-btn .dot { position:absolute; top:7px; right:7px; width:8px; height:8px; background:var(--danger); border-radius:50%; border:2px solid var(--bg); }

        /* Profile Dropdown */
        .profile-wrap { position:relative; }
        .profile-btn {
            display:flex; align-items:center; gap:10px; background:var(--bg3);
            border:1px solid var(--border); border-radius:12px; padding:6px 12px 6px 6px;
            cursor:pointer; transition:border-color var(--transition);
        }
        .profile-btn:hover { border-color:var(--primary); }
        .avatar {
            width:34px; height:34px;
            background:linear-gradient(135deg,var(--primary),#3B82F6);
            border-radius:50%; display:grid; place-items:center; font-size:14px; font-weight:700; flex-shrink:0;
        }
        .profile-info .pname { font-size:13px; font-weight:600; max-width:120px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
        .profile-info .prole { font-size:11px; color:#60A5FA; font-weight:500; }
        .profile-btn .chevron { color:var(--text-muted); font-size:12px; transition:transform var(--transition); }
        .profile-btn.open .chevron { transform:rotate(180deg); }

        .profile-dropdown {
            position:absolute; top:calc(100% + 10px); right:0; width:220px;
            background:var(--bg3); border:1px solid var(--border); border-radius:var(--radius);
            box-shadow:var(--shadow); overflow:hidden; opacity:0; pointer-events:none;
            transform:translateY(-6px); transition:opacity var(--transition),transform var(--transition); z-index:200;
        }
        .profile-dropdown.open { opacity:1; pointer-events:all; transform:translateY(0); }
        .dropdown-head { padding:16px; border-bottom:1px solid var(--border); display:flex; gap:10px; align-items:center; }
        .dropdown-head .dn { font-size:13px; font-weight:600; }
        .dropdown-head .de { font-size:11px; color:var(--text-muted); }
        .dropdown-item {
            display:flex; align-items:center; gap:10px; padding:11px 16px; font-size:13px;
            color:var(--text-muted); cursor:pointer; transition:background var(--transition),color var(--transition);
            border:none; background:none; width:100%; text-align:left; font-family:inherit; text-decoration:none;
        }
        .dropdown-item:hover { background:rgba(255,255,255,.04); color:var(--text); }
        .dropdown-item.danger { color:#EF4444; }
        .dropdown-item.danger:hover { background:rgba(239,68,68,.08); }
        .dropdown-divider { height:1px; background:var(--border); }

        /* ─── PAGE SECTIONS ─── */
        .content { padding:28px; flex:1; }
        .section { display:none; }
        .section.active { display:block; animation:fadeUp .4s ease both; }

        /* Greeting */
        .greeting { margin-bottom:28px; }
        .greeting h1 { font-size:26px; font-weight:800; }
        .greeting h1 span { color:#60A5FA; }
        .greeting p { font-size:14px; color:var(--text-muted); margin-top:4px; }
        .date-badge { display:inline-flex; align-items:center; gap:6px; background:var(--bg3); border:1px solid var(--border); border-radius:99px; padding:5px 14px; font-size:12px; color:var(--text-muted); margin-top:10px; }

        /* Stat Cards */
        .stats-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:18px; margin-bottom:28px; }
        .stat-card {
            background:var(--bg2); border:1px solid var(--border); border-radius:var(--radius);
            padding:22px 20px; position:relative; overflow:hidden; cursor:default;
            transition:transform var(--transition),border-color var(--transition),box-shadow var(--transition);
        }
        .stat-card:hover { transform:translateY(-4px); box-shadow:var(--shadow); border-color:var(--primary); }
        .stat-card .glow { position:absolute; top:-30px; right:-30px; width:100px; height:100px; border-radius:50%; opacity:.12; filter:blur(30px); }
        .stat-card.c1 .glow { background:var(--primary); }
        .stat-card.c2 .glow { background:var(--accent); }
        .stat-card.c3 .glow { background:var(--accent2); }
        .stat-card.c4 .glow { background:var(--info); }
        .stat-card.c5 .glow { background:#8B5CF6; }
        .stat-icon { width:44px; height:44px; border-radius:12px; display:grid; place-items:center; font-size:18px; margin-bottom:14px; }
        .stat-card.c1 .stat-icon { background:rgba(30,64,175,.15); color:#60A5FA; }
        .stat-card.c2 .stat-icon { background:rgba(245,158,11,.15); color:var(--accent); }
        .stat-card.c3 .stat-icon { background:rgba(16,185,129,.15); color:var(--accent2); }
        .stat-card.c4 .stat-icon { background:rgba(59,130,246,.15); color:var(--info); }
        .stat-card.c5 .stat-icon { background:rgba(139,92,246,.15); color:#8B5CF6; }
        .stat-label { font-size:12px; color:var(--text-muted); font-weight:500; text-transform:uppercase; letter-spacing:.05em; }
        .stat-value { font-size:30px; font-weight:800; margin:4px 0 6px; line-height:1; }
        .stat-trend { font-size:12px; display:inline-flex; align-items:center; gap:4px; padding:3px 8px; border-radius:99px; font-weight:600; }
        .trend-up { background:rgba(16,185,129,.12); color:var(--accent2); }
        .trend-flat { background:rgba(255,255,255,.06); color:var(--text-muted); }

        /* Cards */
        .card { background:var(--bg2); border:1px solid var(--border); border-radius:var(--radius); overflow:hidden; }
        .card-header { display:flex; align-items:center; justify-content:space-between; padding:18px 22px; border-bottom:1px solid var(--border); }
        .card-header h3 { font-size:15px; font-weight:700; }
        .card-header .see-all { font-size:12px; color:#60A5FA; cursor:pointer; text-decoration:none; }
        .card-header .see-all:hover { text-decoration:underline; }
        .card-body { padding:22px; }

        /* Grid layouts */
        .grid-2 { display:grid; grid-template-columns: 1fr 360px; gap:20px; margin-bottom:24px; }
        .grid-equal { display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:24px; }
        .grid-cols { display:flex; flex-direction:column; gap:20px; }

        /* ─── TABLE ─── */
        .table-wrap { overflow-x:auto; }
        table { width:100%; border-collapse:collapse; }
        thead th { padding:10px 14px; font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:.06em; color:var(--text-muted); background:var(--bg3); text-align:left; white-space:nowrap; }
        tbody td { padding:12px 14px; font-size:13px; border-bottom:1px solid var(--border); vertical-align:middle; }
        tbody tr:last-child td { border-bottom:none; }
        tbody tr:hover td { background:rgba(255,255,255,.02); }

        /* Search & filter bar */
        .toolbar { display:flex; align-items:center; gap:12px; padding:16px 22px; border-bottom:1px solid var(--border); flex-wrap:wrap; }
        .search-input {
            display:flex; align-items:center; gap:8px; background:var(--bg3); border:1px solid var(--border);
            border-radius:10px; padding:8px 14px; flex:1; min-width:220px;
        }
        .search-input input { background:none; border:none; outline:none; color:var(--text); font-family:inherit; font-size:13px; width:100%; }
        .search-input input::placeholder { color:var(--text-muted); }
        .search-input i { color:var(--text-muted); font-size:13px; }
        select.filter-sel {
            background:var(--bg3); border:1px solid var(--border); border-radius:10px;
            color:var(--text); padding:8px 14px; font-size:13px; font-family:inherit; outline:none; cursor:pointer;
        }
        select.filter-sel option { background:var(--bg3); }

        /* Pills */
        .pill { display:inline-block; font-size:10px; font-weight:700; padding:3px 9px; border-radius:99px; }
        .pill-blue   { background:rgba(30,64,175,.15); color:#60A5FA; }
        .pill-green  { background:rgba(16,185,129,.15); color:var(--accent2); }
        .pill-amber  { background:rgba(245,158,11,.15); color:var(--accent); }
        .pill-red    { background:rgba(239,68,68,.15); color:var(--danger); }
        .pill-purple { background:rgba(139,92,246,.15); color:#A78BFA; }

        /* Avatar init */
        .tbl-avatar { width:32px; height:32px; border-radius:50%; display:grid; place-items:center; font-size:12px; font-weight:700; flex-shrink:0; }

        /* Buttons */
        .btn { padding:8px 16px; border-radius:10px; border:none; font-size:13px; font-weight:600; cursor:pointer; font-family:inherit; transition:all var(--transition); display:inline-flex; align-items:center; gap:7px; text-decoration:none; }
        .btn-primary { background:var(--primary); color:#fff; }
        .btn-primary:hover { background:var(--primary-dark); transform:translateY(-1px); }
        .btn-success { background:var(--accent2); color:#fff; }
        .btn-success:hover { filter:brightness(1.1); }
        .btn-amber { background:var(--accent); color:#000; font-weight:700; }
        .btn-amber:hover { filter:brightness(1.1); }
        .btn-danger { background:rgba(239,68,68,.15); color:#EF4444; border:1px solid rgba(239,68,68,.2); }
        .btn-danger:hover { background:rgba(239,68,68,.25); }
        .btn-ghost { background:var(--bg3); color:var(--text-muted); border:1px solid var(--border); }
        .btn-ghost:hover { border-color:var(--primary); color:#60A5FA; }
        .btn-sm { padding:5px 12px; font-size:12px; border-radius:8px; }

        /* Export cards */
        .export-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:18px; margin-bottom:24px; }
        .export-card {
            background:var(--bg2); border:1px solid var(--border); border-radius:var(--radius);
            padding:24px; display:flex; flex-direction:column; gap:14px;
            transition:transform var(--transition),border-color var(--transition);
        }
        .export-card:hover { transform:translateY(-3px); border-color:var(--primary); }
        .export-icon { width:52px; height:52px; border-radius:14px; display:grid; place-items:center; font-size:22px; }
        .export-title { font-size:16px; font-weight:700; }
        .export-desc { font-size:13px; color:var(--text-muted); line-height:1.6; }
        .export-actions { display:flex; gap:10px; margin-top:4px; }

        /* Audit log */
        .audit-list { display:flex; flex-direction:column; }
        .audit-item {
            display:flex; align-items:flex-start; gap:14px; padding:14px 22px;
            border-bottom:1px solid var(--border); transition:background var(--transition);
        }
        .audit-item:last-child { border-bottom:none; }
        .audit-item:hover { background:rgba(255,255,255,.02); }
        .audit-icon { width:36px; height:36px; border-radius:10px; display:grid; place-items:center; font-size:14px; flex-shrink:0; margin-top:2px; }
        .audit-body { flex:1; }
        .audit-body .a-title { font-size:13px; font-weight:600; }
        .audit-body .a-desc  { font-size:12px; color:var(--text-muted); margin-top:2px; }
        .audit-body .a-meta  { display:flex; gap:12px; margin-top:6px; font-size:11px; color:var(--text-muted); }
        .audit-body .a-meta span { display:flex; align-items:center; gap:4px; }
        .audit-time { font-size:11px; color:var(--text-muted); white-space:nowrap; }
        .audit-unread { width:8px; height:8px; border-radius:50%; background:var(--primary); flex-shrink:0; margin-top:6px; }

        /* Chart containers */
        .chart-container { position:relative; }

        /* Section header */
        .section-heading { margin-bottom:22px; }
        .section-heading h2 { font-size:20px; font-weight:800; }
        .section-heading p { font-size:13px; color:var(--text-muted); margin-top:4px; }

        /* Quick stats row */
        .quick-row { display:flex; gap:12px; flex-wrap:wrap; margin-bottom:20px; }
        .quick-stat { background:var(--bg2); border:1px solid var(--border); border-radius:10px; padding:12px 18px; flex:1; min-width:140px; }
        .quick-stat .qs-label { font-size:11px; color:var(--text-muted); text-transform:uppercase; letter-spacing:.05em; }
        .quick-stat .qs-val   { font-size:22px; font-weight:800; margin-top:4px; }
        .quick-stat .qs-sub   { font-size:11px; color:var(--text-muted); }

        /* Pagination dummy */
        .pagination { display:flex; align-items:center; gap:6px; padding:16px 22px; border-top:1px solid var(--border); }
        .pag-btn { width:32px; height:32px; border-radius:8px; border:1px solid var(--border); background:none; color:var(--text-muted); cursor:pointer; display:grid; place-items:center; font-size:13px; }
        .pag-btn.active { background:var(--primary); border-color:var(--primary); color:#fff; }
        .pag-btn:hover:not(.active) { border-color:var(--primary); color:#60A5FA; }

        /* ─── ANIMATIONS ─── */
        @keyframes fadeUp { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:translateY(0); } }
        @keyframes slideDown { from { opacity:0; transform:translateY(-12px); } to { opacity:1; transform:translateY(0); } }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 1100px) { .grid-2 { grid-template-columns:1fr; } }
        @media (max-width: 900px)  { .grid-equal { grid-template-columns:1fr; } }
        @media (max-width: 820px) {
            .sidebar { transform:translateX(-100%); }
            .sidebar.open { transform:translateX(0); }
            .main { margin-left:0; }
            .hamburger { display:grid; }
            .content { padding:20px; }
            .stats-grid { grid-template-columns:repeat(2,1fr); }
            .profile-info { display:none; }
        }
        @media (max-width: 480px) {
            .stats-grid { grid-template-columns:1fr; }
            .topbar { padding:0 16px; }
        }
    </style>
</head>

<body>
    <div class="overlay" id="overlay" onclick="closeSidebar()"></div>

    <!-- ═══════ SIDEBAR ═══════ -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <div class="logo-icon">🏛️</div>
            <div>
                <span class="name">YARSI Beasiswa</span>
                <span class="sub">Wakil Rektor Panel</span>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-label">Pemantauan</div>

            <button class="nav-item active" id="nav-overview" onclick="showSection('overview', this)">
                <i class="fa-solid fa-house-chimney"></i> Overview
            </button>
            <button class="nav-item" id="nav-monitoring" onclick="showSection('monitoring', this)">
                <i class="fa-solid fa-table-list"></i> Monitoring Terpadu
            </button>
            <button class="nav-item" id="nav-statistik" onclick="showSection('statistik', this)">
                <i class="fa-solid fa-chart-column"></i> Dashboard Statistik
            </button>

            <div class="nav-label" style="margin-top:10px;">Laporan & Kebijakan</div>

            <button class="nav-item" id="nav-laporan" onclick="showSection('laporan', this)">
                <i class="fa-solid fa-file-export"></i> Ekspor Laporan
                <span class="nav-badge" style="background:var(--accent);">Baru</span>
            </button>
            <button class="nav-item" id="nav-audit" onclick="showSection('audit', this)">
                <i class="fa-solid fa-shield-halved"></i> Audit Activity Log
            </button>

            <div class="nav-label" style="margin-top:10px;">Akun</div>

            <button class="nav-item" onclick="">
                <i class="fa-solid fa-circle-user"></i> Profil Saya
            </button>
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar dari Sistem
                </button>
            </form>
        </div>
    </aside>

    <!-- ═══════ MAIN ═══════ -->
    <div class="main" id="main">

        <!-- TOPBAR -->
        <header class="topbar">
            <button class="hamburger" id="hamburger" onclick="toggleSidebar()">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="topbar-title" id="topbarTitle">
                Dashboard <span>Wakil Rektor</span>
            </div>
            <div class="topbar-actions">
                <div class="icon-btn" title="Notifikasi">
                    <i class="fa-solid fa-bell"></i>
                    <span class="dot"></span>
                </div>
                <div class="profile-wrap">
                    <div class="profile-btn" id="profileBtn" onclick="toggleDropdown()">
                        <div class="avatar">W</div>
                        <div class="profile-info">
                            <div class="pname">{{ $user->nama ?? 'Warek' }}</div>
                            <div class="prole">Wakil Rektor</div>
                        </div>
                        <i class="fa-solid fa-chevron-down chevron"></i>
                    </div>
                    <div class="profile-dropdown" id="profileDropdown">
                        <div class="dropdown-head">
                            <div class="avatar" style="width:40px;height:40px;font-size:16px;">
                                {{ strtoupper(substr($user->nama ?? 'W', 0, 1)) }}
                            </div>
                            <div>
                                <div class="dn">{{ $user->nama ?? 'Wakil Rektor' }}</div>
                                <div class="de">{{ $user->email ?? 'warek@yarsi.ac.id' }}</div>
                            </div>
                        </div>
                        <a href="#" class="dropdown-item"><i class="fa-solid fa-user fa-fw"></i> Profil Saya</a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item danger">
                                <i class="fa-solid fa-right-from-bracket fa-fw"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- CONTENT -->
        <div class="content">

            <!-- ════════ SECTION: OVERVIEW ════════ -->
            <div class="section active" id="section-overview">
                <div class="greeting">
                    <h1>Selamat Datang, <span id="greetName">{{ explode(' ', $user->nama ?? 'Warek')[0] }}</span> 👋</h1>
                    <p>Ringkasan pemantauan beasiswa tingkat universitas.</p>
                    <div class="date-badge">
                        <i class="fa-regular fa-calendar"></i>
                        <span id="dateStr"></span>
                    </div>
                </div>

                <div class="stats-grid">
                    <div class="stat-card c1">
                        <div class="glow"></div>
                        <div class="stat-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                        <div class="stat-label">Total Penerima Aktif</div>
                        <div class="stat-value" data-count="1247">0</div>
                        <span class="stat-trend trend-up"><i class="fa-solid fa-arrow-trend-up"></i> +87 semester ini</span>
                    </div>
                    <div class="stat-card c2">
                        <div class="glow"></div>
                        <div class="stat-icon"><i class="fa-solid fa-coins"></i></div>
                        <div class="stat-label">Total Dana Tersalurkan</div>
                        <div class="stat-value" id="danaVal" style="font-size:22px;">Rp 0</div>
                        <span class="stat-trend trend-up"><i class="fa-solid fa-arrow-trend-up"></i> Semester Genap 2025</span>
                    </div>
                    <div class="stat-card c3">
                        <div class="glow"></div>
                        <div class="stat-icon"><i class="fa-solid fa-university"></i></div>
                        <div class="stat-label">Fakultas Terlibat</div>
                        <div class="stat-value" data-count="8">0</div>
                        <span class="stat-trend trend-flat"><i class="fa-solid fa-minus"></i> Semua Fakultas</span>
                    </div>
                    <div class="stat-card c4">
                        <div class="glow"></div>
                        <div class="stat-icon"><i class="fa-solid fa-file-circle-check"></i></div>
                        <div class="stat-label">Pengajuan Diproses</div>
                        <div class="stat-value" data-count="342">0</div>
                        <span class="stat-trend trend-up"><i class="fa-solid fa-arrow-trend-up"></i> +23 minggu ini</span>
                    </div>
                    <div class="stat-card c5">
                        <div class="glow"></div>
                        <div class="stat-icon"><i class="fa-solid fa-trophy"></i></div>
                        <div class="stat-label">Program Beasiswa</div>
                        <div class="stat-value" data-count="12">0</div>
                        <span class="stat-trend trend-up"><i class="fa-solid fa-arrow-trend-up"></i> 3 baru aktif</span>
                    </div>
                </div>

                <div class="grid-2">
                    <div class="grid-cols">
                        <!-- Trend Dana Bar Chart -->
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fa-solid fa-chart-line" style="color:#60A5FA;margin-right:8px;"></i>Tren Dana Tersalurkan</h3>
                                <span style="font-size:12px;color:var(--text-muted);">6 Bulan Terakhir</span>
                            </div>
                            <div class="card-body">
                                <div class="chart-container" style="height:200px;">
                                    <canvas id="chartTrenDana"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- Faculty Distribution -->
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fa-solid fa-chart-bar" style="color:#60A5FA;margin-right:8px;"></i>Penerima per Fakultas</h3>
                                <button class="btn btn-ghost btn-sm" onclick="showSection('statistik', document.getElementById('nav-statistik'))">Lihat Detail</button>
                            </div>
                            <div class="card-body">
                                <div class="chart-container" style="height:220px;">
                                    <canvas id="chartFakultas"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT -->
                    <div class="grid-cols">
                        <!-- Donut Status -->
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fa-solid fa-chart-pie" style="color:#60A5FA;margin-right:8px;"></i>Status Beasiswa</h3>
                            </div>
                            <div class="card-body" style="display:flex;flex-direction:column;align-items:center;gap:16px;">
                                <div class="chart-container" style="width:160px;height:160px;">
                                    <canvas id="chartDonutStatus"></canvas>
                                </div>
                                <div style="width:100%;display:flex;flex-direction:column;gap:8px;">
                                    <div style="display:flex;justify-content:space-between;font-size:13px;">
                                        <span style="display:flex;align-items:center;gap:8px;color:var(--text-muted);"><span style="width:10px;height:10px;border-radius:50%;background:#60A5FA;display:inline-block;"></span>Aktif</span>
                                        <strong>1,247</strong>
                                    </div>
                                    <div style="display:flex;justify-content:space-between;font-size:13px;">
                                        <span style="display:flex;align-items:center;gap:8px;color:var(--text-muted);"><span style="width:10px;height:10px;border-radius:50%;background:#F59E0B;display:inline-block;"></span>Menunggu</span>
                                        <strong>88</strong>
                                    </div>
                                    <div style="display:flex;justify-content:space-between;font-size:13px;">
                                        <span style="display:flex;align-items:center;gap:8px;color:var(--text-muted);"><span style="width:10px;height:10px;border-radius:50%;background:#EF4444;display:inline-block;"></span>Ditolak</span>
                                        <strong>7</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Aksi Cepat -->
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fa-solid fa-bolt" style="color:var(--accent);margin-right:8px;"></i>Aksi Cepat</h3>
                            </div>
                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;padding:18px;">
                                <button class="btn btn-primary" onclick="showSection('monitoring', document.getElementById('nav-monitoring'))" style="flex-direction:column;padding:16px 10px;height:auto;gap:6px;">
                                    <i class="fa-solid fa-table-list" style="font-size:18px;"></i>
                                    <span style="font-size:11px;text-align:center;">Monitoring</span>
                                </button>
                                <button class="btn btn-amber" onclick="showSection('laporan', document.getElementById('nav-laporan'))" style="flex-direction:column;padding:16px 10px;height:auto;gap:6px;">
                                    <i class="fa-solid fa-file-export" style="font-size:18px;"></i>
                                    <span style="font-size:11px;text-align:center;">Ekspor</span>
                                </button>
                                <button class="btn btn-success" onclick="showSection('statistik', document.getElementById('nav-statistik'))" style="flex-direction:column;padding:16px 10px;height:auto;gap:6px;">
                                    <i class="fa-solid fa-chart-column" style="font-size:18px;"></i>
                                    <span style="font-size:11px;text-align:center;">Statistik</span>
                                </button>
                                <button class="btn btn-ghost" onclick="showSection('audit', document.getElementById('nav-audit'))" style="flex-direction:column;padding:16px 10px;height:auto;gap:6px;">
                                    <i class="fa-solid fa-shield-halved" style="font-size:18px;color:#A78BFA;"></i>
                                    <span style="font-size:11px;text-align:center;">Audit Log</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ════════ SECTION: MONITORING TERPADU ════════ -->
            <div class="section" id="section-monitoring">
                <div class="section-heading">
                    <h2><i class="fa-solid fa-table-list" style="color:#60A5FA;margin-right:10px;"></i>Monitoring Terpadu</h2>
                    <p>Data seluruh mahasiswa penerima beasiswa se-universitas dalam satu tampilan.</p>
                </div>

                <div class="quick-row">
                    <div class="quick-stat">
                        <div class="qs-label">Total Penerima</div>
                        <div class="qs-val" style="color:#60A5FA;">1.247</div>
                        <div class="qs-sub">Semua Fakultas</div>
                    </div>
                    <div class="quick-stat">
                        <div class="qs-label">Full Funded</div>
                        <div class="qs-val" style="color:var(--accent2);">834</div>
                        <div class="qs-sub">67% dari total</div>
                    </div>
                    <div class="quick-stat">
                        <div class="qs-label">Partial Funded</div>
                        <div class="qs-val" style="color:var(--accent);">319</div>
                        <div class="qs-sub">26% dari total</div>
                    </div>
                    <div class="quick-stat">
                        <div class="qs-label">One Shot</div>
                        <div class="qs-val" style="color:#A78BFA;">94</div>
                        <div class="qs-sub">7% dari total</div>
                    </div>
                </div>

                <div class="card">
                    <div class="toolbar">
                        <div class="search-input">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" placeholder="Cari nama, NPM, atau prodi..." id="searchMonitoring" oninput="filterTable()">
                        </div>
                        <select class="filter-sel" id="filterFakultas" onchange="filterTable()">
                            <option value="">Semua Fakultas</option>
                            <option>FK</option>
                            <option>FKG</option>
                            <option>FH</option>
                            <option>FEB</option>
                            <option>FT</option>
                            <option>FISIP</option>
                            <option>FPsi</option>
                            <option>FKM</option>
                        </select>
                        <select class="filter-sel" id="filterSumber" onchange="filterTable()">
                            <option value="">Semua Sumber Dana</option>
                            <option>YARSI Internal</option>
                            <option>Kemendikbud</option>
                            <option>Beasiswa Hafidz</option>
                            <option>CSR Bank Syariah</option>
                            <option>Beasiswa Yatim</option>
                        </select>
                    </div>
                    <div class="table-wrap">
                        <table id="monitoringTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>NPM</th>
                                    <th>Program Studi</th>
                                    <th>Fakultas</th>
                                    <th>Jenis Beasiswa</th>
                                    <th>Sumber Dana</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="monitoringTbody">
                                <!-- rows generated by JS -->
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination" id="monitoringPagination"></div>
                </div>
            </div>

            <!-- ════════ SECTION: STATISTIK ════════ -->
            <div class="section" id="section-statistik">
                <div class="section-heading">
                    <h2><i class="fa-solid fa-chart-column" style="color:#60A5FA;margin-right:10px;"></i>Dashboard Statistik Universitas</h2>
                    <p>Visualisasi total dana tersalurkan dan sebaran beasiswa antar fakultas.</p>
                </div>

                <div class="stats-grid" style="grid-template-columns:repeat(auto-fit,minmax(180px,1fr));margin-bottom:24px;">
                    <div class="stat-card c1"><div class="glow"></div>
                        <div class="stat-icon"><i class="fa-solid fa-coins"></i></div>
                        <div class="stat-label">Total Dana Yayasan</div>
                        <div class="stat-value" style="font-size:18px;">Rp 8,4 M</div>
                        <span class="stat-trend trend-up"><i class="fa-solid fa-arrow-trend-up"></i> +12% YoY</span>
                    </div>
                    <div class="stat-card c2"><div class="glow"></div>
                        <div class="stat-icon"><i class="fa-solid fa-landmark"></i></div>
                        <div class="stat-label">Dana Pemerintah</div>
                        <div class="stat-value" style="font-size:18px;">Rp 3,2 M</div>
                        <span class="stat-trend trend-up"><i class="fa-solid fa-arrow-trend-up"></i> KIP & Kemendikbud</span>
                    </div>
                    <div class="stat-card c3"><div class="glow"></div>
                        <div class="stat-icon"><i class="fa-solid fa-handshake"></i></div>
                        <div class="stat-label">Dana CSR / Mitra</div>
                        <div class="stat-value" style="font-size:18px;">Rp 1,6 M</div>
                        <span class="stat-trend trend-flat"><i class="fa-solid fa-minus"></i> Stabil</span>
                    </div>
                    <div class="stat-card c4"><div class="glow"></div>
                        <div class="stat-icon"><i class="fa-solid fa-piggy-bank"></i></div>
                        <div class="stat-label">Total Tersalurkan</div>
                        <div class="stat-value" style="font-size:18px;">Rp 13,2 M</div>
                        <span class="stat-trend trend-up"><i class="fa-solid fa-arrow-trend-up"></i> Semester Genap</span>
                    </div>
                </div>

                <div class="grid-equal">
                    <!-- Bar: Dana per Fakultas -->
                    <div class="card">
                        <div class="card-header">
                            <h3><i class="fa-solid fa-chart-bar" style="color:#60A5FA;margin-right:8px;"></i>Dana Tersalurkan per Fakultas</h3>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="height:280px;">
                                <canvas id="chartDanaFakultas"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- Pie: Sebaran Jenis -->
                    <div class="card">
                        <div class="card-header">
                            <h3><i class="fa-solid fa-chart-pie" style="color:#60A5FA;margin-right:8px;"></i>Sebaran Jenis Beasiswa</h3>
                        </div>
                        <div class="card-body" style="display:flex;flex-direction:column;align-items:center;gap:16px;">
                            <div class="chart-container" style="height:200px;width:100%;">
                                <canvas id="chartJenisBeasiswa"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid-equal">
                    <!-- Line: Tren Bulanan -->
                    <div class="card">
                        <div class="card-header">
                            <h3><i class="fa-solid fa-chart-line" style="color:#60A5FA;margin-right:8px;"></i>Tren Penerima per Semester</h3>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="height:220px;">
                                <canvas id="chartTrenSemester"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- Radar: Sebaran Prodi -->
                    <div class="card">
                        <div class="card-header">
                            <h3><i class="fa-solid fa-circle-nodes" style="color:#60A5FA;margin-right:8px;"></i>Sebaran per Sumber Dana</h3>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="height:220px;">
                                <canvas id="chartSumberDana"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ════════ SECTION: EKSPOR LAPORAN ════════ -->
            <div class="section" id="section-laporan">
                <div class="section-heading">
                    <h2><i class="fa-solid fa-file-export" style="color:#60A5FA;margin-right:10px;"></i>Ekspor Laporan</h2>
                    <p>Unduh data laporan dalam format Excel atau PDF untuk kebutuhan rapat pimpinan.</p>
                </div>

                <div class="export-grid">
                    <!-- Laporan Penerima -->
                    <div class="export-card">
                        <div class="export-icon" style="background:rgba(30,64,175,.15);color:#60A5FA;">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div class="export-title">Laporan Penerima Beasiswa</div>
                        <div class="export-desc">Data lengkap seluruh mahasiswa penerima beasiswa aktif se-universitas beserta detail program dan sumber dana.</div>
                        <div class="export-actions">
                            <button class="btn btn-success" onclick="simulateDownload('Excel - Laporan Penerima')">
                                <i class="fa-solid fa-file-excel"></i> Excel
                            </button>
                            <button class="btn btn-danger" onclick="simulateDownload('PDF - Laporan Penerima')">
                                <i class="fa-solid fa-file-pdf"></i> PDF
                            </button>
                        </div>
                    </div>

                    <!-- Laporan Dana -->
                    <div class="export-card">
                        <div class="export-icon" style="background:rgba(245,158,11,.15);color:var(--accent);">
                            <i class="fa-solid fa-coins"></i>
                        </div>
                        <div class="export-title">Laporan Realisasi Dana</div>
                        <div class="export-desc">Ringkasan total dana yang telah tersalurkan per program, per fakultas, dan per semester untuk laporan keuangan.</div>
                        <div class="export-actions">
                            <button class="btn btn-success" onclick="simulateDownload('Excel - Realisasi Dana')">
                                <i class="fa-solid fa-file-excel"></i> Excel
                            </button>
                            <button class="btn btn-danger" onclick="simulateDownload('PDF - Realisasi Dana')">
                                <i class="fa-solid fa-file-pdf"></i> PDF
                            </button>
                        </div>
                    </div>

                    <!-- Laporan Statistik Universitas -->
                    <div class="export-card">
                        <div class="export-icon" style="background:rgba(16,185,129,.15);color:var(--accent2);">
                            <i class="fa-solid fa-chart-bar"></i>
                        </div>
                        <div class="export-title">Laporan Statistik Universitas</div>
                        <div class="export-desc">Grafik dan tabel sebaran penerima beasiswa antar fakultas, prodi, dan angkatan untuk presentasi pimpinan.</div>
                        <div class="export-actions">
                            <button class="btn btn-success" onclick="simulateDownload('Excel - Statistik Universitas')">
                                <i class="fa-solid fa-file-excel"></i> Excel
                            </button>
                            <button class="btn btn-danger" onclick="simulateDownload('PDF - Statistik Universitas')">
                                <i class="fa-solid fa-file-pdf"></i> PDF
                            </button>
                        </div>
                    </div>

                    <!-- Laporan Audit -->
                    <div class="export-card">
                        <div class="export-icon" style="background:rgba(139,92,246,.15);color:#A78BFA;">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <div class="export-title">Laporan Audit Sistem</div>
                        <div class="export-desc">Riwayat seluruh aktivitas login, persetujuan, dan perubahan data untuk keperluan audit transparansi.</div>
                        <div class="export-actions">
                            <button class="btn btn-success" onclick="simulateDownload('Excel - Audit Log')">
                                <i class="fa-solid fa-file-excel"></i> Excel
                            </button>
                            <button class="btn btn-danger" onclick="simulateDownload('PDF - Audit Log')">
                                <i class="fa-solid fa-file-pdf"></i> PDF
                            </button>
                        </div>
                    </div>

                    <!-- Laporan Per Semester -->
                    <div class="export-card">
                        <div class="export-icon" style="background:rgba(59,130,246,.15);color:var(--info);">
                            <i class="fa-solid fa-calendar-days"></i>
                        </div>
                        <div class="export-title">Laporan Per Semester</div>
                        <div class="export-desc">Perbandingan data penerima beasiswa antarsemester untuk evaluasi kebijakan dan perencanaan anggaran.</div>
                        <div class="export-actions">
                            <select class="filter-sel" style="flex:1;padding:7px 12px;">
                                <option>Genap 2024/2025</option>
                                <option>Ganjil 2024/2025</option>
                                <option>Genap 2023/2024</option>
                            </select>
                            <button class="btn btn-primary" onclick="simulateDownload('PDF - Laporan Semester')">
                                <i class="fa-solid fa-download"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Custom Report -->
                    <div class="export-card">
                        <div class="export-icon" style="background:rgba(239,68,68,.12);color:#EF4444;">
                            <i class="fa-solid fa-sliders"></i>
                        </div>
                        <div class="export-title">Laporan Kustom</div>
                        <div class="export-desc">Buat laporan dengan filter spesifik – pilih rentang tanggal, fakultas, dan jenis beasiswa sesuai kebutuhan.</div>
                        <div class="export-actions">
                            <button class="btn btn-ghost" style="flex:1;" onclick="alert('Fitur laporan kustom akan segera tersedia.')">
                                <i class="fa-solid fa-sliders"></i> Buat Laporan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Download History -->
                <div class="card" style="margin-top:8px;">
                    <div class="card-header">
                        <h3><i class="fa-solid fa-clock-rotate-left" style="color:#60A5FA;margin-right:8px;"></i>Riwayat Unduhan</h3>
                        <span style="font-size:12px;color:var(--text-muted);">7 hari terakhir</span>
                    </div>
                    <div class="table-wrap">
                        <table>
                            <thead><tr><th>Nama Laporan</th><th>Format</th><th>Diunduh Oleh</th><th>Tanggal</th><th>Ukuran</th></tr></thead>
                            <tbody id="downloadHistory">
                                <tr><td>Laporan Penerima Beasiswa</td><td><span class="pill pill-green">Excel</span></td><td>Wakil Rektor</td><td>19 Apr 2025, 14:22</td><td>2.4 MB</td></tr>
                                <tr><td>Statistik Universitas Q1 2025</td><td><span class="pill pill-red">PDF</span></td><td>Wakil Rektor</td><td>17 Apr 2025, 09:10</td><td>1.8 MB</td></tr>
                                <tr><td>Realisasi Dana Sem. Genap</td><td><span class="pill pill-green">Excel</span></td><td>Wakil Rektor</td><td>14 Apr 2025, 11:45</td><td>3.1 MB</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ════════ SECTION: AUDIT LOG ════════ -->
            <div class="section" id="section-audit">
                <div class="section-heading">
                    <h2><i class="fa-solid fa-shield-halved" style="color:#A78BFA;margin-right:10px;"></i>Audit Activity Log</h2>
                    <p>Riwayat seluruh aktivitas sistem untuk memastikan transparansi dan akuntabilitas.</p>
                </div>

                <div class="quick-row">
                    <div class="quick-stat">
                        <div class="qs-label">Total Aktivitas Hari Ini</div>
                        <div class="qs-val" style="color:#A78BFA;">247</div>
                        <div class="qs-sub">Terakhir 06:00 – sekarang</div>
                    </div>
                    <div class="quick-stat">
                        <div class="qs-label">Login Berhasil</div>
                        <div class="qs-val" style="color:var(--accent2);">89</div>
                        <div class="qs-sub">Semua Role</div>
                    </div>
                    <div class="quick-stat">
                        <div class="qs-label">Perubahan Data</div>
                        <div class="qs-val" style="color:var(--accent);">34</div>
                        <div class="qs-sub">Update & Delete</div>
                    </div>
                    <div class="quick-stat">
                        <div class="qs-label">Percobaan Login Gagal</div>
                        <div class="qs-val" style="color:var(--danger);">3</div>
                        <div class="qs-sub">Hari ini</div>
                    </div>
                </div>

                <div class="card">
                    <div class="toolbar">
                        <div class="search-input">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" placeholder="Cari aktivitas, pengguna, atau aksi...">
                        </div>
                        <select class="filter-sel">
                            <option>Semua Aktivitas</option>
                            <option>Login</option>
                            <option>Persetujuan</option>
                            <option>Perubahan Data</option>
                            <option>Ekspor</option>
                        </select>
                        <select class="filter-sel">
                            <option>Semua Role</option>
                            <option>Warek</option>
                            <option>PUSKAKA</option>
                            <option>Wadek</option>
                            <option>Kaprodi</option>
                            <option>Mahasiswa</option>
                        </select>
                        <button class="btn btn-ghost btn-sm" onclick="simulateDownload('PDF - Audit Log')">
                            <i class="fa-solid fa-file-export"></i> Ekspor Log
                        </button>
                    </div>
                    <div class="audit-list" id="auditList">
                        <!-- generated by JS -->
                    </div>
                    <div class="pagination">
                        <button class="pag-btn"><i class="fa-solid fa-chevron-left" style="font-size:10px;"></i></button>
                        <button class="pag-btn active">1</button>
                        <button class="pag-btn">2</button>
                        <button class="pag-btn">3</button>
                        <button class="pag-btn"><i class="fa-solid fa-chevron-right" style="font-size:10px;"></i></button>
                        <span style="margin-left:auto;font-size:12px;color:var(--text-muted);">247 aktivitas ditemukan</span>
                    </div>
                </div>
            </div>

        </div><!-- /content -->
    </div><!-- /main -->

    <!-- Hidden logout form -->
    <form id="logoutForm" method="POST" action="{{ route('logout') }}" style="display:none;">@csrf</form>

    <!-- Download toast -->
    <div id="toast" style="
        position:fixed; bottom:28px; right:28px; background:#1F2937; border:1px solid rgba(96,165,250,.3);
        color:#E2E8F0; padding:14px 20px; border-radius:12px; font-size:13px; font-weight:500;
        display:none; align-items:center; gap:10px; z-index:9999; box-shadow:0 8px 32px rgba(0,0,0,.5);
        animation:slideDown .3s ease;">
        <i class="fa-solid fa-circle-check" style="color:var(--accent2);"></i>
        <span id="toastMsg">Laporan berhasil diunduh!</span>
    </div>

    <script>
    /* ─── SIDEBAR ─── */
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('overlay').classList.toggle('active');
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('overlay').classList.remove('active');
    }

    /* ─── PROFILE DROPDOWN ─── */
    function toggleDropdown() {
        document.getElementById('profileBtn').classList.toggle('open');
        document.getElementById('profileDropdown').classList.toggle('open');
    }
    document.addEventListener('click', e => {
        const wrap = document.querySelector('.profile-wrap');
        if (!wrap.contains(e.target)) {
            document.getElementById('profileBtn').classList.remove('open');
            document.getElementById('profileDropdown').classList.remove('open');
        }
    });

    /* ─── SECTION NAVIGATION ─── */
    const sectionTitles = {
        overview:    'Dashboard <span>Wakil Rektor</span>',
        monitoring:  'Monitoring <span>Terpadu</span>',
        statistik:   'Dashboard <span>Statistik</span>',
        laporan:     'Ekspor <span>Laporan</span>',
        audit:       'Audit <span>Activity Log</span>',
    };
    function showSection(id, btn) {
        document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
        document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
        document.getElementById('section-' + id).classList.add('active');
        if (btn) btn.classList.add('active');
        document.getElementById('topbarTitle').innerHTML = sectionTitles[id] || id;
        closeSidebar();
        if (id === 'statistik') initStatistikCharts();
        if (id === 'overview')  initOverviewCharts();
    }

    /* ─── DATE ─── */
    const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    const now = new Date();
    document.getElementById('dateStr').textContent = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;

    /* ─── COUNT-UP ─── */
    const countEls = document.querySelectorAll('[data-count]');
    const cObs = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            const el = entry.target, target = +el.dataset.count;
            let cur = 0; const inc = target / 60;
            const t = setInterval(() => {
                cur += inc; if (cur >= target) { cur = target; clearInterval(t); }
                el.textContent = Math.floor(cur).toLocaleString('id-ID');
            }, 16);
            cObs.unobserve(el);
        });
    }, { threshold: 0.3 });
    countEls.forEach(el => cObs.observe(el));

    // Animate Dana value
    let danaAnimated = false;
    const danaObs = new IntersectionObserver(entries => {
        if (!entries[0].isIntersecting || danaAnimated) return;
        danaAnimated = true;
        let v = 0; const target = 13200000000; const step = target / 60;
        const t = setInterval(() => {
            v += step; if (v >= target) { v = target; clearInterval(t); }
            document.getElementById('danaVal').textContent = 'Rp ' + (v/1000000).toFixed(1).replace('.', ',') + ' M';
        }, 16);
    }, { threshold: 0.3 });
    const danaEl = document.getElementById('danaVal');
    if (danaEl) danaObs.observe(danaEl);

    /* ─── MONITORING TABLE DATA ─── */
    const monitoringData = [
        { no:1,  nama:'Ahmad Fauzi',        npm:'2210101001', prodi:'Kedokteran', fakultas:'FK',    jenis:'Full Funded',    sumber:'YARSI Internal',  status:'Aktif' },
        { no:2,  nama:'Siti Nurhaliza',      npm:'2210202002', prodi:'Kedokteran Gigi', fakultas:'FKG', jenis:'Full Funded', sumber:'Kemendikbud', status:'Aktif' },
        { no:3,  nama:'Budi Santoso',        npm:'2210303003', prodi:'Hukum',      fakultas:'FH',    jenis:'Partial Funded', sumber:'CSR Bank Syariah', status:'Aktif' },
        { no:4,  nama:'Dewi Lestari',        npm:'2210404004', prodi:'Manajemen',  fakultas:'FEB',   jenis:'Full Funded',    sumber:'YARSI Internal',  status:'Aktif' },
        { no:5,  nama:'Rizky Pratama',       npm:'2210505005', prodi:'Teknik Informatika', fakultas:'FT', jenis:'One Shot', sumber:'Beasiswa Hafidz', status:'Aktif' },
        { no:6,  nama:'Nurul Hidayah',       npm:'2210606006', prodi:'Ilmu Komunikasi', fakultas:'FISIP', jenis:'Partial Funded', sumber:'Kemendikbud', status:'Aktif' },
        { no:7,  nama:'Fajar Ramadhan',      npm:'2210707007', prodi:'Psikologi',  fakultas:'FPsi',  jenis:'Full Funded',    sumber:'YARSI Internal',  status:'Aktif' },
        { no:8,  nama:'Anisa Putri',         npm:'2210808008', prodi:'Kesehatan Masyarakat', fakultas:'FKM', jenis:'Full Funded', sumber:'Kemendikbud', status:'Menunggu' },
        { no:9,  nama:'Hendra Wijaya',       npm:'2210101009', prodi:'Kedokteran', fakultas:'FK',    jenis:'Partial Funded', sumber:'Beasiswa Yatim', status:'Aktif' },
        { no:10, nama:'Maya Sari',           npm:'2210202010', prodi:'Kedokteran Gigi', fakultas:'FKG', jenis:'Full Funded', sumber:'YARSI Internal', status:'Aktif' },
        { no:11, nama:'Dino Aditya',         npm:'2210303011', prodi:'Hukum Bisnis', fakultas:'FH', jenis:'One Shot', sumber:'Beasiswa Hafidz', status:'Aktif' },
        { no:12, nama:'Rina Wahyuni',        npm:'2210404012', prodi:'Akuntansi',  fakultas:'FEB',   jenis:'Partial Funded', sumber:'CSR Bank Syariah', status:'Aktif' },
        { no:13, nama:'Galih Saputra',       npm:'2210505013', prodi:'Teknik Elektro', fakultas:'FT', jenis:'Full Funded', sumber:'Kemendikbud', status:'Aktif' },
        { no:14, nama:'Ayu Wulandari',       npm:'2210606014', prodi:'Hubungan Internasional', fakultas:'FISIP', jenis:'Full Funded', sumber:'YARSI Internal', status:'Aktif' },
        { no:15, nama:'Irfan Hakim',         npm:'2210707015', prodi:'Psikologi Klinis', fakultas:'FPsi', jenis:'Partial Funded', sumber:'Beasiswa Yatim', status:'Menunggu' },
    ];

    const perPage = 10; let currentPage = 1; let filteredData = [...monitoringData];

    const statusColor = { 'Aktif':'pill-green', 'Menunggu':'pill-amber', 'Ditolak':'pill-red' };
    const jenisColor  = { 'Full Funded':'pill-blue', 'Partial Funded':'pill-amber', 'One Shot':'pill-purple' };
    const avatarColors= ['rgba(30,64,175,.25)','rgba(16,185,129,.25)','rgba(245,158,11,.25)','rgba(139,92,246,.25)','rgba(59,130,246,.25)'];
    const avatarTxt   = ['#60A5FA','#10B981','#F59E0B','#A78BFA','#3B82F6'];

    function renderTable() {
        const tbody = document.getElementById('monitoringTbody');
        const start = (currentPage - 1) * perPage;
        const rows = filteredData.slice(start, start + perPage);
        const initials = n => n.split(' ').map(w=>w[0]).join('').substring(0,2).toUpperCase();
        tbody.innerHTML = rows.map((r, i) => `
            <tr>
                <td style="color:var(--text-muted);">${start + i + 1}</td>
                <td>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div class="tbl-avatar" style="background:${avatarColors[i%5]};color:${avatarTxt[i%5]};">${initials(r.nama)}</div>
                        <span style="font-weight:600;">${r.nama}</span>
                    </div>
                </td>
                <td style="color:var(--text-muted);font-family:monospace;">${r.npm}</td>
                <td>${r.prodi}</td>
                <td><span class="pill pill-blue">${r.fakultas}</span></td>
                <td><span class="pill ${jenisColor[r.jenis]}">${r.jenis}</span></td>
                <td style="color:var(--text-muted);">${r.sumber}</td>
                <td><span class="pill ${statusColor[r.status]}">${r.status}</span></td>
            </tr>
        `).join('');
        renderPagination();
    }

    function renderPagination() {
        const total = Math.ceil(filteredData.length / perPage);
        const pag = document.getElementById('monitoringPagination');
        let html = `<button class="pag-btn" onclick="changePage(${currentPage-1})" ${currentPage===1?'disabled':''}>
            <i class="fa-solid fa-chevron-left" style="font-size:10px;"></i></button>`;
        for (let i=1;i<=total;i++) html += `<button class="pag-btn${i===currentPage?' active':''}" onclick="changePage(${i})">${i}</button>`;
        html += `<button class="pag-btn" onclick="changePage(${currentPage+1})" ${currentPage===total?'disabled':''}><i class="fa-solid fa-chevron-right" style="font-size:10px;"></i></button>`;
        html += `<span style="margin-left:auto;font-size:12px;color:var(--text-muted);">${filteredData.length} penerima ditemukan</span>`;
        pag.innerHTML = html;
    }

    function changePage(p) { const total = Math.ceil(filteredData.length/perPage); if(p<1||p>total)return; currentPage=p; renderTable(); }

    function filterTable() {
        const q  = document.getElementById('searchMonitoring').value.toLowerCase();
        const fk = document.getElementById('filterFakultas').value;
        const fs = document.getElementById('filterSumber').value;
        filteredData = monitoringData.filter(r =>
            (!q  || r.nama.toLowerCase().includes(q) || r.npm.includes(q) || r.prodi.toLowerCase().includes(q)) &&
            (!fk || r.fakultas === fk) &&
            (!fs || r.sumber === fs)
        );
        currentPage = 1;
        renderTable();
    }

    /* ─── AUDIT LOG DATA ─── */
    const auditData = [
        { icon:'fa-right-to-bracket', icolor:'rgba(30,64,175,.2)', ictxt:'#60A5FA', title:'Login Berhasil', desc:'Wakil Rektor masuk ke sistem', ip:'192.168.1.10', role:'Warek', time:'2 menit lalu', unread:true },
        { icon:'fa-file-export', icolor:'rgba(16,185,129,.2)', ictxt:'#10B981', title:'Ekspor Laporan', desc:'Laporan Penerima Beasiswa diunduh dalam format Excel', ip:'192.168.1.10', role:'Warek', time:'15 menit lalu', unread:true },
        { icon:'fa-circle-check', icolor:'rgba(16,185,129,.2)', ictxt:'#10B981', title:'Beasiswa Disetujui', desc:'PUSKAKA menyetujui pengajuan Ahmad Fauzi (BPA)', ip:'192.168.1.25', role:'PUSKAKA', time:'32 menit lalu', unread:false },
        { icon:'fa-file-circle-check', icolor:'rgba(245,158,11,.2)', ictxt:'#F59E0B', title:'Dokumen Diverifikasi', desc:'Kaprodi FK memverifikasi dokumen Siti Nurhaliza', ip:'192.168.1.30', role:'Kaprodi', time:'1 jam lalu', unread:false },
        { icon:'fa-circle-xmark', icolor:'rgba(239,68,68,.2)', ictxt:'#EF4444', title:'Pengajuan Ditolak', desc:'Wadek FK menolak pengajuan Budi Santoso – dokumen tidak lengkap', ip:'192.168.1.40', role:'Wadek', time:'2 jam lalu', unread:false },
        { icon:'fa-right-to-bracket', icolor:'rgba(30,64,175,.2)', ictxt:'#60A5FA', title:'Login Berhasil', desc:'PUSKAKA masuk ke sistem', ip:'192.168.1.25', role:'PUSKAKA', time:'3 jam lalu', unread:false },
        { icon:'fa-pen-to-square', icolor:'rgba(139,92,246,.2)', ictxt:'#A78BFA', title:'Data Diubah', desc:'PUSKAKA memperbarui kuota program Beasiswa Hafidz', ip:'192.168.1.25', role:'PUSKAKA', time:'4 jam lalu', unread:false },
        { icon:'fa-triangle-exclamation', icolor:'rgba(239,68,68,.2)', ictxt:'#EF4444', title:'Login Gagal', desc:'3x percobaan login gagal dari IP 10.0.0.99', ip:'10.0.0.99', role:'Unknown', time:'5 jam lalu', unread:false },
    ];

    function renderAudit() {
        document.getElementById('auditList').innerHTML = auditData.map(a => `
            <div class="audit-item">
                <div class="audit-icon" style="background:${a.icolor};color:${a.ictxt};">
                    <i class="fa-solid ${a.icon}"></i>
                </div>
                <div class="audit-body">
                    <div class="a-title">${a.title}</div>
                    <div class="a-desc">${a.desc}</div>
                    <div class="a-meta">
                        <span><i class="fa-solid fa-network-wired"></i>${a.ip}</span>
                        <span><i class="fa-solid fa-user-tag"></i>${a.role}</span>
                    </div>
                </div>
                <div class="audit-time">${a.time}</div>
                ${a.unread ? '<div class="audit-unread"></div>' : ''}
            </div>
        `).join('');
    }

    /* ─── CHARTS ─── */
    Chart.defaults.color = '#8892A4';
    Chart.defaults.borderColor = 'rgba(255,255,255,0.06)';

    const chartInstances = {};

    function destroyChart(id) { if (chartInstances[id]) { chartInstances[id].destroy(); delete chartInstances[id]; } }

    function initOverviewCharts() {
        // Tren Dana
        destroyChart('chartTrenDana');
        chartInstances['chartTrenDana'] = new Chart(document.getElementById('chartTrenDana'), {
            type: 'line',
            data: {
                labels: ['Nov','Des','Jan','Feb','Mar','Apr'],
                datasets: [{
                    label: 'Dana (Miliar Rp)',
                    data: [1.8, 2.1, 1.9, 2.4, 2.8, 3.2],
                    borderColor: '#60A5FA',
                    backgroundColor: 'rgba(96,165,250,0.12)',
                    fill: true, tension: 0.45, pointBackgroundColor: '#60A5FA', pointRadius: 4,
                }]
            },
            options: { responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}}, scales:{ x:{grid:{color:'rgba(255,255,255,.04)'}}, y:{grid:{color:'rgba(255,255,255,.04)'},ticks:{callback:v=>'Rp '+v+'M'}} } }
        });

        // Penerima per Fakultas
        destroyChart('chartFakultas');
        chartInstances['chartFakultas'] = new Chart(document.getElementById('chartFakultas'), {
            type: 'bar',
            data: {
                labels: ['FK','FKG','FH','FEB','FT','FISIP','FPsi','FKM'],
                datasets: [{
                    label: 'Penerima',
                    data: [285, 178, 143, 167, 134, 112, 98, 130],
                    backgroundColor: ['#1E40AF','#3B82F6','#10B981','#F59E0B','#8B5CF6','#EF4444','#06B6D4','#F97316'],
                    borderRadius: 6,
                }]
            },
            options: { responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}}, scales:{ x:{grid:{display:false}}, y:{grid:{color:'rgba(255,255,255,.04)'}} } }
        });

        // Donut Status
        destroyChart('chartDonutStatus');
        chartInstances['chartDonutStatus'] = new Chart(document.getElementById('chartDonutStatus'), {
            type: 'doughnut',
            data: {
                labels: ['Aktif','Menunggu','Ditolak'],
                datasets: [{ data:[1247,88,7], backgroundColor:['#60A5FA','#F59E0B','#EF4444'], borderWidth:0, hoverOffset:6 }]
            },
            options: { responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}}, cutout:'72%' }
        });
    }

    function initStatistikCharts() {
        destroyChart('chartDanaFakultas');
        chartInstances['chartDanaFakultas'] = new Chart(document.getElementById('chartDanaFakultas'), {
            type: 'bar',
            data: {
                labels: ['FK','FKG','FH','FEB','FT','FISIP','FPsi','FKM'],
                datasets: [{
                    label: 'Dana (Juta Rp)',
                    data: [3200, 2400, 1500, 1800, 1200, 1050, 980, 1270],
                    backgroundColor: 'rgba(30,64,175,0.7)',
                    borderColor: '#60A5FA', borderWidth:1, borderRadius:6,
                },{
                    label: 'Target (Juta Rp)',
                    data: [3500, 2600, 1700, 2000, 1400, 1200, 1100, 1500],
                    backgroundColor: 'rgba(96,165,250,0.15)',
                    borderColor: 'rgba(96,165,250,0.4)', borderWidth:1, borderRadius:6,
                }]
            },
            options: { responsive:true, maintainAspectRatio:false, plugins:{legend:{labels:{color:'#8892A4'}}}, scales:{ x:{grid:{display:false}}, y:{grid:{color:'rgba(255,255,255,.04)'},ticks:{callback:v=>'Rp '+v/1000+'M'}} } }
        });

        destroyChart('chartJenisBeasiswa');
        chartInstances['chartJenisBeasiswa'] = new Chart(document.getElementById('chartJenisBeasiswa'), {
            type: 'doughnut',
            data: {
                labels: ['Full Funded','Partial Funded','One Shot'],
                datasets: [{ data:[834,319,94], backgroundColor:['#1E40AF','#F59E0B','#8B5CF6'], borderWidth:0, hoverOffset:8 }]
            },
            options: { responsive:true, maintainAspectRatio:false, plugins:{legend:{position:'right',labels:{color:'#8892A4',padding:16}}}, cutout:'66%' }
        });

        destroyChart('chartTrenSemester');
        chartInstances['chartTrenSemester'] = new Chart(document.getElementById('chartTrenSemester'), {
            type: 'line',
            data: {
                labels: ['Gnp 22','Gnj 22','Gnp 23','Gnj 23','Gnp 24','Gnj 24','Gnp 25'],
                datasets: [{
                    label: 'Full Funded', data:[680,710,760,798,820,905,834],
                    borderColor:'#60A5FA', backgroundColor:'rgba(96,165,250,0.1)', fill:true, tension:0.4, pointRadius:3,
                },{
                    label: 'Partial Funded', data:[210,225,248,270,285,300,319],
                    borderColor:'#F59E0B', backgroundColor:'rgba(245,158,11,0.08)', fill:true, tension:0.4, pointRadius:3,
                },{
                    label: 'One Shot', data:[45,52,60,68,78,85,94],
                    borderColor:'#8B5CF6', backgroundColor:'rgba(139,92,246,0.08)', fill:true, tension:0.4, pointRadius:3,
                }]
            },
            options: { responsive:true, maintainAspectRatio:false, plugins:{legend:{labels:{color:'#8892A4'}}}, scales:{ x:{grid:{color:'rgba(255,255,255,.04)'}}, y:{grid:{color:'rgba(255,255,255,.04)'}} } }
        });

        destroyChart('chartSumberDana');
        chartInstances['chartSumberDana'] = new Chart(document.getElementById('chartSumberDana'), {
            type: 'pie',
            data: {
                labels: ['YARSI Internal','Kemendikbud','CSR/Mitra','Beasiswa Hafidz','Beasiswa Yatim'],
                datasets: [{ data:[42,28,16,8,6], backgroundColor:['#1E40AF','#10B981','#F59E0B','#8B5CF6','#EF4444'], borderWidth:0, hoverOffset:6 }]
            },
            options: { responsive:true, maintainAspectRatio:false, plugins:{legend:{position:'right',labels:{color:'#8892A4',padding:12,font:{size:11}}}} }
        });
    }

    /* ─── DOWNLOAD TOAST ─── */
    function simulateDownload(name) {
        const toast = document.getElementById('toast');
        document.getElementById('toastMsg').textContent = `"${name}" berhasil diunduh!`;
        toast.style.display = 'flex';
        setTimeout(() => { toast.style.display = 'none'; }, 3500);
        // add to history
        const tbody = document.getElementById('downloadHistory');
        const now2 = new Date();
        const fmt = `${now2.getDate()} ${months[now2.getMonth()]} ${now2.getFullYear()}, ${now2.getHours().toString().padStart(2,'0')}:${now2.getMinutes().toString().padStart(2,'0')}`;
        const isExcel = name.includes('Excel');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `<td>${name.replace(/^(Excel|PDF) - /,'')}</td><td><span class="pill ${isExcel?'pill-green':'pill-red'}">${isExcel?'Excel':'PDF'}</span></td><td>Wakil Rektor</td><td>${fmt}</td><td>${(Math.random()*3+0.5).toFixed(1)} MB</td>`;
        tbody.prepend(newRow);
    }

    /* ─── INIT ─── */
    renderTable();
    renderAudit();
    initOverviewCharts();
    </script>
</body>
</html>
