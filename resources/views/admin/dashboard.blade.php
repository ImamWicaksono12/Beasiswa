<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard | Sistem Beasiswa YARSI</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* =====================================================
           DESIGN SYSTEM TOKENS
        ===================================================== */
        :root {
            --sidebar-w: 288px;
            --sidebar-collapsed-w: 72px;
            --bg-page: #f0f4f8;
            --sidebar-bg: #0c1628;
            --sidebar-border: rgba(255, 255, 255, 0.06);
            --accent: #3b82f6;
            --accent-2: #6366f1;
            --accent-glow: rgba(59, 130, 246, 0.35);
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --purple: #8b5cf6;
            --card-radius: 20px;
            --card-shadow: 0 4px 24px rgba(15, 23, 42, 0.08);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg-page);
            color: #1e293b;
            margin: 0;
            overflow-x: hidden;
        }

        /* =====================================================
           SIDEBAR
        ===================================================== */
        .sidebar {
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--sidebar-bg);
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: var(--transition);
            border-right: 1px solid var(--sidebar-border);
        }

        /* Animated gradient overlay */
        .sidebar::before {
            content: '';
            position: absolute;
            top: -200px;
            right: -100px;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, transparent 70%);
            animation: sidebarGlow 6s ease-in-out infinite alternate;
            pointer-events: none;
        }

        @keyframes sidebarGlow {
            0% {
                transform: translate(0, 0) scale(1);
            }

            100% {
                transform: translate(-30px, 60px) scale(1.2);
            }
        }

        /* Brand */
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 1.75rem 1.5rem 1.25rem;
            flex-shrink: 0;
            position: relative;
        }

        .brand-icon {
            width: 46px;
            height: 46px;
            background: white;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15), 0 4px 12px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .brand-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 3px;
        }

        .brand-text {
            overflow: hidden;
            flex: 1;
        }

        .brand-text strong {
            display: block;
            font-size: 1.15rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.3px;
            line-height: 1;
        }

        .brand-text span {
            font-size: 0.72rem;
            color: #64748b;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            display: block;
            margin-top: 3px;
        }

        /* Admin badge */
        .admin-badge {
            margin: 0.25rem 1.5rem 1rem;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(99, 102, 241, 0.15));
            border: 1px solid rgba(99, 102, 241, 0.25);
            border-radius: 12px;
            padding: 0.65rem 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
        }

        .admin-badge::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: linear-gradient(180deg, var(--accent), var(--accent-2));
            border-radius: 3px 0 0 3px;
        }

        .admin-badge .avatar {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }

        .admin-badge .info span {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #e2e8f0;
            line-height: 1.2;
        }

        .admin-badge .info small {
            font-size: 0.68rem;
            color: #64748b;
        }

        /* Divider */
        .sidebar-divider {
            height: 1px;
            background: var(--sidebar-border);
            margin: 0.25rem 1.5rem 1rem;
            flex-shrink: 0;
        }

        /* Nav */
        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 0 0.75rem;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.1) transparent;
        }

        .sidebar-nav::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }

        .nav-group {
            margin-bottom: 1.25rem;
        }

        .nav-group-label {
            font-size: 0.62rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #334155;
            padding: 0 0.75rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-group-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--sidebar-border);
        }

        .nav-item {
            margin-bottom: 2px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.7rem 0.95rem;
            border-radius: 12px;
            color: #64748b;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .nav-link .nav-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
            transition: var(--transition);
            background: rgba(255, 255, 255, 0.04);
        }

        .nav-link .nav-label {
            flex: 1;
        }

        .nav-link .nav-badge {
            font-size: 0.65rem;
            font-weight: 700;
            background: var(--danger);
            color: white;
            padding: 2px 7px;
            border-radius: 50px;
            animation: pulseBadge 2s infinite;
        }

        @keyframes pulseBadge {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        .nav-link::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.08), rgba(99, 102, 241, 0.08));
            opacity: 0;
            transition: opacity 0.2s;
        }

        .nav-link:hover {
            color: #e2e8f0;
        }

        .nav-link:hover::before {
            opacity: 1;
        }

        .nav-link:hover .nav-icon {
            background: rgba(59, 130, 246, 0.15);
            color: var(--accent);
        }

        .nav-link.active {
            color: #fff;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(99, 102, 241, 0.2));
            border: 1px solid rgba(99, 102, 241, 0.25);
        }

        .nav-link.active .nav-icon {
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            color: white;
            box-shadow: 0 4px 12px var(--accent-glow);
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 60%;
            background: linear-gradient(180deg, var(--accent), var(--accent-2));
            border-radius: 3px;
        }

        /* Sidebar footer */
        .sidebar-footer {
            flex-shrink: 0;
            padding: 1rem 0.75rem;
            border-top: 1px solid var(--sidebar-border);
        }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 0.7rem 0.95rem;
            border-radius: 12px;
            background: rgba(239, 68, 68, 0.08);
            border: 1px solid rgba(239, 68, 68, 0.15);
            color: #f87171;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            cursor: pointer;
        }

        .btn-logout:hover {
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
        }

        .btn-logout .nav-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
        }

        /* =====================================================
           MAIN CONTENT
        ===================================================== */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            transition: var(--transition);
        }

        /* Top bar */
        .topbar {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(15, 23, 42, 0.06);
            padding: 0.9rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .page-breadcrumb {
            display: flex;
            flex-direction: column;
        }

        .page-breadcrumb h1 {
            font-size: 1.35rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
            line-height: 1.2;
        }

        .page-breadcrumb p {
            font-size: 0.8rem;
            color: #94a3b8;
            margin: 0;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .topbar-btn {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            border: 1px solid #e2e8f0;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 1.05rem;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
        }

        .topbar-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: rgba(59, 130, 246, 0.05);
        }

        .topbar-btn .dot {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 8px;
            height: 8px;
            background: var(--danger);
            border-radius: 50%;
            border: 2px solid white;
            animation: pulseDot 2s infinite;
        }

        @keyframes pulseDot {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.3);
            }
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.45rem 1rem 0.45rem 0.6rem;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 50px;
            cursor: pointer;
            transition: var(--transition);
        }

        .topbar-user:hover {
            border-color: var(--accent);
        }

        .topbar-user .u-avatar {
            width: 30px;
            height: 30px;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: 700;
            color: white;
        }

        .topbar-user .u-info {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .topbar-user .u-name {
            font-size: 0.8rem;
            font-weight: 600;
            color: #0f172a;
        }

        .topbar-user .u-role {
            font-size: 0.68rem;
            color: #94a3b8;
        }

        /* =====================================================
           CONTENT AREA
        ===================================================== */
        .content-area {
            padding: 2rem;
        }

        /* =====================================================
           SECTION HERO
        ===================================================== */
        .hero-banner {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f2050 100%);
            border-radius: 24px;
            padding: 2rem 2.5rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .hero-banner::before {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.3) 0%, transparent 70%);
            animation: heroPulse 5s ease-in-out infinite alternate;
            pointer-events: none;
        }

        .hero-banner::after {
            content: '';
            position: absolute;
            bottom: -60px;
            left: 30%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.2) 0%, transparent 70%);
            animation: heroPulse 7s ease-in-out infinite alternate-reverse;
            pointer-events: none;
        }

        @keyframes heroPulse {
            0% {
                transform: scale(1);
                opacity: 0.5;
            }

            100% {
                transform: scale(1.4);
                opacity: 1;
            }
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-content h2 {
            font-size: 1.5rem;
            font-weight: 800;
            color: white;
            margin: 0 0 0.4rem;
        }

        .hero-content p {
            font-size: 0.9rem;
            color: #94a3b8;
            margin: 0 0 1.25rem;
        }

        .hero-chips {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .hero-chip {
            display: flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 50px;
            padding: 4px 12px;
            font-size: 0.75rem;
            color: #cbd5e1;
            font-weight: 500;
        }

        .hero-chip i {
            font-size: 0.8rem;
        }

        .hero-stats {
            position: relative;
            z-index: 2;
            display: flex;
            gap: 1.5rem;
        }

        .hero-stat {
            text-align: center;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 1.2rem 1.6rem;
            min-width: 100px;
        }

        .hero-stat .val {
            display: block;
            font-size: 2rem;
            font-weight: 900;
            color: white;
            line-height: 1;
            margin-bottom: 4px;
        }

        .hero-stat .lbl {
            font-size: 0.7rem;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* =====================================================
           STAT CARDS
        ===================================================== */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: var(--card-radius);
            border: 1px solid #f1f5f9;
            box-shadow: var(--card-shadow);
            padding: 1.4rem;
            position: relative;
            overflow: hidden;
            transition: var(--transition);
            animation: cardIn 0.5s ease both;
        }

        @keyframes cardIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stat-card:nth-child(1) {
            animation-delay: 0.05s;
        }

        .stat-card:nth-child(2) {
            animation-delay: 0.10s;
        }

        .stat-card:nth-child(3) {
            animation-delay: 0.15s;
        }

        .stat-card:nth-child(4) {
            animation-delay: 0.20s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.12);
        }

        .stat-card .glow {
            position: absolute;
            top: -40px;
            right: -40px;
            width: 130px;
            height: 130px;
            border-radius: 50%;
            opacity: 0.08;
            filter: blur(20px);
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .stat-ico {
            width: 44px;
            height: 44px;
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .stat-trend {
            font-size: 0.72rem;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 50px;
        }

        .trend-up {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .trend-down {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .trend-neu {
            background: rgba(100, 116, 139, 0.1);
            color: #64748b;
        }

        .stat-val {
            font-size: 2rem;
            font-weight: 900;
            color: #0f172a;
            line-height: 1;
            margin-bottom: 4px;
            display: block;
        }

        .stat-lbl {
            font-size: 0.8rem;
            color: #94a3b8;
            font-weight: 500;
        }

        .stat-bar {
            margin-top: 1rem;
            height: 4px;
            background: #f1f5f9;
            border-radius: 4px;
            overflow: hidden;
        }

        .stat-bar-fill {
            height: 100%;
            border-radius: 4px;
            animation: barGrow 1.2s ease both;
        }

        @keyframes barGrow {
            from {
                width: 0 !important;
            }
        }

        /* Color themes */
        .theme-blue .stat-ico {
            background: rgba(59, 130, 246, 0.1);
            color: var(--accent);
        }

        .theme-blue .glow {
            background: var(--accent);
        }

        .theme-blue .stat-bar-fill {
            background: linear-gradient(90deg, var(--accent), var(--accent-2));
        }

        .theme-green .stat-ico {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .theme-green .glow {
            background: var(--success);
        }

        .theme-green .stat-bar-fill {
            background: linear-gradient(90deg, var(--success), #34d399);
        }

        .theme-orange .stat-ico {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .theme-orange .glow {
            background: var(--warning);
        }

        .theme-orange .stat-bar-fill {
            background: linear-gradient(90deg, var(--warning), #fbbf24);
        }

        .theme-purple .stat-ico {
            background: rgba(139, 92, 246, 0.1);
            color: var(--purple);
        }

        .theme-purple .glow {
            background: var(--purple);
        }

        .theme-purple .stat-bar-fill {
            background: linear-gradient(90deg, var(--purple), #a78bfa);
        }

        /* =====================================================
           SECTION CARDS
        ===================================================== */
        .sc {
            background: white;
            border-radius: var(--card-radius);
            border: 1px solid #f1f5f9;
            box-shadow: var(--card-shadow);
            margin-bottom: 1.5rem;
            overflow: hidden;
            animation: cardIn 0.5s ease both;
        }

        .sc-head {
            padding: 1.25rem 1.75rem;
            border-bottom: 1px solid #f8fafc;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .sc-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        .sc-title-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .sc-body {
            padding: 1.5rem 1.75rem;
        }

        .sc-body-p0 {
            padding: 0;
        }

        /* Premium button */
        .btn-prem {
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            border: none;
            color: white;
            padding: 0.55rem 1.3rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.825rem;
            font-family: 'Outfit', sans-serif;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            position: relative;
            z-index: 2;
        }

        .btn-prem:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35);
            color: white;
        }

        /* =====================================================
           TABLE CUSTOM
        ===================================================== */
        .tbl {
            width: 100%;
            border-collapse: collapse;
        }

        .tbl thead th {
            background: #f8fafc;
            padding: 0.85rem 1.25rem;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #94a3b8;
            border-bottom: 1px solid #f1f5f9;
            white-space: nowrap;
        }

        .tbl tbody td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
            font-size: 0.875rem;
            color: #334155;
            border-bottom: 1px solid #f8fafc;
            transition: background 0.2s;
        }

        .tbl tbody tr:hover td {
            background: #fafbff;
        }

        .tbl tbody tr:last-child td {
            border-bottom: none;
        }

        /* Badges */
        .badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 50px;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .badge-pill::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .badge-active {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .badge-inactive {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .badge-pending {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .badge-fully {
            background: rgba(99, 102, 241, 0.1);
            color: var(--accent-2);
        }

        .badge-partial {
            background: rgba(59, 130, 246, 0.1);
            color: var(--accent);
        }

        .badge-one {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .badge-kaprodi {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .badge-wadek {
            background: rgba(59, 130, 246, 0.1);
            color: var(--accent);
        }

        .badge-warek {
            background: rgba(99, 102, 241, 0.1);
            color: var(--accent-2);
        }

        .badge-puskaka {
            background: rgba(139, 92, 246, 0.1);
            color: var(--purple);
        }

        /* Action buttons */
        .btn-act {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 7px;
            font-size: 0.75rem;
            font-weight: 600;
            font-family: 'Outfit', sans-serif;
            border: 1px solid;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn-act-edit {
            border-color: #e2e8f0;
            background: white;
            color: #475569;
        }

        .btn-act-edit:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .btn-act-del {
            border-color: rgba(239, 68, 68, 0.2);
            background: rgba(239, 68, 68, 0.05);
            color: var(--danger);
        }

        .btn-act-del:hover {
            background: rgba(239, 68, 68, 0.1);
        }

        .btn-act-approve {
            border-color: rgba(16, 185, 129, 0.3);
            background: rgba(16, 185, 129, 0.05);
            color: var(--success);
        }

        .btn-act-approve:hover {
            background: rgba(16, 185, 129, 0.1);
        }

        .btn-act-reject {
            border-color: rgba(239, 68, 68, 0.3);
            background: rgba(239, 68, 68, 0.05);
            color: var(--danger);
        }

        .btn-act-reject:hover {
            background: rgba(239, 68, 68, 0.1);
        }

        /* =====================================================
           BEASISWA GRID CARDS
        ===================================================== */
        .beasiswa-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.25rem;
        }

        .beasiswa-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #f1f5f9;
            padding: 1.25rem;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            gap: 12px;
            animation: cardIn 0.5s ease both;
        }

        .beasiswa-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.1);
            border-color: rgba(59, 130, 246, 0.2);
        }

        .bc-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 10px;
        }

        .bc-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .bc-name {
            font-size: 0.925rem;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.3;
            flex: 1;
        }

        .bc-source {
            font-size: 0.75rem;
            color: #94a3b8;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .bc-nominal {
            font-size: 1.35rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .bc-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 10px;
            border-top: 1px solid #f1f5f9;
        }

        /* =====================================================
           TIMELINE / LOG
        ===================================================== */
        .timeline {
            position: relative;
            padding-left: 2rem;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 8px;
            top: 6px;
            bottom: 0;
            width: 2px;
            background: linear-gradient(180deg, var(--accent), transparent);
        }

        .tl-item {
            position: relative;
            margin-bottom: 1.5rem;
            animation: cardIn 0.5s ease both;
        }

        .tl-item::before {
            content: '';
            position: absolute;
            left: -1.9rem;
            top: 4px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: white;
            border: 2.5px solid var(--accent);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .tl-time {
            font-size: 0.7rem;
            color: #94a3b8;
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
        }

        .tl-card {
            background: #f8fafc;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 0.825rem;
            color: #334155;
            border-left: 3px solid var(--accent);
            line-height: 1.5;
        }

        .tl-card strong {
            color: #0f172a;
        }

        /* =====================================================
           VALIDATION QUEUE
        ===================================================== */
        .val-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 1rem;
            border-radius: 14px;
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            margin-bottom: 10px;
            transition: var(--transition);
            animation: cardIn 0.4s ease both;
        }

        .val-item:hover {
            border-color: rgba(59, 130, 246, 0.2);
            background: #fafbff;
        }

        .val-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .val-info {
            flex: 1;
            min-width: 0;
        }

        .val-info strong {
            display: block;
            font-size: 0.875rem;
            color: #0f172a;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .val-info small {
            font-size: 0.72rem;
            color: #94a3b8;
        }

        .val-actions {
            display: flex;
            gap: 6px;
            flex-shrink: 0;
        }

        /* =====================================================
           MINI CHART BAR
        ===================================================== */
        .mini-chart {
            display: flex;
            align-items: flex-end;
            gap: 5px;
            height: 50px;
        }

        .mini-bar {
            flex: 1;
            border-radius: 4px 4px 0 0;
            background: linear-gradient(180deg, var(--accent), var(--accent-2));
            opacity: 0.7;
            transition: var(--transition);
            animation: barRise 1s ease both;
        }

        @keyframes barRise {
            from {
                height: 0 !important;
            }
        }

        .mini-bar:hover {
            opacity: 1;
        }

        /* =====================================================
           CONTROL TOGGLE
        ===================================================== */
        .form-check-input:checked {
            background-color: var(--accent);
            border-color: var(--accent);
        }

        /* =====================================================
           DONUT RING (pure CSS)
        ===================================================== */
        .donut-ring {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            flex-shrink: 0;
        }

        .donut-ring .ring-label {
            position: absolute;
            text-align: center;
        }

        .donut-ring .ring-val {
            display: block;
            font-size: 1.4rem;
            font-weight: 900;
            color: #0f172a;
            line-height: 1;
        }

        .donut-ring .ring-sub {
            font-size: 0.6rem;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* =====================================================
           SCROLLBAR
        ===================================================== */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 6px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */
        @media (max-width: 1200px) {
            .stats-row {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .stats-row {
                grid-template-columns: 1fr;
            }

            .hero-stats {
                display: none;
            }
        }

        /* =====================================================
           MODAL
        ===================================================== */
        .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.18);
        }

        .modal-header {
            border-bottom: 1px solid #f1f5f9;
            padding: 1.25rem 1.75rem;
        }

        .modal-footer {
            border-top: 1px solid #f1f5f9;
            padding: 1rem 1.75rem;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            font-family: 'Outfit', sans-serif;
            padding: 0.6rem 1rem;
            font-size: 0.875rem;
            transition: var(--transition);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
        }

        .input-group-text {
            border-radius: 10px 0 0 10px;
            border: 1.5px solid #e2e8f0;
            border-right: none;
            background: #f8fafc;
            color: #64748b;
            font-weight: 600;
        }

        /* Loading spinner */
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Section animation delays */
        .sc:nth-child(1) {
            animation-delay: 0.1s;
        }

        .sc:nth-child(2) {
            animation-delay: 0.15s;
        }

        .sc:nth-child(3) {
            animation-delay: 0.2s;
        }

        .sc:nth-child(4) {
            animation-delay: 0.25s;
        }

        /* Number counter animation */
        .count-up {
            animation: countUp 0.1s ease;
        }
    </style>
</head>

<body>

    {{-- =====================================================
    SIDEBAR
    ===================================================== --}}
    <aside class="sidebar" id="mainSidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <img src="{{ asset('images/logo-yarsi.png') }}" alt="YARSI">
            </div>
            <div class="brand-text">
                <strong>YARSI</strong>
                <span>Scholarship Portal</span>
            </div>
        </div>

        <div class="admin-badge">
            <div class="avatar">AD</div>
            <div class="info">
                <span>{{ auth()->user()->nama ?? 'Admin YARSI' }}</span>
                <small>Super Administrator</small>
            </div>
            <i class="bi bi-shield-fill-check ms-auto" style="color: #3b82f6; font-size: 0.9rem;"></i>
        </div>

        <div class="sidebar-divider"></div>

        <nav class="sidebar-nav">

            {{-- PUSAT KENDALI --}}
            <div class="nav-group">
                <div class="nav-group-label">Pusat Kendali</div>
                <div class="nav-item">
                    <a href="javascript:void(0)" class="nav-link active" id="nav-dashboard"
                        onclick="switchSection('dashboard')">
                        <div class="nav-icon"><i class="bi bi-grid-fill"></i></div>
                        <span class="nav-label">Dashboard</span>
                    </a>
                </div>
            </div>

            {{-- MANAJEMEN DATA --}}
            <div class="nav-group">
                <div class="nav-group-label">Manajemen Data</div>
                <div class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" id="nav-users" onclick="switchSection('users')">
                        <div class="nav-icon"><i class="bi bi-people-fill"></i></div>
                        <span class="nav-label">Manajemen User Pejabat</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.beasiswa.index') }}" class="nav-link" id="nav-beasiswa">
                        <div class="nav-icon"><i class="bi bi-award-fill"></i></div>
                        <span class="nav-label">Master Beasiswa</span>
                    </a>
                </div>
            </div>

            {{-- VALIDASI AKHIR --}}
            <div class="nav-group">
                <div class="nav-group-label">Validasi Akhir</div>
                <div class="nav-item">
                    <a href="#" class="nav-link" id="nav-sk">
                        <div class="nav-icon"><i class="bi bi-file-earmark-check-fill"></i></div>
                        <span class="nav-label">Validasi Pendaftaran (SK)</span>
                        <span class="nav-badge">5</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link" id="nav-monitoring">
                        <div class="nav-icon"><i class="bi bi-patch-check-fill"></i></div>
                        <span class="nav-label">Validasi Final Monitoring</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link" id="nav-kontrol">
                        <div class="nav-icon"><i class="bi bi-toggle2-on"></i></div>
                        <span class="nav-label">Kontrol Status Beasiswa</span>
                    </a>
                </div>
            </div>

            {{-- SISTEM --}}
            <div class="nav-group">
                <div class="nav-group-label">Sistem</div>
                <div class="nav-item">
                    <a href="#" class="nav-link" id="nav-log">
                        <div class="nav-icon"><i class="bi bi-journal-text"></i></div>
                        <span class="nav-label">Log Aktivitas Global</span>
                    </a>
                </div>
            </div>

        </nav>

        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="btn-logout">
                    <div class="nav-icon"><i class="bi bi-box-arrow-left"></i></div>
                    <span>Keluar dari Sistem</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- =====================================================
    MAIN WRAPPER
    ===================================================== --}}
    <main class="main-wrapper">

        {{-- Top Bar --}}
        <header class="topbar">
            <div class="topbar-left">
                <div class="page-breadcrumb">
                    <h1 id="pageTitle">Dashboard Admin</h1>
                    <p id="pageSubtitle">Pusat Kendali Sistem Beasiswa YARSI</p>
                </div>
            </div>
            <div class="topbar-right">
                <button class="topbar-btn" title="Notifikasi">
                    <i class="bi bi-bell"></i>
                    <span class="dot"></span>
                </button>
                <div class="topbar-user">
                    <div class="u-avatar">AD</div>
                    <div class="u-info">
                        <span class="u-name">{{ auth()->user()->nama ?? 'Admin' }}</span>
                        <span class="u-role">Super Administrator</span>
                    </div>
                    <i class="bi bi-chevron-down ms-1" style="font-size:0.65rem; color:#94a3b8;"></i>
                </div>
            </div>
        </header>

        {{-- =====================================================
        CONTENT SECTIONS (masing-masing jadi "page")
        ===================================================== --}}
        <div class="content-area">

            {{-- ======================== PAGE: DASHBOARD ======================== --}}
            <div class="page-section" id="section-dashboard">

                {{-- Hero Banner --}}
                <div class="hero-banner">
                    <div class="hero-content">
                        <h2>Selamat Datang, Administrator 👋</h2>
                        <p>Sistem Beasiswa YARSI — Pusat Kendali, Validasi Akhir, dan Manajemen Data</p>
                        <div class="hero-chips">
                            <span class="hero-chip"><i class="bi bi-shield-check"></i> Akses Penuh</span>
                            <span class="hero-chip"><i class="bi bi-clock"></i> {{ now()->format('d M Y, H:i') }}
                                WIB</span>
                            <span class="hero-chip"><i class="bi bi-circle-fill"
                                    style="color:#10b981; font-size:0.5rem;"></i> Sistem Online</span>
                        </div>
                    </div>
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <span class="val" id="heroTotalBeasiswa">{{ $stats['total_beasiswa'] ?? 0 }}</span>
                            <span class="lbl">Total Beasiswa</span>
                        </div>
                        <div class="hero-stat">
                            <span class="val" id="heroBeasiswaAktif">{{ $stats['beasiswa_aktif'] ?? 0 }}</span>
                            <span class="lbl">Aktif</span>
                        </div>
                        <div class="hero-stat">
                            <span class="val" id="heroPejabat">{{ $stats['total_pejabat'] ?? 0 }}</span>
                            <span class="lbl">Pejabat</span>
                        </div>
                    </div>
                </div>

                {{-- Stats Grid --}}
                <div class="stats-row">
                    <div class="stat-card theme-blue">
                        <div class="glow"></div>
                        <div class="stat-top">
                            <div class="stat-ico"><i class="bi bi-award-fill"></i></div>
                            <span class="stat-trend trend-neu">Total</span>
                        </div>
                        <span class="stat-val" id="statTotalBeasiswa">{{ $stats['total_beasiswa'] ?? 0 }}</span>
                        <div class="stat-lbl">Program Beasiswa</div>
                        <div class="stat-bar">
                            <div class="stat-bar-fill" style="width: 100%;"></div>
                        </div>
                    </div>

                    <div class="stat-card theme-green">
                        <div class="glow"></div>
                        <div class="stat-top">
                            <div class="stat-ico"><i class="bi bi-check-circle-fill"></i></div>
                            <span class="stat-trend trend-up"><i class="bi bi-arrow-up"></i> Aktif</span>
                        </div>
                        <span class="stat-val" id="statBeasiswaAktif">{{ $stats['beasiswa_aktif'] ?? 0 }}</span>
                        <div class="stat-lbl">Beasiswa Aktif</div>
                        <div class="stat-bar">
                            @php $pctAktif = $stats['total_beasiswa'] > 0 ? round(($stats['beasiswa_aktif'] / $stats['total_beasiswa']) * 100) : 0; @endphp
                            <div class="stat-bar-fill" style="width: {{ $pctAktif }}%;"></div>
                        </div>
                    </div>

                    <div class="stat-card theme-orange">
                        <div class="glow"></div>
                        <div class="stat-top">
                            <div class="stat-ico"><i class="bi bi-x-circle-fill"></i></div>
                            <span class="stat-trend trend-down">Non-Aktif</span>
                        </div>
                        <span class="stat-val" id="statBeasiswaNonaktif">{{ $stats['beasiswa_nonaktif'] ?? 0 }}</span>
                        <div class="stat-lbl">Beasiswa Non-Aktif</div>
                        <div class="stat-bar">
                            @php $pctNon = $stats['total_beasiswa'] > 0 ? round(($stats['beasiswa_nonaktif'] / $stats['total_beasiswa']) * 100) : 0; @endphp
                            <div class="stat-bar-fill" style="width: {{ $pctNon }}%;"></div>
                        </div>
                    </div>

                    <div class="stat-card theme-purple">
                        <div class="glow"></div>
                        <div class="stat-top">
                            <div class="stat-ico"><i class="bi bi-people-fill"></i></div>
                            <span class="stat-trend trend-neu">Pejabat</span>
                        </div>
                        <span class="stat-val" id="statTotalPejabat">{{ $stats['total_pejabat'] ?? 0 }}</span>
                        <div class="stat-lbl">Total Akun Pejabat</div>
                        <div class="stat-bar">
                            <div class="stat-bar-fill" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    {{-- Distribusi Beasiswa --}}
                    <div class="col-xl-5">
                        <div class="sc">
                            <div class="sc-head">
                                <h3 class="sc-title">
                                    <div class="sc-title-icon" style="background:rgba(99,102,241,0.1); color:#6366f1;">
                                        <i class="bi bi-pie-chart-fill"></i>
                                    </div>
                                    Distribusi Beasiswa
                                </h3>
                            </div>
                            <div class="sc-body">
                                <div class="d-flex gap-4 align-items-center mb-4">
                                    <div style="position:relative; width:110px; height:110px;">
                                        <canvas id="donutChart" width="110" height="110"></canvas>
                                        <div
                                            style="position:absolute; inset:0; display:flex; flex-direction:column; align-items:center; justify-content:center; pointer-events:none;">
                                            <span
                                                style="font-size:1.5rem; font-weight:900; color:#0f172a; line-height:1;">{{ $stats['total_beasiswa'] ?? 0 }}</span>
                                            <span style="font-size:0.6rem; color:#94a3b8; font-weight:600;">TOTAL</span>
                                        </div>
                                    </div>
                                    <div style="flex:1;">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <div
                                                    style="width:10px;height:10px;border-radius:50%;background:#6366f1;">
                                                </div>
                                                <span style="font-size:0.8rem; color:#475569;">Fully Funded</span>
                                            </div>
                                            <strong
                                                style="font-size:1rem; color:#0f172a;">{{ $stats['fully_funded'] ?? 0 }}</strong>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <div
                                                    style="width:10px;height:10px;border-radius:50%;background:#3b82f6;">
                                                </div>
                                                <span style="font-size:0.8rem; color:#475569;">Partially Funded</span>
                                            </div>
                                            <strong
                                                style="font-size:1rem; color:#0f172a;">{{ $stats['partially_funded'] ?? 0 }}</strong>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-2">
                                                <div
                                                    style="width:10px;height:10px;border-radius:50%;background:#f59e0b;">
                                                </div>
                                                <span style="font-size:0.8rem; color:#475569;">One Shoot</span>
                                            </div>
                                            <strong
                                                style="font-size:1rem; color:#0f172a;">{{ $stats['one_shoot'] ?? 0 }}</strong>
                                        </div>
                                    </div>
                                </div>

                                {{-- Mini bar chart --}}
                                <div style="border-top:1px solid #f1f5f9; padding-top:1rem;">
                                    <div
                                        style="font-size:0.72rem; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:#94a3b8; margin-bottom:8px;">
                                        Distribusi Role Pejabat</div>
                                    <div class="d-flex gap-3">
                                        @php
                                            $roles = [
                                                ['label' => 'Kaprodi', 'val' => $stats['total_kaprodi'] ?? 0, 'color' => '#10b981'],
                                                ['label' => 'Wadek', 'val' => $stats['total_wadek'] ?? 0, 'color' => '#3b82f6'],
                                                ['label' => 'Warek', 'val' => $stats['total_warek'] ?? 0, 'color' => '#6366f1'],
                                                ['label' => 'Puskaka', 'val' => $stats['total_puskaka'] ?? 0, 'color' => '#8b5cf6'],
                                            ];
                                            $maxRole = max(array_column($roles, 'val')) ?: 1;
                                        @endphp
                                        @foreach($roles as $r)
                                            <div style="flex:1; text-align:center;">
                                                <div
                                                    style="height:50px; display:flex; align-items:flex-end; justify-content:center; margin-bottom:6px;">
                                                    <div
                                                        style="width:28px; border-radius:6px 6px 0 0; background:{{$r['color']}}; height:{{ max(8, round(($r['val'] / $maxRole) * 50)) }}px; transition:all 1.2s ease; opacity:0.85;">
                                                    </div>
                                                </div>
                                                <div style="font-size:1rem; font-weight:800; color:#0f172a;">{{ $r['val'] }}
                                                </div>
                                                <div style="font-size:0.65rem; color:#94a3b8;">{{ $r['label'] }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Recent Beasiswa Realtime --}}
                    <div class="col-xl-7">
                        <div class="sc">
                            <div class="sc-head">
                                <h3 class="sc-title">
                                    <div class="sc-title-icon" style="background:rgba(59,130,246,0.1); color:#3b82f6;">
                                        <i class="bi bi-award-fill"></i>
                                    </div>
                                    Program Beasiswa Terbaru
                                    <span class="badge-pill badge-active ms-2" style="font-size:0.65rem;"
                                        id="liveIndicator">● Live</span>
                                </h3>
                                <a href="{{ route('admin.beasiswa.index') }}" class="btn-prem"
                                    style="font-size:0.78rem; padding:0.4rem 1rem;">
                                    <i class="bi bi-arrow-right"></i> Kelola Semua
                                </a>
                            </div>
                            <div class="sc-body-p0">
                                <div class="beasiswa-grid" style="padding:1.25rem 1.5rem;" id="realtimeBeasiswa">
                                    @forelse($recentBeasiswa ?? [] as $b)
                                        @php
                                            $iconClass = match ($b->kategori_dana) {
                                                'fully_funded' => 'bi-shield-fill-check',
                                                'partially_funded' => 'bi-shield-half',
                                                default => 'bi-lightning-fill',
                                            };
                                            $iconColor = match ($b->kategori_dana) {
                                                'fully_funded' => 'background:rgba(99,102,241,0.1); color:#6366f1;',
                                                'partially_funded' => 'background:rgba(59,130,246,0.1); color:#3b82f6;',
                                                default => 'background:rgba(245,158,11,0.1); color:#f59e0b;',
                                            };
                                            $badgeClass = match ($b->kategori_dana) {
                                                'fully_funded' => 'badge-fully',
                                                'partially_funded' => 'badge-partial',
                                                default => 'badge-one',
                                            };
                                        @endphp
                                        <div class="beasiswa-card">
                                            <div class="bc-top">
                                                <div class="bc-icon" style="{{ $iconColor }}"><i
                                                        class="bi {{ $iconClass }}"></i></div>
                                                <span class="badge-pill {{ $badgeClass }}">{{ $b->kategori_label }}</span>
                                            </div>
                                            <div>
                                                <div class="bc-name">{{ $b->nama_beasiswa }}</div>
                                                <div class="bc-source"><i class="bi bi-building"></i> {{ $b->sumber_dana }}
                                                </div>
                                            </div>
                                            <div class="bc-nominal">{{ $b->nominal_rupiah }}</div>
                                            <div class="bc-footer">
                                                <span
                                                    class="badge-pill {{ $b->is_active ? 'badge-active' : 'badge-inactive' }}">
                                                    {{ $b->is_active ? 'Aktif' : 'Non-Aktif' }}
                                                </span>
                                                <a href="{{ route('admin.beasiswa.index') }}" class="btn-act btn-act-edit">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                            </div>
                                        </div>
                                    @empty
                                        <div style="grid-column:1/-1; text-align:center; padding:3rem; color:#94a3b8;">
                                            <i class="bi bi-inbox"
                                                style="font-size:3rem; display:block; margin-bottom:10px;"></i>
                                            Belum ada program beasiswa. <a href="{{ route('admin.beasiswa.index') }}"
                                                style="color:var(--accent);">Tambah sekarang</a>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    {{-- Validasi SK Queue --}}
                    <div class="col-xl-6">
                        <div class="sc">
                            <div class="sc-head">
                                <h3 class="sc-title">
                                    <div class="sc-title-icon" style="background:rgba(245,158,11,0.1); color:#f59e0b;">
                                        <i class="bi bi-file-earmark-check-fill"></i>
                                    </div>
                                    Antrean Validasi SK
                                </h3>
                                <span class="badge-pill badge-pending">5 Pending</span>
                            </div>
                            <div class="sc-body">
                                <div class="val-item" style="animation-delay:0.1s;">
                                    <div class="val-icon" style="background:rgba(59,130,246,0.1); color:#3b82f6;"><i
                                            class="bi bi-file-text-fill"></i></div>
                                    <div class="val-info">
                                        <strong>SK.2025.001 — Beasiswa Prestasi</strong>
                                        <small>Diajukan 2 jam lalu · Prodi Teknik Informatika</small>
                                    </div>
                                    <div class="val-actions">
                                        <button class="btn-act btn-act-approve"><i class="bi bi-check-lg"></i></button>
                                        <button class="btn-act btn-act-reject"><i class="bi bi-x-lg"></i></button>
                                    </div>
                                </div>
                                <div class="val-item" style="animation-delay:0.15s;">
                                    <div class="val-icon" style="background:rgba(99,102,241,0.1); color:#6366f1;"><i
                                            class="bi bi-file-text-fill"></i></div>
                                    <div class="val-info">
                                        <strong>SK.2025.002 — Beasiswa Tahfidz</strong>
                                        <small>Diajukan kemarin · Submitted oleh Puskaka</small>
                                    </div>
                                    <div class="val-actions">
                                        <button class="btn-act btn-act-approve"><i class="bi bi-check-lg"></i></button>
                                        <button class="btn-act btn-act-reject"><i class="bi bi-x-lg"></i></button>
                                    </div>
                                </div>
                                <div class="val-item" style="animation-delay:0.2s;">
                                    <div class="val-icon" style="background:rgba(16,185,129,0.1); color:#10b981;"><i
                                            class="bi bi-file-text-fill"></i></div>
                                    <div class="val-info">
                                        <strong>SK.2025.003 — Beasiswa Yatim</strong>
                                        <small>3 hari lalu · Prodi Kedokteran</small>
                                    </div>
                                    <div class="val-actions">
                                        <button class="btn-act btn-act-approve"><i class="bi bi-check-lg"></i></button>
                                        <button class="btn-act btn-act-reject"><i class="bi bi-x-lg"></i></button>
                                    </div>
                                </div>
                                <div style="text-align:center; margin-top:0.75rem;">
                                    <button class="btn-act btn-act-edit"
                                        style="width:100%; justify-content:center;">Lihat Semua Antrean</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Log Aktivitas --}}
                    <div class="col-xl-6">
                        <div class="sc">
                            <div class="sc-head">
                                <h3 class="sc-title">
                                    <div class="sc-title-icon" style="background:rgba(100,116,139,0.1); color:#64748b;">
                                        <i class="bi bi-journal-text"></i>
                                    </div>
                                    Log Aktivitas Global
                                </h3>
                                <button class="btn-act btn-act-edit">Lihat Semua</button>
                            </div>
                            <div class="sc-body">
                                <div class="timeline">
                                    <div class="tl-item">
                                        <span class="tl-time">Hari ini, 11:32 AM</span>
                                        <div class="tl-card">
                                            <strong>Admin</strong> menambahkan program beasiswa baru: <strong>"Beasiswa
                                                Prestasi Akademik"</strong>
                                        </div>
                                    </div>
                                    <div class="tl-item">
                                        <span class="tl-time">Hari ini, 09:14 AM</span>
                                        <div class="tl-card">
                                            <strong>Kaprodi TI</strong> memvalidasi 12 laporan monitoring mahasiswa.
                                        </div>
                                    </div>
                                    <div class="tl-item">
                                        <span class="tl-time">Kemarin, 04:45 PM</span>
                                        <div class="tl-card" style="border-left-color: #ef4444;">
                                            <strong>Admin</strong> menonaktifkan akun verifikator <strong>Budi
                                                Hartono</strong>.
                                        </div>
                                    </div>
                                    <div class="tl-item">
                                        <span class="tl-time">Kemarin, 02:00 PM</span>
                                        <div class="tl-card" style="border-left-color: #10b981;">
                                            Sistem mengirimkan notifikasi pengumuman beasiswa semester ganjil 2024/2025.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            {{-- END PAGE DASHBOARD --}}

            {{-- ======================== PAGE: USER PEJABAT ======================== --}}
            <div class="page-section" id="section-users" style="display:none;">

                {{-- Header --}}
                <div class="hero-banner" style="padding:1.75rem 2.25rem;">
                    <div class="hero-content">
                        <h2><i class="bi bi-people-fill me-2"></i>Manajemen User Pejabat</h2>
                        <p>Kelola akun Kaprodi, Wadek, Warek, dan Puskaka. Data mahasiswa diambil dari LDAP.</p>
                    </div>
                    <button class="btn-prem" onclick="openCreateModal()">
                        <i class="bi bi-plus-lg"></i> Tambah User
                    </button>
                </div>

                {{-- Filter & Search --}}
                <div class="sc">
                    <div class="sc-body" style="padding:1rem 1.5rem;">
                        <div class="d-flex gap-3 align-items-center flex-wrap">
                            <div class="d-flex align-items-center gap-2 flex-grow-1" style="max-width:360px;">
                                <div class="position-relative flex-grow-1">
                                    <i class="bi bi-search"
                                        style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;"></i>
                                    <input type="text" id="searchUser" class="form-control"
                                        placeholder="Cari nama, username, email..." style="padding-left:36px;">
                                </div>
                            </div>
                            <select id="filterRole" class="form-select" style="width:auto;min-width:160px;">
                                <option value="">Semua Role</option>
                                <option value="kaprodi">Kaprodi</option>
                                <option value="wadek">Wadek</option>
                                <option value="warek">Warek</option>
                                <option value="puskaka">Puskaka</option>
                            </select>
                            <button class="btn-act btn-act-edit" onclick="loadUsers()"><i
                                    class="bi bi-arrow-clockwise"></i> Refresh</button>
                            <div class="ms-auto d-flex align-items-center gap-2">
                                <span style="font-size:0.78rem;color:#94a3b8;">Total:</span>
                                <span class="badge-pill badge-active" id="userCountBadge"
                                    style="font-size:0.75rem;">0</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Table --}}
                <div class="sc">
                    <div class="sc-body-p0">
                        <div style="overflow-x:auto;">
                            <table class="tbl" id="usersTable">
                                <thead>
                                    <tr>
                                        <th style="width:50px;">#</th>
                                        <th>User</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Kode Prodi</th>
                                        <th>Kode Fakultas</th>
                                        <th>Status</th>
                                        <th style="width:180px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="usersTableBody">
                                    <tr>
                                        <td colspan="8" style="text-align:center;padding:3rem;color:#94a3b8;">
                                            <div class="spinner-border spinner-border-sm text-primary me-2"
                                                role="status"></div> Memuat data...
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- END PAGE USERS --}}

        </div>
        {{-- END CONTENT AREA --}}

        {{-- ===================== MODAL: CREATE/EDIT USER ===================== --}}
        <div class="modal fade" id="userModal" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center gap-2" id="userModalTitle">
                            <div class="sc-title-icon"
                                style="background:rgba(99,102,241,0.1);color:#6366f1;width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                <i class="bi bi-person-plus-fill"></i>
                            </div>
                            <span>Tambah User Pejabat</span>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="userForm" onsubmit="submitUser(event)">
                        <div class="modal-body" style="padding:1.5rem 1.75rem;">
                            <input type="hidden" id="userId" value="">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label"
                                        style="font-size:0.8rem;font-weight:600;color:#475569;">Nama Lengkap <span
                                            style="color:var(--danger);">*</span></label>
                                    <input type="text" id="inputNama" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"
                                        style="font-size:0.8rem;font-weight:600;color:#475569;">Username <span
                                            style="color:var(--danger);">*</span></label>
                                    <input type="text" id="inputUsername" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"
                                        style="font-size:0.8rem;font-weight:600;color:#475569;">Email</label>
                                    <input type="email" id="inputEmail" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"
                                        style="font-size:0.8rem;font-weight:600;color:#475569;">Role <span
                                            style="color:var(--danger);">*</span></label>
                                    <select id="inputRole" class="form-select" required>
                                        <option value="">— Pilih Role —</option>
                                        <option value="kaprodi">Kaprodi</option>
                                        <option value="wadek">Wadek</option>
                                        <option value="warek">Warek</option>
                                        <option value="puskaka">Puskaka</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"
                                        style="font-size:0.8rem;font-weight:600;color:#475569;">Password <span
                                            id="pwdRequired" style="color:var(--danger);">*</span></label>
                                    <input type="password" id="inputPassword" class="form-control">
                                    <small id="pwdHint" class="text-muted"
                                        style="font-size:0.72rem;display:none;">Kosongkan jika tidak ingin mengubah
                                        password.</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"
                                        style="font-size:0.8rem;font-weight:600;color:#475569;">Konfirmasi Password
                                        <span id="pwdConfRequired" style="color:var(--danger);">*</span></label>
                                    <input type="password" id="inputPasswordConfirm" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"
                                        style="font-size:0.8rem;font-weight:600;color:#475569;">Kode Prodi</label>
                                    <input type="text" id="inputKodeProdi" class="form-control" placeholder="Opsional">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"
                                        style="font-size:0.8rem;font-weight:600;color:#475569;">Kode Fakultas</label>
                                    <input type="text" id="inputKodeFakultas" class="form-control"
                                        placeholder="Opsional">
                                </div>
                                <div class="col-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="inputIsActive" checked>
                                        <label class="form-check-label" for="inputIsActive"
                                            style="font-size:0.8rem;font-weight:600;color:#475569;">Status Aktif</label>
                                    </div>
                                </div>
                            </div>
                            <div id="formErrors" class="alert alert-danger mt-3"
                                style="display:none;border-radius:12px;font-size:0.82rem;"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-act btn-act-edit" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn-prem" id="btnSubmitUser">
                                <i class="bi bi-check-lg"></i> <span>Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ===================== MODAL: DELETE CONFIRM ===================== --}}
        <div class="modal fade" id="deleteModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content" style="text-align:center;">
                    <div class="modal-body" style="padding:2rem;">
                        <div
                            style="width:56px;height:56px;border-radius:50%;background:rgba(239,68,68,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                            <i class="bi bi-exclamation-triangle-fill"
                                style="font-size:1.5rem;color:var(--danger);"></i>
                        </div>
                        <h5 style="font-weight:700;margin-bottom:0.5rem;">Hapus User?</h5>
                        <p style="font-size:0.85rem;color:#64748b;" id="deleteUserName">User ini akan dihapus secara
                            permanen.</p>
                        <input type="hidden" id="deleteUserId">
                        <div class="d-flex gap-2 justify-content-center mt-3">
                            <button class="btn-act btn-act-edit" data-bs-dismiss="modal"
                                style="padding:8px 20px;">Batal</button>
                            <button class="btn-act btn-act-del" onclick="confirmDelete()" style="padding:8px 20px;">
                                <i class="bi bi-trash3"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        /* =====================================================
           DONUT CHART (Canvas API)
        ===================================================== */
        (function drawDonut() {
            const canvas = document.getElementById('donutChart');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            const cx = 55, cy = 55, r = 42, sw = 14;
            const full = {{ $stats['fully_funded'] ?? 0 }};
            const partial = {{ $stats['partially_funded'] ?? 0 }};
            const one = {{ $stats['one_shoot'] ?? 0 }};
            const total = full + partial + one || 1;
            const segments = [
                { val: full, color: '#6366f1' },
                { val: partial, color: '#3b82f6' },
                { val: one, color: '#f59e0b' },
            ];
            let start = -Math.PI / 2;
            const gap = 0.04;

            ctx.clearRect(0, 0, 110, 110);

            // Background ring
            ctx.beginPath();
            ctx.arc(cx, cy, r, 0, Math.PI * 2);
            ctx.strokeStyle = '#f1f5f9';
            ctx.lineWidth = sw;
            ctx.stroke();

            segments.forEach(seg => {
                if (seg.val === 0) return;
                const angle = (seg.val / total) * Math.PI * 2 - gap;
                ctx.beginPath();
                ctx.arc(cx, cy, r, start + gap / 2, start + angle + gap / 2);
                ctx.strokeStyle = seg.color;
                ctx.lineWidth = sw;
                ctx.lineCap = 'round';
                ctx.stroke();
                start += (seg.val / total) * Math.PI * 2;
            });
        })();

        /* =====================================================
           NUMBER COUNTER ANIMATION
        ===================================================== */
        function animateCounter(el, target) {
            let current = 0;
            const step = Math.ceil(target / 40);
            const interval = setInterval(() => {
                current = Math.min(current + step, target);
                el.textContent = current;
                if (current >= target) clearInterval(interval);
            }, 30);
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.stat-val, .hero-stat .val').forEach(el => {
                const target = parseInt(el.textContent) || 0;
                if (target > 0) animateCounter(el, target);
            });
        });

        /* =====================================================
           AUTO-REFRESH REALTIME STATS (setiap 30 detik)
        ===================================================== */
        function refreshStats() {
            fetch('{{ route("dashboard.admin") }}', {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            })
                .then(r => r.ok ? r.json() : null)
                .then(data => {
                    if (!data || !data.stats) return;
                    const s = data.stats;
                    document.getElementById('statTotalBeasiswa').textContent = s.total_beasiswa;
                    document.getElementById('statBeasiswaAktif').textContent = s.beasiswa_aktif;
                    document.getElementById('statBeasiswaNonaktif').textContent = s.beasiswa_nonaktif;
                    document.getElementById('statTotalPejabat').textContent = s.total_pejabat;
                    document.getElementById('heroTotalBeasiswa').textContent = s.total_beasiswa;
                    document.getElementById('heroBeasiswaAktif').textContent = s.beasiswa_aktif;
                    document.getElementById('heroPejabat').textContent = s.total_pejabat;
                })
                .catch(() => {/* silent fail */ });
        }

        setInterval(refreshStats, 30000);

        /* Live indicator blink */
        setInterval(() => {
            const li = document.getElementById('liveIndicator');
            if (li) li.style.opacity = li.style.opacity === '0.4' ? '1' : '0.4';
        }, 1000);

        /* =====================================================
           SECTION SWITCHER
        ===================================================== */
        const sectionMap = {
            dashboard: { section: 'section-dashboard', nav: 'nav-dashboard', title: 'Dashboard Admin', sub: 'Pusat Kendali Sistem Beasiswa YARSI' },
            users: { section: 'section-users', nav: 'nav-users', title: 'Manajemen User Pejabat', sub: 'Kelola akun pejabat (Kaprodi, Wadek, Warek, Puskaka)' },
        };

        function switchSection(key) {
            const info = sectionMap[key];
            if (!info) return;

            document.querySelectorAll('.page-section').forEach(s => s.style.display = 'none');
            document.querySelectorAll('.sidebar-nav .nav-link').forEach(l => l.classList.remove('active'));

            document.getElementById(info.section).style.display = '';
            document.getElementById(info.nav).classList.add('active');
            document.getElementById('pageTitle').textContent = info.title;
            document.getElementById('pageSubtitle').textContent = info.sub;

            if (key === 'users') loadUsers();
        }

        /* =====================================================
           USER PEJABAT CRUD
        ===================================================== */
        const USERS_URL = '{{ route("admin.users.index") }}';
        const CSRF = document.querySelector('meta[name="csrf-token"]').content;

        const roleBadge = r => {
            const m = { kaprodi: 'badge-kaprodi', wadek: 'badge-wadek', warek: 'badge-warek', puskaka: 'badge-puskaka' };
            return `<span class="badge-pill ${m[r] || 'badge-pending'}">${r.charAt(0).toUpperCase() + r.slice(1)}</span>`;
        };

        const roleColors = { kaprodi: '#10b981', wadek: '#3b82f6', warek: '#6366f1', puskaka: '#8b5cf6' };

        function avatarInitials(name) {
            return name.split(' ').slice(0, 2).map(w => w[0]).join('').toUpperCase();
        }

        /* — Load users — */
        function loadUsers() {
            const search = document.getElementById('searchUser').value;
            const role = document.getElementById('filterRole').value;
            const params = new URLSearchParams();
            if (search) params.set('search', search);
            if (role) params.set('role', role);

            const tbody = document.getElementById('usersTableBody');
            tbody.innerHTML = `<tr><td colspan="8" style="text-align:center;padding:3rem;color:#94a3b8;">
        <div class="spinner-border spinner-border-sm text-primary me-2" role="status"></div> Memuat data...</td></tr>`;

            fetch(USERS_URL + '?' + params.toString(), {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            })
                .then(r => r.json())
                .then(res => {
                    const users = res.data || [];
                    document.getElementById('userCountBadge').textContent = users.length;

                    if (!users.length) {
                        tbody.innerHTML = `<tr><td colspan="8" style="text-align:center;padding:3rem;color:#94a3b8;">
                <i class="bi bi-person-x" style="font-size:2.5rem;display:block;margin-bottom:8px;"></i>
                Tidak ada data user pejabat ditemukan.</td></tr>`;
                        return;
                    }

                    tbody.innerHTML = users.map((u, i) => `
            <tr style="animation:cardIn 0.3s ease both;animation-delay:${i * 0.03}s;">
                <td style="font-weight:600;color:#94a3b8;">${i + 1}</td>
                <td>
                    <div class="d-flex align-items-center gap-10" style="gap:10px;">
                        <div style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,${roleColors[u.role] || '#6366f1'}80,${roleColors[u.role] || '#6366f1'});display:flex;align-items:center;justify-content:center;font-size:0.7rem;font-weight:700;color:white;flex-shrink:0;">
                            ${avatarInitials(u.nama)}
                        </div>
                        <div>
                            <div style="font-weight:600;color:#0f172a;font-size:0.875rem;">${u.nama}</div>
                            <div style="font-size:0.72rem;color:#94a3b8;">${u.email || '—'}</div>
                        </div>
                    </div>
                </td>
                <td><code style="background:#f1f5f9;padding:2px 8px;border-radius:6px;font-size:0.78rem;">${u.username}</code></td>
                <td>${roleBadge(u.role)}</td>
                <td>${u.kode_prodi || '<span style="color:#cbd5e1;">—</span>'}</td>
                <td>${u.kode_fakultas || '<span style="color:#cbd5e1;">—</span>'}</td>
                <td>
                    <div class="form-check form-switch" style="margin:0;">
                        <input class="form-check-input" type="checkbox" ${u.is_active ? 'checked' : ''} onchange="toggleUserStatus(${u.id})" title="Toggle status">
                    </div>
                </td>
                <td>
                    <div class="d-flex gap-1">
                        <button class="btn-act btn-act-edit" onclick="openEditModal(${u.id})"><i class="bi bi-pencil"></i> Edit</button>
                        <button class="btn-act btn-act-del" onclick="openDeleteModal(${u.id},'${u.nama.replace(/'/g, "\\'")}')"><i class="bi bi-trash3"></i></button>
                    </div>
                </td>
            </tr>
        `).join('');
                })
                .catch(() => {
                    tbody.innerHTML = `<tr><td colspan="8" style="text-align:center;padding:3rem;color:var(--danger);">
            <i class="bi bi-wifi-off" style="font-size:2rem;display:block;margin-bottom:8px;"></i>
            Gagal memuat data. Periksa koneksi Anda.</td></tr>`;
                });
        }

        /* — Debounced search/filter — */
        let searchTimer;
        document.addEventListener('DOMContentLoaded', () => {
            const s = document.getElementById('searchUser');
            const f = document.getElementById('filterRole');
            if (s) s.addEventListener('input', () => { clearTimeout(searchTimer); searchTimer = setTimeout(loadUsers, 350); });
            if (f) f.addEventListener('change', loadUsers);
        });

        /* — Create modal — */
        function openCreateModal() {
            document.getElementById('userId').value = '';
            document.getElementById('userForm').reset();
            document.getElementById('inputIsActive').checked = true;
            document.getElementById('userModalTitle').querySelector('span').textContent = 'Tambah User Pejabat';
            document.getElementById('userModalTitle').querySelector('i').className = 'bi bi-person-plus-fill';
            document.getElementById('inputPassword').required = true;
            document.getElementById('inputPasswordConfirm').required = true;
            document.getElementById('pwdRequired').style.display = '';
            document.getElementById('pwdConfRequired').style.display = '';
            document.getElementById('pwdHint').style.display = 'none';
            document.getElementById('formErrors').style.display = 'none';
            document.getElementById('btnSubmitUser').querySelector('span').textContent = 'Simpan';
            const modalEl = document.getElementById('userModal');
            bootstrap.Modal.getOrCreateInstance(modalEl).show();
        }

        /* — Edit modal — */
        function openEditModal(id) {
            document.getElementById('formErrors').style.display = 'none';

            fetch(USERS_URL + '/' + id, {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            })
                .then(r => r.json())
                .then(u => {
                    document.getElementById('userId').value = u.id;
                    document.getElementById('inputNama').value = u.nama;
                    document.getElementById('inputUsername').value = u.username;
                    document.getElementById('inputEmail').value = u.email || '';
                    document.getElementById('inputRole').value = u.role;
                    document.getElementById('inputKodeProdi').value = u.kode_prodi || '';
                    document.getElementById('inputKodeFakultas').value = u.kode_fakultas || '';
                    document.getElementById('inputIsActive').checked = !!u.is_active;
                    document.getElementById('inputPassword').value = '';
                    document.getElementById('inputPasswordConfirm').value = '';
                    document.getElementById('inputPassword').required = false;
                    document.getElementById('inputPasswordConfirm').required = false;
                    document.getElementById('pwdRequired').style.display = 'none';
                    document.getElementById('pwdConfRequired').style.display = 'none';
                    document.getElementById('pwdHint').style.display = '';
                    document.getElementById('userModalTitle').querySelector('span').textContent = 'Edit User Pejabat';
                    document.getElementById('userModalTitle').querySelector('i').className = 'bi bi-pencil-fill';
                    const modalEl = document.getElementById('userModal');
                    bootstrap.Modal.getOrCreateInstance(modalEl).show();
                });
        }

        /* — Submit create/update — */
        function submitUser(e) {
            e.preventDefault();
            const id = document.getElementById('userId').value;
            const isEdit = !!id;
            const url = isEdit ? USERS_URL + '/' + id : USERS_URL;

            const body = {
                nama: document.getElementById('inputNama').value,
                username: document.getElementById('inputUsername').value,
                email: document.getElementById('inputEmail').value || null,
                role: document.getElementById('inputRole').value,
                kode_prodi: document.getElementById('inputKodeProdi').value || null,
                kode_fakultas: document.getElementById('inputKodeFakultas').value || null,
                is_active: document.getElementById('inputIsActive').checked ? 1 : 0,
            };

            const pwd = document.getElementById('inputPassword').value;
            const pwdC = document.getElementById('inputPasswordConfirm').value;
            if (pwd) {
                body.password = pwd;
                body.password_confirmation = pwdC;
            }

            if (isEdit) body._method = 'PUT';

            const btn = document.getElementById('btnSubmitUser');
            btn.disabled = true;
            btn.querySelector('span').textContent = 'Menyimpan...';

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(body),
            })
                .then(async r => {
                    const data = await r.json();
                    if (!r.ok) throw data;
                    return data;
                })
                .then(data => {
                    bootstrap.Modal.getInstance(document.getElementById('userModal')).hide();
                    loadUsers();
                    showToast(data.message || 'Berhasil!', 'success');
                })
                .catch(err => {
                    const errDiv = document.getElementById('formErrors');
                    if (err.errors) {
                        errDiv.innerHTML = Object.values(err.errors).flat().map(e => `• ${e}`).join('<br>');
                    } else {
                        errDiv.innerHTML = err.message || 'Terjadi kesalahan.';
                    }
                    errDiv.style.display = '';
                })
                .finally(() => {
                    btn.disabled = false;
                    btn.querySelector('span').textContent = isEdit ? 'Perbarui' : 'Simpan';
                });
        }

        /* — Delete modal — */
        function openDeleteModal(id, name) {
            document.getElementById('deleteUserId').value = id;
            document.getElementById('deleteUserName').textContent = `"${name}" akan dihapus secara permanen.`;
            const modalEl = document.getElementById('deleteModal');
            bootstrap.Modal.getOrCreateInstance(modalEl).show();
        }

        function confirmDelete() {
            const id = document.getElementById('deleteUserId').value;
            fetch(USERS_URL + '/' + id, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': CSRF, 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
            })
                .then(r => r.json())
                .then(data => {
                    bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide();
                    loadUsers();
                    showToast(data.message || 'User dihapus.', 'danger');
                });
        }

        /* — Toggle status — */
        function toggleUserStatus(id) {
            fetch(USERS_URL + '/' + id + '/toggle', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': CSRF, 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
            })
                .then(r => r.json())
                .then(data => {
                    showToast(data.message || 'Status diperbarui.', data.is_active ? 'success' : 'warning');
                });
        }

        /* — Toast notification — */
        function showToast(msg, type) {
            const colors = { success: 'var(--success)', danger: 'var(--danger)', warning: 'var(--warning)' };
            const icons = { success: 'bi-check-circle-fill', danger: 'bi-x-circle-fill', warning: 'bi-exclamation-circle-fill' };
            const t = document.createElement('div');
            t.style.cssText = `position:fixed;top:20px;right:20px;z-index:9999;background:white;border-radius:14px;padding:0.85rem 1.25rem;box-shadow:0 8px 30px rgba(0,0,0,0.15);display:flex;align-items:center;gap:10px;font-size:0.85rem;font-weight:600;border-left:4px solid ${colors[type] || colors.success};animation:cardIn 0.3s ease;font-family:'Outfit',sans-serif;max-width:380px;`;
            t.innerHTML = `<i class="bi ${icons[type] || icons.success}" style="font-size:1.1rem;color:${colors[type] || colors.success};"></i>${msg}`;
            document.body.appendChild(t);
            setTimeout(() => { t.style.opacity = '0'; t.style.transition = 'opacity 0.3s'; setTimeout(() => t.remove(), 300); }, 3000);
        }
    </script>
</body>

</html>