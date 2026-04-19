<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dashboard PUSKAKA – Pusat Karir & Kesejahteraan Mahasiswa YARSI">
    <title>Dashboard PUSKAKA | YARSI Scholarship</title>
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
            --primary:       #6C3CE1;
            --primary-dark:  #5128BF;
            --primary-glow:  rgba(108,60,225,0.25);
            --accent:        #F59E0B;
            --accent2:       #10B981;
            --danger:        #EF4444;
            --info:          #3B82F6;
            --sidebar-w:     270px;
            --header-h:      68px;
            --bg:            #0F0F1A;
            --bg2:           #16162A;
            --bg3:           #1E1E35;
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
            position:fixed; top:0; left:0; width:var(--sidebar-w); height:100vh;
            background:var(--bg2); border-right:1px solid var(--border);
            display:flex; flex-direction:column; z-index:100;
            transition:transform var(--transition);
        }
        .sidebar-logo { display:flex; align-items:center; gap:12px; padding:22px 20px; border-bottom:1px solid var(--border); }
        .sidebar-logo .logo-icon {
            width:44px; height:44px;
            background:linear-gradient(135deg,var(--primary),#9F67FF);
            border-radius:12px; display:grid; place-items:center; font-size:20px; flex-shrink:0;
            box-shadow:0 0 20px var(--primary-glow);
        }
        .sidebar-logo .name { font-size:15px; font-weight:700; display:block; }
        .sidebar-logo .sub  { font-size:11px; color:var(--text-muted); display:block; }

        .sidebar-nav { flex:1; padding:14px 12px; overflow-y:auto; }
        .nav-label { font-size:10px; font-weight:600; letter-spacing:.1em; color:var(--text-muted); text-transform:uppercase; padding:10px 10px 6px; }
        .nav-item {
            display:flex; align-items:center; gap:12px; padding:11px 14px; border-radius:10px;
            cursor:pointer; font-size:14px; font-weight:500; color:var(--text-muted);
            transition:background var(--transition),color var(--transition),transform var(--transition);
            text-decoration:none; margin-bottom:2px; border:none; background:none;
            width:100%; font-family:inherit;
        }
        .nav-item i { width:18px; text-align:center; font-size:15px; }
        .nav-item:hover { background:rgba(108,60,225,.12); color:var(--text); transform:translateX(3px); }
        .nav-item.active { background:linear-gradient(90deg,rgba(108,60,225,.25),rgba(108,60,225,.08)); color:#fff; border-left:3px solid var(--primary); }
        .nav-item.active i { color:var(--primary); }
        .nav-badge { margin-left:auto; background:var(--danger); color:#fff; font-size:10px; font-weight:700; padding:2px 7px; border-radius:99px; }

        .sidebar-footer { padding:14px 12px; border-top:1px solid var(--border); }
        .logout-btn {
            display:flex; align-items:center; gap:10px; width:100%; padding:11px 14px;
            border-radius:10px; border:none; background:rgba(239,68,68,.1); color:#EF4444;
            font-size:14px; font-weight:600; cursor:pointer; transition:background var(--transition),transform var(--transition); font-family:inherit;
        }
        .logout-btn:hover { background:rgba(239,68,68,.2); transform:translateX(3px); }

        /* ─── MAIN ─── */
        .main { margin-left:var(--sidebar-w); min-height:100vh; display:flex; flex-direction:column; }

        .topbar {
            position:sticky; top:0; height:var(--header-h); background:rgba(15,15,26,.88);
            backdrop-filter:blur(14px); border-bottom:1px solid var(--border);
            display:flex; align-items:center; padding:0 28px; gap:14px; z-index:90;
        }
        .hamburger { display:none; background:none; border:none; color:var(--text); font-size:20px; cursor:pointer; padding:6px; border-radius:8px; }
        .hamburger:hover { background:var(--bg3); }
        .topbar-title { font-size:18px; font-weight:700; flex:1; }
        .topbar-title span { color:var(--primary); }

        .topbar-actions { display:flex; align-items:center; gap:10px; }
        .icon-btn { position:relative; width:40px; height:40px; background:var(--bg3); border:1px solid var(--border); border-radius:10px; display:grid; place-items:center; cursor:pointer; color:var(--text-muted); font-size:15px; transition:all var(--transition); }
        .icon-btn:hover { border-color:var(--primary); color:var(--primary); background:var(--primary-glow); }
        .icon-btn .dot { position:absolute; top:7px; right:7px; width:8px; height:8px; background:var(--danger); border-radius:50%; border:2px solid var(--bg); }

        .profile-wrap { position:relative; }
        .profile-btn { display:flex; align-items:center; gap:10px; background:var(--bg3); border:1px solid var(--border); border-radius:12px; padding:6px 12px 6px 6px; cursor:pointer; transition:border-color var(--transition); }
        .profile-btn:hover { border-color:var(--primary); }
        .avatar { width:34px; height:34px; background:linear-gradient(135deg,var(--primary),#9F67FF); border-radius:50%; display:grid; place-items:center; font-size:14px; font-weight:700; flex-shrink:0; }
        .profile-info .pname { font-size:13px; font-weight:600; max-width:120px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
        .profile-info .prole { font-size:11px; color:var(--primary); font-weight:500; }
        .profile-btn .chevron { color:var(--text-muted); font-size:12px; transition:transform var(--transition); }
        .profile-btn.open .chevron { transform:rotate(180deg); }

        .profile-dropdown { position:absolute; top:calc(100% + 10px); right:0; width:220px; background:var(--bg3); border:1px solid var(--border); border-radius:var(--radius); box-shadow:var(--shadow); overflow:hidden; opacity:0; pointer-events:none; transform:translateY(-6px); transition:opacity var(--transition),transform var(--transition); z-index:200; }
        .profile-dropdown.open { opacity:1; pointer-events:all; transform:translateY(0); }
        .dropdown-head { padding:16px; border-bottom:1px solid var(--border); display:flex; gap:10px; align-items:center; }
        .dropdown-head .dn { font-size:13px; font-weight:600; }
        .dropdown-head .de { font-size:11px; color:var(--text-muted); }
        .dropdown-item { display:flex; align-items:center; gap:10px; padding:11px 16px; font-size:13px; color:var(--text-muted); cursor:pointer; transition:background var(--transition),color var(--transition); border:none; background:none; width:100%; text-align:left; font-family:inherit; text-decoration:none; }
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
        .greeting h1 span { color:var(--primary); }
        .greeting p { font-size:14px; color:var(--text-muted); margin-top:4px; }
        .date-badge { display:inline-flex; align-items:center; gap:6px; background:var(--bg3); border:1px solid var(--border); border-radius:99px; padding:5px 14px; font-size:12px; color:var(--text-muted); margin-top:10px; }

        /* Stat Cards */
        .stats-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:18px; margin-bottom:28px; }
        .stat-card { background:var(--bg2); border:1px solid var(--border); border-radius:var(--radius); padding:22px 20px; position:relative; overflow:hidden; cursor:default; transition:transform var(--transition),border-color var(--transition),box-shadow var(--transition); }
        .stat-card:hover { transform:translateY(-4px); box-shadow:var(--shadow); border-color:var(--primary); }
        .stat-card .glow { position:absolute; top:-30px; right:-30px; width:100px; height:100px; border-radius:50%; opacity:.12; filter:blur(30px); }
        .stat-card.c1 .glow { background:var(--primary); }
        .stat-card.c2 .glow { background:var(--accent); }
        .stat-card.c3 .glow { background:var(--accent2); }
        .stat-card.c4 .glow { background:var(--info); }
        .stat-icon { width:44px; height:44px; border-radius:12px; display:grid; place-items:center; font-size:18px; margin-bottom:14px; }
        .stat-card.c1 .stat-icon { background:rgba(108,60,225,.15); color:var(--primary); }
        .stat-card.c2 .stat-icon { background:rgba(245,158,11,.15); color:var(--accent); }
        .stat-card.c3 .stat-icon { background:rgba(16,185,129,.15); color:var(--accent2); }
        .stat-card.c4 .stat-icon { background:rgba(59,130,246,.15); color:var(--info); }
        .stat-label { font-size:12px; color:var(--text-muted); font-weight:500; text-transform:uppercase; letter-spacing:.05em; }
        .stat-value { font-size:30px; font-weight:800; margin:4px 0 6px; line-height:1; }
        .stat-trend { font-size:12px; display:inline-flex; align-items:center; gap:4px; padding:3px 8px; border-radius:99px; font-weight:600; }
        .trend-up   { background:rgba(16,185,129,.12); color:var(--accent2); }
        .trend-flat { background:rgba(255,255,255,.06); color:var(--text-muted); }

        /* Cards */
        .card { background:var(--bg2); border:1px solid var(--border); border-radius:var(--radius); overflow:hidden; }
        .card-header { display:flex; align-items:center; justify-content:space-between; padding:18px 22px; border-bottom:1px solid var(--border); }
        .card-header h3 { font-size:15px; font-weight:700; }
        .card-header .see-all { font-size:12px; color:var(--primary); cursor:pointer; text-decoration:none; }
        .card-header .see-all:hover { text-decoration:underline; }
        .card-body { padding:22px; }

        /* Grid */
        .grid-2 { display:grid; grid-template-columns:1fr 360px; gap:20px; margin-bottom:24px; }
        .grid-equal { display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:24px; }
        .grid-cols { display:flex; flex-direction:column; gap:20px; }

        /* Table */
        .table-wrap { overflow-x:auto; }
        table { width:100%; border-collapse:collapse; }
        thead th { padding:10px 14px; font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:.06em; color:var(--text-muted); background:var(--bg3); text-align:left; white-space:nowrap; }
        tbody td { padding:12px 14px; font-size:13px; border-bottom:1px solid var(--border); vertical-align:middle; }
        tbody tr:last-child td { border-bottom:none; }
        tbody tr:hover td { background:rgba(255,255,255,.02); }

        /* Toolbar */
        .toolbar { display:flex; align-items:center; gap:12px; padding:16px 22px; border-bottom:1px solid var(--border); flex-wrap:wrap; }
        .search-input { display:flex; align-items:center; gap:8px; background:var(--bg3); border:1px solid var(--border); border-radius:10px; padding:8px 14px; flex:1; min-width:220px; }
        .search-input input { background:none; border:none; outline:none; color:var(--text); font-family:inherit; font-size:13px; width:100%; }
        .search-input input::placeholder { color:var(--text-muted); }
        .search-input i { color:var(--text-muted); font-size:13px; }
        select.filter-sel { background:var(--bg3); border:1px solid var(--border); border-radius:10px; color:var(--text); padding:8px 14px; font-size:13px; font-family:inherit; outline:none; cursor:pointer; }
        select.filter-sel option { background:var(--bg3); }

        /* Pills */
        .pill { display:inline-block; font-size:10px; font-weight:700; padding:3px 9px; border-radius:99px; }
        .pill-blue   { background:rgba(59,130,246,.15); color:var(--info); }
        .pill-green  { background:rgba(16,185,129,.15); color:var(--accent2); }
        .pill-amber  { background:rgba(245,158,11,.15); color:var(--accent); }
        .pill-red    { background:rgba(239,68,68,.15); color:var(--danger); }
        .pill-purple { background:rgba(108,60,225,.15); color:var(--primary); }

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
        .btn-ghost:hover { border-color:var(--primary); color:var(--primary); }
        .btn-sm { padding:5px 12px; font-size:12px; border-radius:8px; }

        /* Progress bar */
        .prog-bar-wrap { display:flex; align-items:center; gap:8px; }
        .prog-bar-bg { flex:1; height:6px; background:var(--bg3); border-radius:99px; overflow:hidden; }
        .prog-bar-fill { height:100%; border-radius:99px; transition:width 1s ease; }
        .bar-purple { background:var(--primary); }
        .bar-amber  { background:var(--accent); }
        .bar-green  { background:var(--accent2); }
        .bar-blue   { background:var(--info); }

        /* Activity */
        .activity-list { display:flex; flex-direction:column; gap:12px; }
        .activity-item { display:flex; align-items:flex-start; gap:12px; padding:12px 14px; border-radius:10px; background:var(--bg3); transition:background var(--transition); }
        .activity-item:hover { background:rgba(108,60,225,.08); }
        .activity-avatar { width:36px; height:36px; border-radius:50%; display:grid; place-items:center; font-size:13px; font-weight:700; flex-shrink:0; }
        .activity-body { flex:1; }
        .activity-body .aname { font-size:13px; font-weight:600; }
        .activity-body .adesc { font-size:12px; color:var(--text-muted); margin-top:2px; }
        .activity-time { font-size:11px; color:var(--text-muted); white-space:nowrap; }

        /* Export */
        .export-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:18px; margin-bottom:24px; }
        .export-card { background:var(--bg2); border:1px solid var(--border); border-radius:var(--radius); padding:24px; display:flex; flex-direction:column; gap:14px; transition:transform var(--transition),border-color var(--transition); }
        .export-card:hover { transform:translateY(-3px); border-color:var(--primary); }
        .export-icon { width:52px; height:52px; border-radius:14px; display:grid; place-items:center; font-size:22px; }
        .export-title { font-size:16px; font-weight:700; }
        .export-desc { font-size:13px; color:var(--text-muted); line-height:1.6; }
        .export-actions { display:flex; gap:10px; margin-top:4px; }

        /* Audit */
        .audit-list { display:flex; flex-direction:column; }
        .audit-item { display:flex; align-items:flex-start; gap:14px; padding:14px 22px; border-bottom:1px solid var(--border); transition:background var(--transition); }
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

        /* Donut */
        .donut-wrap { display:flex; flex-direction:column; align-items:center; gap:16px; }

        /* Quick stats */
        .quick-row { display:flex; gap:12px; flex-wrap:wrap; margin-bottom:20px; }
        .quick-stat { background:var(--bg2); border:1px solid var(--border); border-radius:10px; padding:12px 18px; flex:1; min-width:140px; }
        .quick-stat .qs-label { font-size:11px; color:var(--text-muted); text-transform:uppercase; letter-spacing:.05em; }
        .quick-stat .qs-val   { font-size:22px; font-weight:800; margin-top:4px; }
        .quick-stat .qs-sub   { font-size:11px; color:var(--text-muted); }

        /* Section heading */
        .section-heading { margin-bottom:22px; }
        .section-heading h2 { font-size:20px; font-weight:800; }
        .section-heading p { font-size:13px; color:var(--text-muted); margin-top:4px; }

        /* Pagination */
        .pagination { display:flex; align-items:center; gap:6px; padding:16px 22px; border-top:1px solid var(--border); }
        .pag-btn { width:32px; height:32px; border-radius:8px; border:1px solid var(--border); background:none; color:var(--text-muted); cursor:pointer; display:grid; place-items:center; font-size:13px; }
        .pag-btn.active { background:var(--primary); border-color:var(--primary); color:#fff; }
        .pag-btn:hover:not(.active) { border-color:var(--primary); color:var(--primary); }

        /* Notif list */
        .notif-list { display:flex; flex-direction:column; }
        .notif-item { display:flex; align-items:flex-start; gap:12px; padding:13px 22px; border-bottom:1px solid var(--border); cursor:default; transition:background var(--transition); }
        .notif-item:last-child { border-bottom:none; }
        .notif-item:hover { background:rgba(255,255,255,.02); }
        .notif-item.unread { background:rgba(108,60,225,.05); }
        .notif-icon { width:34px; height:34px; border-radius:10px; display:grid; place-items:center; font-size:14px; flex-shrink:0; }
        .notif-body .ntitle { font-size:13px; font-weight:600; }
        .notif-body .ndesc  { font-size:12px; color:var(--text-muted); margin-top:2px; }
        .notif-body .ntime  { font-size:11px; color:var(--text-muted); margin-top:3px; }
        .unread-dot { width:8px; height:8px; border-radius:50%; background:var(--primary); margin-top:5px; flex-shrink:0; }

        /* Quick actions */
        .quick-grid { display:grid; grid-template-columns:1fr 1fr; gap:10px; padding:18px; }
        .quick-btn { display:flex; flex-direction:column; align-items:center; gap:8px; padding:16px 10px; border-radius:12px; background:var(--bg3); border:1px solid var(--border); cursor:pointer; transition:all var(--transition); font-family:inherit; color:var(--text); }
        .quick-btn:hover { border-color:var(--primary); background:rgba(108,60,225,.08); transform:translateY(-2px); }
        .quick-btn i { font-size:20px; color:var(--primary); }
        .quick-btn span { font-size:12px; font-weight:600; text-align:center; }

        /* Chart */
        .chart-container { position:relative; }

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
            <div class="logo-icon">🎓</div>
            <div>
                <span class="name">YARSI Beasiswa</span>
                <span class="sub">PUSKAKA Panel</span>
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
                <span class="nav-badge" style="background:var(--primary);">Live</span>
            </button>

            <div class="nav-label" style="margin-top:10px;">Laporan & Operasional</div>

            <button class="nav-item" id="nav-program" onclick="showSection('program', this)">
                <i class="fa-solid fa-graduation-cap"></i> Program Beasiswa
            </button>
            <button class="nav-item" id="nav-pengajuan" onclick="showSection('pengajuan', this)">
                <i class="fa-solid fa-file-circle-check"></i> Pengajuan Masuk
                <span class="nav-badge">8</span>
            </button>
            <button class="nav-item" id="nav-laporan" onclick="showSection('laporan', this)">
                <i class="fa-solid fa-file-export"></i> Ekspor Laporan
            </button>
            <button class="nav-item" id="nav-audit" onclick="showSection('audit', this)">
                <i class="fa-solid fa-shield-halved"></i> Audit Activity Log
            </button>

            <div class="nav-label" style="margin-top:10px;">Akun</div>

            <button class="nav-item">
                <i class="fa-solid fa-bell"></i> Notifikasi
                <span class="nav-badge" style="background:var(--accent);">3</span>
            </button>
            <button class="nav-item">
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
                Dashboard <span>PUSKAKA</span>
            </div>
            <div class="topbar-actions">
                <div class="icon-btn" title="Notifikasi">
                    <i class="fa-solid fa-bell"></i>
                    <span class="dot"></span>
                </div>
                <div class="profile-wrap">
                    <div class="profile-btn" id="profileBtn" onclick="toggleDropdown()">
                        <div class="avatar" id="avatarInitial">P</div>
                        <div class="profile-info">
                            <div class="pname" id="profileName">{{ $user->nama ?? 'PUSKAKA' }}</div>
                            <div class="prole">Pusat Karir & Kesejahteraan</div>
                        </div>
                        <i class="fa-solid fa-chevron-down chevron"></i>
                    </div>
                    <div class="profile-dropdown" id="profileDropdown">
                        <div class="dropdown-head">
                            <div class="avatar" style="width:40px;height:40px;font-size:16px;">
                                {{ strtoupper(substr($user->nama ?? 'P', 0, 1)) }}
                            </div>
                            <div>
                                <div class="dn">{{ $user->nama ?? 'PUSKAKA' }}</div>
                                <div class="de">{{ $user->email ?? 'puskaka@yarsi.ac.id' }}</div>
                            </div>
                        </div>
                        <a href="#" class="dropdown-item"><i class="fa-solid fa-user fa-fw"></i> Profil Saya</a>
                        <a href="#" class="dropdown-item"><i class="fa-solid fa-gear fa-fw"></i> Pengaturan</a>
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
                    <h1>Selamat Datang, <span id="greetName">{{ explode(' ', $user->nama ?? 'PUSKAKA')[0] }}</span> 👋</h1>
                    <p>Berikut ringkasan aktivitas beasiswa hari ini.</p>
                    <div class="date-badge">
                        <i class="fa-regular fa-calendar"></i>
                        <span id="dateStr"></span>
                    </div>
                </div>

                <div class="stats-grid">
                    <div class="stat-card c1">
                        <div class="glow"></div>
                        <div class="stat-icon"><i class="fa-solid fa-file-circle-check"></i></div>
                        <div class="stat-label">Total Pengajuan</div>
                        <div class="stat-value" data-count="128">0</div>
                        <span class="stat-trend trend-up"><i class="fa-solid fa-arrow-trend-up"></i> +12% bulan ini</span>
                    </div>
                    <div class="stat-card c2">
                        <div class="glow"></div>
                        <div class="stat-icon"><i class="fa-solid fa-hourglass-half"></i></div>
                        <div class="stat-label">Menunggu Review</div>
                        <div class="stat-value" data-count="8">0</div>
                        <span class="stat-trend trend-flat"><i class="fa-solid fa-minus"></i> Perlu segera</span>
                    </div>
                    <div class="stat-card c3">
                        <div class="glow"></div>
                        <div class="stat-icon"><i class="fa-solid fa-circle-check"></i></div>
                        <div class="stat-label">Disetujui</div>
                        <div class="stat-value" data-count="95">0</div>
                        <span class="stat-trend trend-up"><i class="fa-solid fa-arrow-trend-up"></i> +8 minggu ini</span>
                    </div>
                    <div class="stat-card c4">
                        <div class="glow"></div>
                        <div class="stat-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                        <div class="stat-label">Penerima Aktif</div>
                        <div class="stat-value" data-count="312">0</div>
                        <span class="stat-trend trend-up"><i class="fa-solid fa-arrow-trend-up"></i> Semester ganjil</span>
                    </div>
                </div>

                <div class="grid-2">
                    <!-- LEFT -->
                    <div class="grid-cols">
                        <!-- Activity -->
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fa-solid fa-clock-rotate-left" style="color:var(--primary);margin-right:8px;"></i>Aktivitas Terbaru</h3>
                                <a href="#" class="see-all" onclick="showSection('pengajuan',document.getElementById('nav-pengajuan'))">Lihat Semua →</a>
                            </div>
                            <div class="card-body">
                                <div class="activity-list">
                                    <div class="activity-item">
                                        <div class="activity-avatar" style="background:rgba(108,60,225,.2);color:var(--primary);">AF</div>
                                        <div class="activity-body">
                                            <div class="aname">Ahmad Fauzi</div>
                                            <div class="adesc">Mengajukan Beasiswa Prestasi Akademik (BPA)</div>
                                            <span class="pill pill-amber" style="margin-top:4px;">Menunggu Review</span>
                                        </div>
                                        <div class="activity-time">2 menit lalu</div>
                                    </div>
                                    <div class="activity-item">
                                        <div class="activity-avatar" style="background:rgba(16,185,129,.2);color:var(--accent2);">SN</div>
                                        <div class="activity-body">
                                            <div class="aname">Siti Nurhaliza</div>
                                            <div class="adesc">Dokumen diverifikasi oleh Kaprodi KG</div>
                                            <span class="pill pill-green" style="margin-top:4px;">Diverifikasi</span>
                                        </div>
                                        <div class="activity-time">25 menit lalu</div>
                                    </div>
                                    <div class="activity-item">
                                        <div class="activity-avatar" style="background:rgba(245,158,11,.2);color:var(--accent);">BS</div>
                                        <div class="activity-body">
                                            <div class="aname">Budi Santoso</div>
                                            <div class="adesc">Pengajuan Beasiswa Ekonomi dikembalikan</div>
                                            <span class="pill pill-red" style="margin-top:4px;">Dokumen Tidak Lengkap</span>
                                        </div>
                                        <div class="activity-time">1 jam lalu</div>
                                    </div>
                                    <div class="activity-item">
                                        <div class="activity-avatar" style="background:rgba(59,130,246,.2);color:var(--info);">RP</div>
                                        <div class="activity-body">
                                            <div class="aname">Rizky Pratama</div>
                                            <div class="adesc">Beasiswa Prestasi disetujui oleh Warek</div>
                                            <span class="pill pill-green" style="margin-top:4px;">Disetujui</span>
                                        </div>
                                        <div class="activity-time">4 jam lalu</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Program Table -->
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fa-solid fa-table-list" style="color:var(--primary);margin-right:8px;"></i>Status Program Beasiswa</h3>
                                <a href="#" class="see-all" onclick="showSection('program',document.getElementById('nav-program'))">Kelola →</a>
                            </div>
                            <div class="table-wrap">
                                <table>
                                    <thead>
                                        <tr><th>Program</th><th>Kuota</th><th>Terisi</th><th>Aksi</th></tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><div style="font-weight:600;">Beasiswa Prestasi Akademik</div><div style="font-size:11px;color:var(--text-muted);">Full Funded • Sem. Genap 2025</div></td>
                                            <td>50</td>
                                            <td><div class="prog-bar-wrap"><div class="prog-bar-bg"><div class="prog-bar-fill bar-purple" style="width:84%"></div></div><span style="font-size:11px;font-weight:700;width:32px;text-align:right;color:var(--primary);">84%</span></div></td>
                                            <td><button class="btn btn-primary btn-sm" onclick="showSection('program',document.getElementById('nav-program'))">Detail</button></td>
                                        </tr>
                                        <tr>
                                            <td><div style="font-weight:600;">Beasiswa Kurang Mampu</div><div style="font-size:11px;color:var(--text-muted);">Partial Funded • Sem. Genap 2025</div></td>
                                            <td>30</td>
                                            <td><div class="prog-bar-wrap"><div class="prog-bar-bg"><div class="prog-bar-fill bar-amber" style="width:60%"></div></div><span style="font-size:11px;font-weight:700;width:32px;text-align:right;color:var(--accent);">60%</span></div></td>
                                            <td><button class="btn btn-primary btn-sm" onclick="showSection('program',document.getElementById('nav-program'))">Detail</button></td>
                                        </tr>
                                        <tr>
                                            <td><div style="font-weight:600;">Beasiswa Hafidz Al-Qur'an</div><div style="font-size:11px;color:var(--text-muted);">One Shot • Sem. Genap 2025</div></td>
                                            <td>20</td>
                                            <td><div class="prog-bar-wrap"><div class="prog-bar-bg"><div class="prog-bar-fill bar-green" style="width:95%"></div></div><span style="font-size:11px;font-weight:700;width:32px;text-align:right;color:var(--accent2);">95%</span></div></td>
                                            <td><button class="btn btn-ghost btn-sm">Tutup</button></td>
                                        </tr>
                                        <tr>
                                            <td><div style="font-weight:600;">Beasiswa Yatim Piatu</div><div style="font-size:11px;color:var(--text-muted);">Full Funded • Sem. Genap 2025</div></td>
                                            <td>15</td>
                                            <td><div class="prog-bar-wrap"><div class="prog-bar-bg"><div class="prog-bar-fill bar-blue" style="width:40%"></div></div><span style="font-size:11px;font-weight:700;width:32px;text-align:right;color:var(--info);">40%</span></div></td>
                                            <td><button class="btn btn-primary btn-sm" onclick="showSection('program',document.getElementById('nav-program'))">Detail</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT -->
                    <div class="grid-cols">
                        <!-- Donut Chart -->
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fa-solid fa-chart-pie" style="color:var(--primary);margin-right:8px;"></i>Distribusi Status</h3>
                            </div>
                            <div class="card-body donut-wrap">
                                <div class="chart-container" style="width:160px;height:160px;">
                                    <canvas id="chartDonut"></canvas>
                                </div>
                                <div style="width:100%;display:flex;flex-direction:column;gap:8px;">
                                    <div style="display:flex;justify-content:space-between;font-size:13px;">
                                        <span style="display:flex;align-items:center;gap:8px;color:var(--text-muted);"><span style="width:10px;height:10px;border-radius:50%;background:var(--primary);display:inline-block;"></span>Disetujui</span>
                                        <strong>95 <span style="color:var(--text-muted);font-weight:400;">(74%)</span></strong>
                                    </div>
                                    <div style="display:flex;justify-content:space-between;font-size:13px;">
                                        <span style="display:flex;align-items:center;gap:8px;color:var(--text-muted);"><span style="width:10px;height:10px;border-radius:50%;background:var(--accent);display:inline-block;"></span>Menunggu</span>
                                        <strong>8 <span style="color:var(--text-muted);font-weight:400;">(6%)</span></strong>
                                    </div>
                                    <div style="display:flex;justify-content:space-between;font-size:13px;">
                                        <span style="display:flex;align-items:center;gap:8px;color:var(--text-muted);"><span style="width:10px;height:10px;border-radius:50%;background:var(--danger);display:inline-block;"></span>Ditolak</span>
                                        <strong>25 <span style="color:var(--text-muted);font-weight:400;">(20%)</span></strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Aksi Cepat -->
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fa-solid fa-bolt" style="color:var(--accent);margin-right:8px;"></i>Aksi Cepat</h3>
                            </div>
                            <div class="quick-grid">
                                <button class="quick-btn" onclick="showSection('program',document.getElementById('nav-program'))">
                                    <i class="fa-solid fa-file-circle-plus"></i><span>Tambah Program</span>
                                </button>
                                <button class="quick-btn" onclick="showSection('laporan',document.getElementById('nav-laporan'))">
                                    <i class="fa-solid fa-file-export"></i><span>Ekspor Laporan</span>
                                </button>
                                <button class="quick-btn" onclick="showSection('monitoring',document.getElementById('nav-monitoring'))">
                                    <i class="fa-solid fa-table-list"></i><span>Monitoring</span>
                                </button>
                                <button class="quick-btn" onclick="showSection('audit',document.getElementById('nav-audit'))">
                                    <i class="fa-solid fa-shield-halved"></i><span>Audit Log</span>
                                </button>
                            </div>
                        </div>

                        <!-- Notifikasi -->
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fa-solid fa-bell" style="color:var(--primary);margin-right:8px;"></i>Notifikasi</h3>
                                <a href="#" class="see-all" style="font-size:11px;">Tandai Dibaca</a>
                            </div>
                            <div class="notif-list">
                                <div class="notif-item unread">
                                    <div class="notif-icon" style="background:rgba(108,60,225,.15);color:var(--primary);"><i class="fa-solid fa-file-circle-check"></i></div>
                                    <div class="notif-body">
                                        <div class="ntitle">8 Pengajuan Menunggu</div>
                                        <div class="ndesc">Perlu persetujuan PUSKAKA segera</div>
                                        <div class="ntime">5 menit lalu</div>
                                    </div>
                                    <div class="unread-dot"></div>
                                </div>
                                <div class="notif-item unread">
                                    <div class="notif-icon" style="background:rgba(245,158,11,.15);color:var(--accent);"><i class="fa-solid fa-triangle-exclamation"></i></div>
                                    <div class="notif-body">
                                        <div class="ntitle">Kuota BPA Hampir Penuh</div>
                                        <div class="ndesc">Beasiswa Prestasi Akademik tersisa 8 slot</div>
                                        <div class="ntime">1 jam lalu</div>
                                    </div>
                                    <div class="unread-dot"></div>
                                </div>
                                <div class="notif-item">
                                    <div class="notif-icon" style="background:rgba(16,185,129,.15);color:var(--accent2);"><i class="fa-solid fa-circle-check"></i></div>
                                    <div class="notif-body">
                                        <div class="ntitle">Laporan Semester Selesai</div>
                                        <div class="ndesc">Laporan Q1 2025 siap diunduh</div>
                                        <div class="ntime">Kemarin, 15:30</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ════════ SECTION: MONITORING TERPADU ════════ -->
            <div class="section" id="section-monitoring">
                <div class="section-heading">
                    <h2><i class="fa-solid fa-table-list" style="color:var(--primary);margin-right:10px;"></i>Monitoring Terpadu</h2>
                    <p>Data seluruh mahasiswa penerima beasiswa se-universitas dalam satu tampilan.</p>
                </div>
                <div class="quick-row">
                    <div class="quick-stat"><div class="qs-label">Total Penerima</div><div class="qs-val" style="color:var(--primary);">1.247</div><div class="qs-sub">Semua Fakultas</div></div>
                    <div class="quick-stat"><div class="qs-label">Full Funded</div><div class="qs-val" style="color:var(--accent2);">834</div><div class="qs-sub">67% dari total</div></div>
                    <div class="quick-stat"><div class="qs-label">Partial Funded</div><div class="qs-val" style="color:var(--accent);">319</div><div class="qs-sub">26% dari total</div></div>
                    <div class="quick-stat"><div class="qs-label">One Shot</div><div class="qs-val" style="color:#A78BFA;">94</div><div class="qs-sub">7% dari total</div></div>
                </div>
                <div class="card">
                    <div class="toolbar">
                        <div class="search-input">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" placeholder="Cari nama, NPM, atau prodi..." id="searchMon" oninput="filterMon()">
                        </div>
                        <select class="filter-sel" id="filterFak" onchange="filterMon()">
                            <option value="">Semua Fakultas</option>
                            <option>FK</option><option>FKG</option><option>FH</option><option>FEB</option>
                            <option>FT</option><option>FISIP</option><option>FPsi</option><option>FKM</option>
                        </select>
                        <select class="filter-sel" id="filterSumber" onchange="filterMon()">
                            <option value="">Semua Sumber Dana</option>
                            <option>YARSI Internal</option><option>Kemendikbud</option>
                            <option>Beasiswa Hafidz</option><option>CSR Bank Syariah</option><option>Beasiswa Yatim</option>
                        </select>
                    </div>
                    <div class="table-wrap">
                        <table id="monTable">
                            <thead><tr><th>#</th><th>Nama Mahasiswa</th><th>NPM</th><th>Program Studi</th><th>Fakultas</th><th>Jenis Beasiswa</th><th>Sumber Dana</th><th>Status</th></tr></thead>
                            <tbody id="monTbody"></tbody>
                        </table>
                    </div>
                    <div class="pagination" id="monPag"></div>
                </div>
            </div>

            <!-- ════════ SECTION: STATISTIK ════════ -->
            <div class="section" id="section-statistik">
                <div class="section-heading">
                    <h2><i class="fa-solid fa-chart-column" style="color:var(--primary);margin-right:10px;"></i>Dashboard Statistik Universitas</h2>
                    <p>Grafik total dana tersalurkan dan sebaran beasiswa antar fakultas.</p>
                </div>
                <div class="stats-grid" style="grid-template-columns:repeat(auto-fit,minmax(180px,1fr));margin-bottom:24px;">
                    <div class="stat-card c1"><div class="glow"></div><div class="stat-icon"><i class="fa-solid fa-coins"></i></div><div class="stat-label">Total Dana Yayasan</div><div class="stat-value" style="font-size:18px;">Rp 8,4 M</div><span class="stat-trend trend-up"><i class="fa-solid fa-arrow-trend-up"></i> +12% YoY</span></div>
                    <div class="stat-card c2"><div class="glow"></div><div class="stat-icon"><i class="fa-solid fa-landmark"></i></div><div class="stat-label">Dana Pemerintah</div><div class="stat-value" style="font-size:18px;">Rp 3,2 M</div><span class="stat-trend trend-up"><i class="fa-solid fa-arrow-trend-up"></i> KIP & Kemendikbud</span></div>
                    <div class="stat-card c3"><div class="glow"></div><div class="stat-icon"><i class="fa-solid fa-handshake"></i></div><div class="stat-label">Dana CSR / Mitra</div><div class="stat-value" style="font-size:18px;">Rp 1,6 M</div><span class="stat-trend trend-flat"><i class="fa-solid fa-minus"></i> Stabil</span></div>
                    <div class="stat-card c4"><div class="glow"></div><div class="stat-icon"><i class="fa-solid fa-piggy-bank"></i></div><div class="stat-label">Total Tersalurkan</div><div class="stat-value" style="font-size:18px;">Rp 13,2 M</div><span class="stat-trend trend-up"><i class="fa-solid fa-arrow-trend-up"></i> Semester Genap</span></div>
                </div>
                <div class="grid-equal">
                    <div class="card">
                        <div class="card-header"><h3><i class="fa-solid fa-chart-bar" style="color:var(--primary);margin-right:8px;"></i>Dana per Fakultas</h3></div>
                        <div class="card-body"><div class="chart-container" style="height:260px;"><canvas id="chartStatDanaFak"></canvas></div></div>
                    </div>
                    <div class="card">
                        <div class="card-header"><h3><i class="fa-solid fa-chart-pie" style="color:var(--primary);margin-right:8px;"></i>Sebaran Jenis Beasiswa</h3></div>
                        <div class="card-body" style="display:flex;justify-content:center;"><div class="chart-container" style="height:240px;width:100%;"><canvas id="chartStatJenis"></canvas></div></div>
                    </div>
                </div>
                <div class="grid-equal">
                    <div class="card">
                        <div class="card-header"><h3><i class="fa-solid fa-chart-line" style="color:var(--primary);margin-right:8px;"></i>Tren Penerima per Semester</h3></div>
                        <div class="card-body"><div class="chart-container" style="height:220px;"><canvas id="chartStatTren"></canvas></div></div>
                    </div>
                    <div class="card">
                        <div class="card-header"><h3><i class="fa-solid fa-chart-pie" style="color:var(--primary);margin-right:8px;"></i>Sebaran Sumber Dana</h3></div>
                        <div class="card-body"><div class="chart-container" style="height:220px;"><canvas id="chartStatSumber"></canvas></div></div>
                    </div>
                </div>
            </div>

            <!-- ════════ SECTION: PROGRAM BEASISWA ════════ -->
            <div class="section" id="section-program">
                <div class="section-heading">
                    <h2><i class="fa-solid fa-graduation-cap" style="color:var(--primary);margin-right:10px;"></i>Program Beasiswa</h2>
                    <p>Kelola seluruh program beasiswa aktif di YARSI.</p>
                </div>
                <div class="card">
                    <div class="toolbar" style="justify-content:space-between;">
                        <div class="search-input" style="max-width:320px;">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" placeholder="Cari program...">
                        </div>
                        <button class="btn btn-primary"><i class="fa-solid fa-plus"></i> Program Baru</button>
                    </div>
                    <div class="table-wrap">
                        <table>
                            <thead><tr><th>#</th><th>Nama Program</th><th>Jenis</th><th>Kuota</th><th>Terisi</th><th>Semester</th><th>Status</th><th>Aksi</th></tr></thead>
                            <tbody>
                                <tr><td>1</td><td><div style="font-weight:600;">Beasiswa Prestasi Akademik</div><div style="font-size:11px;color:var(--text-muted);">BPA – YARSI Internal</div></td><td><span class="pill pill-purple">Full Funded</span></td><td>50</td><td><div class="prog-bar-wrap"><div class="prog-bar-bg"><div class="prog-bar-fill bar-purple" style="width:84%"></div></div><span style="font-size:11px;font-weight:700;color:var(--primary);">42/50</span></div></td><td>Genap 2025</td><td><span class="pill pill-green">Buka</span></td><td><button class="btn btn-ghost btn-sm">Edit</button></td></tr>
                                <tr><td>2</td><td><div style="font-weight:600;">Beasiswa Kurang Mampu</div><div style="font-size:11px;color:var(--text-muted);">BKM – Kemendikbud</div></td><td><span class="pill pill-amber">Partial Funded</span></td><td>30</td><td><div class="prog-bar-wrap"><div class="prog-bar-bg"><div class="prog-bar-fill bar-amber" style="width:60%"></div></div><span style="font-size:11px;font-weight:700;color:var(--accent);">18/30</span></div></td><td>Genap 2025</td><td><span class="pill pill-green">Buka</span></td><td><button class="btn btn-ghost btn-sm">Edit</button></td></tr>
                                <tr><td>3</td><td><div style="font-weight:600;">Beasiswa Hafidz Al-Qur'an</div><div style="font-size:11px;color:var(--text-muted);">BHQ – One Shot</div></td><td><span class="pill pill-blue">One Shot</span></td><td>20</td><td><div class="prog-bar-wrap"><div class="prog-bar-bg"><div class="prog-bar-fill bar-green" style="width:95%"></div></div><span style="font-size:11px;font-weight:700;color:var(--accent2);">19/20</span></div></td><td>Genap 2025</td><td><span class="pill pill-amber">Hampir Penuh</span></td><td><button class="btn btn-ghost btn-sm">Edit</button></td></tr>
                                <tr><td>4</td><td><div style="font-weight:600;">Beasiswa Yatim Piatu</div><div style="font-size:11px;color:var(--text-muted);">BYP – CSR Mitra</div></td><td><span class="pill pill-purple">Full Funded</span></td><td>15</td><td><div class="prog-bar-wrap"><div class="prog-bar-bg"><div class="prog-bar-fill bar-blue" style="width:40%"></div></div><span style="font-size:11px;font-weight:700;color:var(--info);">6/15</span></div></td><td>Genap 2025</td><td><span class="pill pill-green">Buka</span></td><td><button class="btn btn-ghost btn-sm">Edit</button></td></tr>
                                <tr><td>5</td><td><div style="font-weight:600;">KIP Kuliah</div><div style="font-size:11px;color:var(--text-muted);">KIP – Pemerintah</div></td><td><span class="pill pill-purple">Full Funded</span></td><td>80</td><td><div class="prog-bar-wrap"><div class="prog-bar-bg"><div class="prog-bar-fill bar-purple" style="width:72%"></div></div><span style="font-size:11px;font-weight:700;color:var(--primary);">58/80</span></div></td><td>Genap 2025</td><td><span class="pill pill-green">Buka</span></td><td><button class="btn btn-ghost btn-sm">Edit</button></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ════════ SECTION: PENGAJUAN MASUK ════════ -->
            <div class="section" id="section-pengajuan">
                <div class="section-heading">
                    <h2><i class="fa-solid fa-file-circle-check" style="color:var(--primary);margin-right:10px;"></i>Pengajuan Masuk</h2>
                    <p>Kelola dan tindak lanjuti pengajuan beasiswa yang memerlukan persetujuan PUSKAKA.</p>
                </div>
                <div class="quick-row">
                    <div class="quick-stat"><div class="qs-label">Baru Masuk</div><div class="qs-val" style="color:var(--accent);">8</div><div class="qs-sub">Perlu ditinjau</div></div>
                    <div class="quick-stat"><div class="qs-label">Dalam Review</div><div class="qs-val" style="color:var(--info);">14</div><div class="qs-sub">Sedang diproses</div></div>
                    <div class="quick-stat"><div class="qs-label">Disetujui Bulan Ini</div><div class="qs-val" style="color:var(--accent2);">43</div><div class="qs-sub">Menunggu pencairan</div></div>
                    <div class="quick-stat"><div class="qs-label">Dikembalikan</div><div class="qs-val" style="color:var(--danger);">7</div><div class="qs-sub">Dokumen tidak lengkap</div></div>
                </div>
                <div class="card">
                    <div class="toolbar">
                        <div class="search-input">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" placeholder="Cari nama atau NPM mahasiswa...">
                        </div>
                        <select class="filter-sel">
                            <option>Semua Status</option>
                            <option>Baru Masuk</option>
                            <option>Dalam Review</option>
                            <option>Disetujui</option>
                            <option>Dikembalikan</option>
                        </select>
                        <select class="filter-sel">
                            <option>Semua Program</option>
                            <option>BPA</option><option>BKM</option><option>BHQ</option><option>KIP</option>
                        </select>
                    </div>
                    <div class="table-wrap">
                        <table>
                            <thead><tr><th>#</th><th>Nama Mahasiswa</th><th>NPM</th><th>Program</th><th>Tgl Pengajuan</th><th>Status</th><th>Aksi</th></tr></thead>
                            <tbody>
                                <tr><td>1</td><td><div style="display:flex;align-items:center;gap:10px;"><div class="tbl-avatar" style="background:rgba(108,60,225,.2);color:var(--primary);">AF</div><span style="font-weight:600;">Ahmad Fauzi</span></div></td><td style="font-family:monospace;color:var(--text-muted);">2210101001</td><td>BPA</td><td>19 Apr 2025</td><td><span class="pill pill-amber">Baru Masuk</span></td><td style="display:flex;gap:6px;"><button class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i> Setujui</button><button class="btn btn-danger btn-sm">Kembalikan</button></td></tr>
                                <tr><td>2</td><td><div style="display:flex;align-items:center;gap:10px;"><div class="tbl-avatar" style="background:rgba(16,185,129,.2);color:var(--accent2);">SN</div><span style="font-weight:600;">Siti Nurhaliza</span></div></td><td style="font-family:monospace;color:var(--text-muted);">2210202002</td><td>KIP</td><td>18 Apr 2025</td><td><span class="pill pill-amber">Baru Masuk</span></td><td style="display:flex;gap:6px;"><button class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i> Setujui</button><button class="btn btn-danger btn-sm">Kembalikan</button></td></tr>
                                <tr><td>3</td><td><div style="display:flex;align-items:center;gap:10px;"><div class="tbl-avatar" style="background:rgba(59,130,246,.2);color:var(--info);">RP</div><span style="font-weight:600;">Rizky Pratama</span></div></td><td style="font-family:monospace;color:var(--text-muted);">2210505005</td><td>BHQ</td><td>17 Apr 2025</td><td><span class="pill pill-blue">Dalam Review</span></td><td style="display:flex;gap:6px;"><button class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i> Setujui</button><button class="btn btn-danger btn-sm">Kembalikan</button></td></tr>
                                <tr><td>4</td><td><div style="display:flex;align-items:center;gap:10px;"><div class="tbl-avatar" style="background:rgba(245,158,11,.2);color:var(--accent);">DL</div><span style="font-weight:600;">Dewi Lestari</span></div></td><td style="font-family:monospace;color:var(--text-muted);">2210404004</td><td>BKM</td><td>16 Apr 2025</td><td><span class="pill pill-blue">Dalam Review</span></td><td style="display:flex;gap:6px;"><button class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i> Setujui</button><button class="btn btn-danger btn-sm">Kembalikan</button></td></tr>
                                <tr><td>5</td><td><div style="display:flex;align-items:center;gap:10px;"><div class="tbl-avatar" style="background:rgba(239,68,68,.2);color:var(--danger);">BS</div><span style="font-weight:600;">Budi Santoso</span></div></td><td style="font-family:monospace;color:var(--text-muted);">2210303003</td><td>BPA</td><td>15 Apr 2025</td><td><span class="pill pill-red">Dikembalikan</span></td><td><button class="btn btn-ghost btn-sm">Detail</button></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination">
                        <button class="pag-btn"><i class="fa-solid fa-chevron-left" style="font-size:10px;"></i></button>
                        <button class="pag-btn active">1</button>
                        <button class="pag-btn">2</button>
                        <button class="pag-btn"><i class="fa-solid fa-chevron-right" style="font-size:10px;"></i></button>
                        <span style="margin-left:auto;font-size:12px;color:var(--text-muted);">29 pengajuan ditemukan</span>
                    </div>
                </div>
            </div>

            <!-- ════════ SECTION: EKSPOR LAPORAN ════════ -->
            <div class="section" id="section-laporan">
                <div class="section-heading">
                    <h2><i class="fa-solid fa-file-export" style="color:var(--primary);margin-right:10px;"></i>Ekspor Laporan</h2>
                    <p>Unduh data laporan dalam format Excel atau PDF untuk kebutuhan rapat pimpinan.</p>
                </div>
                <div class="export-grid">
                    <div class="export-card">
                        <div class="export-icon" style="background:rgba(108,60,225,.15);color:var(--primary);"><i class="fa-solid fa-users"></i></div>
                        <div class="export-title">Laporan Penerima Beasiswa</div>
                        <div class="export-desc">Data lengkap seluruh mahasiswa penerima beasiswa aktif beserta detail program dan sumber dana.</div>
                        <div class="export-actions">
                            <button class="btn btn-success" onclick="simulateDownload('Excel – Laporan Penerima')"><i class="fa-solid fa-file-excel"></i> Excel</button>
                            <button class="btn btn-danger" onclick="simulateDownload('PDF – Laporan Penerima')"><i class="fa-solid fa-file-pdf"></i> PDF</button>
                        </div>
                    </div>
                    <div class="export-card">
                        <div class="export-icon" style="background:rgba(245,158,11,.15);color:var(--accent);"><i class="fa-solid fa-coins"></i></div>
                        <div class="export-title">Laporan Realisasi Dana</div>
                        <div class="export-desc">Ringkasan total dana yang telah tersalurkan per program, per fakultas, dan per semester.</div>
                        <div class="export-actions">
                            <button class="btn btn-success" onclick="simulateDownload('Excel – Realisasi Dana')"><i class="fa-solid fa-file-excel"></i> Excel</button>
                            <button class="btn btn-danger" onclick="simulateDownload('PDF – Realisasi Dana')"><i class="fa-solid fa-file-pdf"></i> PDF</button>
                        </div>
                    </div>
                    <div class="export-card">
                        <div class="export-icon" style="background:rgba(16,185,129,.15);color:var(--accent2);"><i class="fa-solid fa-chart-bar"></i></div>
                        <div class="export-title">Laporan Statistik Universitas</div>
                        <div class="export-desc">Grafik dan tabel sebaran penerima antar fakultas, prodi, dan angkatan untuk presentasi.</div>
                        <div class="export-actions">
                            <button class="btn btn-success" onclick="simulateDownload('Excel – Statistik')"><i class="fa-solid fa-file-excel"></i> Excel</button>
                            <button class="btn btn-danger" onclick="simulateDownload('PDF – Statistik')"><i class="fa-solid fa-file-pdf"></i> PDF</button>
                        </div>
                    </div>
                    <div class="export-card">
                        <div class="export-icon" style="background:rgba(59,130,246,.15);color:var(--info);"><i class="fa-solid fa-calendar-days"></i></div>
                        <div class="export-title">Laporan Per Semester</div>
                        <div class="export-desc">Perbandingan data antarsemester untuk evaluasi kebijakan dan perencanaan anggaran.</div>
                        <div class="export-actions">
                            <select class="filter-sel" style="flex:1;padding:7px 12px;"><option>Genap 2024/2025</option><option>Ganjil 2024/2025</option><option>Genap 2023/2024</option></select>
                            <button class="btn btn-primary" onclick="simulateDownload('PDF – Laporan Semester')"><i class="fa-solid fa-download"></i></button>
                        </div>
                    </div>
                    <div class="export-card">
                        <div class="export-icon" style="background:rgba(139,92,246,.15);color:#A78BFA;"><i class="fa-solid fa-shield-halved"></i></div>
                        <div class="export-title">Laporan Audit Sistem</div>
                        <div class="export-desc">Riwayat seluruh aktivitas login, persetujuan, dan perubahan data untuk keperluan audit.</div>
                        <div class="export-actions">
                            <button class="btn btn-success" onclick="simulateDownload('Excel – Audit Log')"><i class="fa-solid fa-file-excel"></i> Excel</button>
                            <button class="btn btn-danger" onclick="simulateDownload('PDF – Audit Log')"><i class="fa-solid fa-file-pdf"></i> PDF</button>
                        </div>
                    </div>
                    <div class="export-card">
                        <div class="export-icon" style="background:rgba(239,68,68,.12);color:#EF4444;"><i class="fa-solid fa-sliders"></i></div>
                        <div class="export-title">Laporan Kustom</div>
                        <div class="export-desc">Buat laporan dengan filter spesifik – pilih rentang tanggal, fakultas, dan jenis beasiswa.</div>
                        <div class="export-actions"><button class="btn btn-ghost" style="flex:1;" onclick="alert('Fitur laporan kustom segera hadir.')"><i class="fa-solid fa-sliders"></i> Buat Laporan</button></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fa-solid fa-clock-rotate-left" style="color:var(--primary);margin-right:8px;"></i>Riwayat Unduhan</h3>
                        <span style="font-size:12px;color:var(--text-muted);">7 hari terakhir</span>
                    </div>
                    <div class="table-wrap">
                        <table>
                            <thead><tr><th>Nama Laporan</th><th>Format</th><th>Diunduh Oleh</th><th>Tanggal</th><th>Ukuran</th></tr></thead>
                            <tbody id="downloadHistory">
                                <tr><td>Laporan Penerima Beasiswa</td><td><span class="pill pill-green">Excel</span></td><td>PUSKAKA</td><td>19 Apr 2025, 14:22</td><td>2.4 MB</td></tr>
                                <tr><td>Statistik Universitas Q1 2025</td><td><span class="pill pill-red">PDF</span></td><td>PUSKAKA</td><td>17 Apr 2025, 09:10</td><td>1.8 MB</td></tr>
                                <tr><td>Realisasi Dana Sem. Genap</td><td><span class="pill pill-green">Excel</span></td><td>PUSKAKA</td><td>14 Apr 2025, 11:45</td><td>3.1 MB</td></tr>
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
                    <div class="quick-stat"><div class="qs-label">Aktivitas Hari Ini</div><div class="qs-val" style="color:#A78BFA;">247</div><div class="qs-sub">Total action log</div></div>
                    <div class="quick-stat"><div class="qs-label">Login Berhasil</div><div class="qs-val" style="color:var(--accent2);">89</div><div class="qs-sub">Semua role</div></div>
                    <div class="quick-stat"><div class="qs-label">Perubahan Data</div><div class="qs-val" style="color:var(--accent);">34</div><div class="qs-sub">Update & delete</div></div>
                    <div class="quick-stat"><div class="qs-label">Login Gagal</div><div class="qs-val" style="color:var(--danger);">3</div><div class="qs-sub">Hari ini</div></div>
                </div>
                <div class="card">
                    <div class="toolbar">
                        <div class="search-input">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" placeholder="Cari aktivitas, pengguna, atau aksi...">
                        </div>
                        <select class="filter-sel">
                            <option>Semua Aktivitas</option><option>Login</option><option>Persetujuan</option>
                            <option>Perubahan Data</option><option>Ekspor</option>
                        </select>
                        <select class="filter-sel">
                            <option>Semua Role</option><option>Warek</option><option>PUSKAKA</option>
                            <option>Wadek</option><option>Kaprodi</option><option>Mahasiswa</option>
                        </select>
                        <button class="btn btn-ghost btn-sm" onclick="simulateDownload('PDF – Audit Log')">
                            <i class="fa-solid fa-file-export"></i> Ekspor Log
                        </button>
                    </div>
                    <div class="audit-list" id="auditList"></div>
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

    <form id="logoutForm" method="POST" action="{{ route('logout') }}" style="display:none;">@csrf</form>

    <div id="toast" style="position:fixed;bottom:28px;right:28px;background:#1E1E35;border:1px solid rgba(108,60,225,.35);color:#E2E8F0;padding:14px 20px;border-radius:12px;font-size:13px;font-weight:500;display:none;align-items:center;gap:10px;z-index:9999;box-shadow:0 8px 32px rgba(0,0,0,.5);">
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
        overview:   'Dashboard <span>PUSKAKA</span>',
        monitoring: 'Monitoring <span>Terpadu</span>',
        statistik:  'Dashboard <span>Statistik</span>',
        program:    'Program <span>Beasiswa</span>',
        pengajuan:  'Pengajuan <span>Masuk</span>',
        laporan:    'Ekspor <span>Laporan</span>',
        audit:      'Audit <span>Activity Log</span>',
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
        entries.forEach(e => {
            if (!e.isIntersecting) return;
            const el = e.target, target = +el.dataset.count;
            let cur = 0; const inc = target / 60;
            const t = setInterval(() => { cur += inc; if (cur >= target) { cur = target; clearInterval(t); } el.textContent = Math.floor(cur).toLocaleString('id-ID'); }, 16);
            cObs.unobserve(el);
        });
    }, { threshold: 0.3 });
    countEls.forEach(el => cObs.observe(el));

    /* ─── MONITORING DATA ─── */
    const monData = [
        { nama:'Ahmad Fauzi', npm:'2210101001', prodi:'Kedokteran', fak:'FK', jenis:'Full Funded', sumber:'YARSI Internal', status:'Aktif' },
        { nama:'Siti Nurhaliza', npm:'2210202002', prodi:'Kedokteran Gigi', fak:'FKG', jenis:'Full Funded', sumber:'Kemendikbud', status:'Aktif' },
        { nama:'Budi Santoso', npm:'2210303003', prodi:'Hukum', fak:'FH', jenis:'Partial Funded', sumber:'CSR Bank Syariah', status:'Aktif' },
        { nama:'Dewi Lestari', npm:'2210404004', prodi:'Manajemen', fak:'FEB', jenis:'Full Funded', sumber:'YARSI Internal', status:'Aktif' },
        { nama:'Rizky Pratama', npm:'2210505005', prodi:'Teknik Informatika', fak:'FT', jenis:'One Shot', sumber:'Beasiswa Hafidz', status:'Aktif' },
        { nama:'Nurul Hidayah', npm:'2210606006', prodi:'Ilmu Komunikasi', fak:'FISIP', jenis:'Partial Funded', sumber:'Kemendikbud', status:'Aktif' },
        { nama:'Fajar Ramadhan', npm:'2210707007', prodi:'Psikologi', fak:'FPsi', jenis:'Full Funded', sumber:'YARSI Internal', status:'Aktif' },
        { nama:'Anisa Putri', npm:'2210808008', prodi:'Kesehatan Masyarakat', fak:'FKM', jenis:'Full Funded', sumber:'Kemendikbud', status:'Menunggu' },
        { nama:'Hendra Wijaya', npm:'2210101009', prodi:'Kedokteran', fak:'FK', jenis:'Partial Funded', sumber:'Beasiswa Yatim', status:'Aktif' },
        { nama:'Maya Sari', npm:'2210202010', prodi:'Kedokteran Gigi', fak:'FKG', jenis:'Full Funded', sumber:'YARSI Internal', status:'Aktif' },
        { nama:'Dino Aditya', npm:'2210303011', prodi:'Hukum Bisnis', fak:'FH', jenis:'One Shot', sumber:'Beasiswa Hafidz', status:'Aktif' },
        { nama:'Rina Wahyuni', npm:'2210404012', prodi:'Akuntansi', fak:'FEB', jenis:'Partial Funded', sumber:'CSR Bank Syariah', status:'Aktif' },
    ];
    const perPage = 8; let monPage = 1; let monFiltered = [...monData];
    const statusCls = { Aktif:'pill-green', Menunggu:'pill-amber', Ditolak:'pill-red' };
    const jenisCls  = { 'Full Funded':'pill-purple', 'Partial Funded':'pill-amber', 'One Shot':'pill-blue' };
    const avatarBg  = ['rgba(108,60,225,.2)','rgba(16,185,129,.2)','rgba(245,158,11,.2)','rgba(59,130,246,.2)','rgba(139,92,246,.2)'];
    const avatarTxt = ['var(--primary)','var(--accent2)','var(--accent)','var(--info)','#A78BFA'];
    const initials  = n => n.split(' ').map(w=>w[0]).join('').substring(0,2).toUpperCase();

    function renderMon() {
        const s = (monPage-1)*perPage;
        const rows = monFiltered.slice(s, s+perPage);
        document.getElementById('monTbody').innerHTML = rows.map((r,i) => `
            <tr>
                <td style="color:var(--text-muted);">${s+i+1}</td>
                <td><div style="display:flex;align-items:center;gap:10px;"><div class="tbl-avatar" style="background:${avatarBg[i%5]};color:${avatarTxt[i%5]};">${initials(r.nama)}</div><span style="font-weight:600;">${r.nama}</span></div></td>
                <td style="font-family:monospace;color:var(--text-muted);">${r.npm}</td>
                <td>${r.prodi}</td>
                <td><span class="pill pill-blue">${r.fak}</span></td>
                <td><span class="pill ${jenisCls[r.jenis]}">${r.jenis}</span></td>
                <td style="color:var(--text-muted);">${r.sumber}</td>
                <td><span class="pill ${statusCls[r.status]}">${r.status}</span></td>
            </tr>`).join('');
        const total = Math.ceil(monFiltered.length/perPage);
        let pag = `<button class="pag-btn" onclick="monChangePage(${monPage-1})" ${monPage===1?'disabled':''}><i class="fa-solid fa-chevron-left" style="font-size:10px;"></i></button>`;
        for(let i=1;i<=total;i++) pag += `<button class="pag-btn${i===monPage?' active':''}" onclick="monChangePage(${i})">${i}</button>`;
        pag += `<button class="pag-btn" onclick="monChangePage(${monPage+1})" ${monPage===total?'disabled':''}><i class="fa-solid fa-chevron-right" style="font-size:10px;"></i></button>`;
        pag += `<span style="margin-left:auto;font-size:12px;color:var(--text-muted);">${monFiltered.length} penerima</span>`;
        document.getElementById('monPag').innerHTML = pag;
    }
    function monChangePage(p) { const t=Math.ceil(monFiltered.length/perPage); if(p<1||p>t)return; monPage=p; renderMon(); }
    function filterMon() {
        const q=document.getElementById('searchMon').value.toLowerCase();
        const fk=document.getElementById('filterFak').value;
        const fs=document.getElementById('filterSumber').value;
        monFiltered = monData.filter(r=>
            (!q||r.nama.toLowerCase().includes(q)||r.npm.includes(q)||r.prodi.toLowerCase().includes(q)) &&
            (!fk||r.fak===fk) && (!fs||r.sumber===fs)
        );
        monPage=1; renderMon();
    }

    /* ─── AUDIT LOG ─── */
    const auditData = [
        {icon:'fa-right-to-bracket',ib:'rgba(108,60,225,.2)',it:'var(--primary)',title:'Login Berhasil',desc:'PUSKAKA masuk ke sistem',ip:'192.168.1.25',role:'PUSKAKA',time:'2 menit lalu',unread:true},
        {icon:'fa-file-export',ib:'rgba(16,185,129,.2)',it:'var(--accent2)',title:'Ekspor Laporan',desc:'Laporan Penerima diunduh format Excel',ip:'192.168.1.25',role:'PUSKAKA',time:'20 menit lalu',unread:true},
        {icon:'fa-circle-check',ib:'rgba(16,185,129,.2)',it:'var(--accent2)',title:'Pengajuan Disetujui',desc:'PUSKAKA menyetujui pengajuan Ahmad Fauzi (BPA)',ip:'192.168.1.25',role:'PUSKAKA',time:'45 menit lalu',unread:false},
        {icon:'fa-file-circle-check',ib:'rgba(245,158,11,.2)',it:'var(--accent)',title:'Dokumen Diverifikasi',desc:'Kaprodi FK memverifikasi dokumen Siti Nurhaliza',ip:'192.168.1.30',role:'Kaprodi',time:'1 jam lalu',unread:false},
        {icon:'fa-circle-xmark',ib:'rgba(239,68,68,.2)',it:'var(--danger)',title:'Pengajuan Dikembalikan',desc:'PUSKAKA mengembalikan pengajuan Budi Santoso – dokumen tidak lengkap',ip:'192.168.1.25',role:'PUSKAKA',time:'2 jam lalu',unread:false},
        {icon:'fa-pen-to-square',ib:'rgba(139,92,246,.2)',it:'#A78BFA',title:'Data Diubah',desc:'PUSKAKA memperbarui kuota program Beasiswa Hafidz (20→25)',ip:'192.168.1.25',role:'PUSKAKA',time:'3 jam lalu',unread:false},
        {icon:'fa-right-to-bracket',ib:'rgba(30,64,175,.2)',it:'#60A5FA',title:'Login Berhasil',desc:'Wakil Rektor masuk ke sistem',ip:'192.168.1.10',role:'Warek',time:'4 jam lalu',unread:false},
        {icon:'fa-triangle-exclamation',ib:'rgba(239,68,68,.2)',it:'var(--danger)',title:'Login Gagal',desc:'3× percobaan login gagal dari IP 10.0.0.99',ip:'10.0.0.99',role:'Unknown',time:'5 jam lalu',unread:false},
    ];
    function renderAudit() {
        document.getElementById('auditList').innerHTML = auditData.map(a => `
            <div class="audit-item">
                <div class="audit-icon" style="background:${a.ib};color:${a.it};"><i class="fa-solid ${a.icon}"></i></div>
                <div class="audit-body">
                    <div class="a-title">${a.title}</div>
                    <div class="a-desc">${a.desc}</div>
                    <div class="a-meta">
                        <span><i class="fa-solid fa-network-wired"></i>${a.ip}</span>
                        <span><i class="fa-solid fa-user-tag"></i>${a.role}</span>
                    </div>
                </div>
                <div class="audit-time">${a.time}</div>
                ${a.unread?'<div class="audit-unread"></div>':''}
            </div>`).join('');
    }

    /* ─── CHARTS ─── */
    Chart.defaults.color = '#8892A4';
    Chart.defaults.borderColor = 'rgba(255,255,255,0.06)';
    const CI = {};
    function destroyChart(id) { if(CI[id]){CI[id].destroy();delete CI[id];} }

    function initOverviewCharts() {
        destroyChart('chartDonut');
        CI['chartDonut'] = new Chart(document.getElementById('chartDonut'), {
            type:'doughnut',
            data:{ labels:['Disetujui','Menunggu','Ditolak'], datasets:[{data:[95,8,25],backgroundColor:['#6C3CE1','#F59E0B','#EF4444'],borderWidth:0,hoverOffset:6}] },
            options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}}, cutout:'72%' }
        });
    }

    function initStatistikCharts() {
        destroyChart('chartStatDanaFak');
        CI['chartStatDanaFak'] = new Chart(document.getElementById('chartStatDanaFak'), {
            type:'bar',
            data:{ labels:['FK','FKG','FH','FEB','FT','FISIP','FPsi','FKM'], datasets:[{label:'Dana (Juta Rp)',data:[3200,2400,1500,1800,1200,1050,980,1270],backgroundColor:'rgba(108,60,225,0.65)',borderColor:'#9F67FF',borderWidth:1,borderRadius:6},{label:'Target',data:[3500,2600,1700,2000,1400,1200,1100,1500],backgroundColor:'rgba(108,60,225,0.12)',borderColor:'rgba(108,60,225,0.4)',borderWidth:1,borderRadius:6}] },
            options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{labels:{color:'#8892A4'}}}, scales:{x:{grid:{display:false}},y:{grid:{color:'rgba(255,255,255,.04)'},ticks:{callback:v=>'Rp '+(v/1000)+'M'}}} }
        });
        destroyChart('chartStatJenis');
        CI['chartStatJenis'] = new Chart(document.getElementById('chartStatJenis'), {
            type:'doughnut',
            data:{ labels:['Full Funded','Partial Funded','One Shot'], datasets:[{data:[834,319,94],backgroundColor:['#6C3CE1','#F59E0B','#8B5CF6'],borderWidth:0,hoverOffset:8}] },
            options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{position:'right',labels:{color:'#8892A4',padding:16}}}, cutout:'64%' }
        });
        destroyChart('chartStatTren');
        CI['chartStatTren'] = new Chart(document.getElementById('chartStatTren'), {
            type:'line',
            data:{ labels:['Gnp22','Gnj22','Gnp23','Gnj23','Gnp24','Gnj24','Gnp25'], datasets:[
                {label:'Full Funded',data:[680,710,760,798,820,905,834],borderColor:'#6C3CE1',backgroundColor:'rgba(108,60,225,0.1)',fill:true,tension:0.4,pointRadius:3},
                {label:'Partial Funded',data:[210,225,248,270,285,300,319],borderColor:'#F59E0B',backgroundColor:'rgba(245,158,11,0.08)',fill:true,tension:0.4,pointRadius:3},
                {label:'One Shot',data:[45,52,60,68,78,85,94],borderColor:'#8B5CF6',backgroundColor:'rgba(139,92,246,0.08)',fill:true,tension:0.4,pointRadius:3}
            ]},
            options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{labels:{color:'#8892A4'}}}, scales:{x:{grid:{color:'rgba(255,255,255,.04)'}},y:{grid:{color:'rgba(255,255,255,.04)'}}} }
        });
        destroyChart('chartStatSumber');
        CI['chartStatSumber'] = new Chart(document.getElementById('chartStatSumber'), {
            type:'pie',
            data:{ labels:['YARSI Internal','Kemendikbud','CSR/Mitra','Beasiswa Hafidz','Beasiswa Yatim'], datasets:[{data:[42,28,16,8,6],backgroundColor:['#6C3CE1','#10B981','#F59E0B','#8B5CF6','#EF4444'],borderWidth:0,hoverOffset:6}] },
            options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{position:'right',labels:{color:'#8892A4',padding:12,font:{size:11}}}} }
        });
    }

    /* ─── DOWNLOAD TOAST ─── */
    function simulateDownload(name) {
        const toast = document.getElementById('toast');
        document.getElementById('toastMsg').textContent = `"${name}" berhasil diunduh!`;
        toast.style.display = 'flex';
        setTimeout(() => { toast.style.display='none'; }, 3500);
        const tbody = document.getElementById('downloadHistory');
        const now2 = new Date();
        const fmt = `${now2.getDate()} ${months[now2.getMonth()]} ${now2.getFullYear()}, ${now2.getHours().toString().padStart(2,'0')}:${now2.getMinutes().toString().padStart(2,'0')}`;
        const isExcel = name.includes('Excel');
        const row = document.createElement('tr');
        row.innerHTML = `<td>${name.replace(/^(Excel|PDF)[–-] /,'')}</td><td><span class="pill ${isExcel?'pill-green':'pill-red'}">${isExcel?'Excel':'PDF'}</span></td><td>PUSKAKA</td><td>${fmt}</td><td>${(Math.random()*3+0.5).toFixed(1)} MB</td>`;
        tbody.prepend(row);
    }

    /* ─── INIT ─── */
    renderMon();
    renderAudit();
    initOverviewCharts();
    </script>
</body>
</html>
