<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Mahasiswa') | Sistem Beasiswa YARSI</title>
    
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 280px;
            --primary-bg: #f8fafc;
            --sidebar-color: #ffffff;
            --accent-blue: #2563eb;
            --accent-indigo: #4f46e5;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
            --sidebar-shadow: 10px 0 30px rgba(0,0,0,0.02);
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--primary-bg);
            color: var(--text-main);
            margin: 0;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-color);
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            border-right: 1px solid #f1f5f9;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            box-shadow: var(--sidebar-shadow);
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 2.5rem;
            padding: 0.5rem;
        }

        .brand-logo-icon {
            width: 42px; height: 42px;
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-indigo));
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.6rem; color: #fff;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.2);
        }

        .brand-name { font-weight: 800; font-size: 1.25rem; letter-spacing: -0.5px; line-height: 1.1; color: #0f172a; }

        .nav-label { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.12em; color: #94a3b8; margin-bottom: 1rem; font-weight: 700; padding-left: 0.75rem; }
        .nav-links { list-style: none; padding: 0; margin: 0; }
        .nav-item { margin-bottom: 0.4rem; }
        .nav-link { display: flex; align-items: center; gap: 12px; padding: 0.85rem 1rem; color: #64748b; text-decoration: none; border-radius: 14px; transition: all 0.2s; font-weight: 500; font-size: 0.95rem; }
        .nav-link:hover { color: var(--accent-blue); background: #f1f5f9; transform: translateX(5px); }
        .nav-link.active { background: #eff6ff; color: var(--accent-blue); font-weight: 700; }
        .nav-link i { font-size: 1.25rem; }

        .main-wrapper { margin-left: var(--sidebar-width); min-height: 100vh; padding-bottom: 3rem; }

        .top-header { border-bottom: 1px solid #f1f5f9; padding: 1rem 2.5rem; background: #fff; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 900; }
        
        .profile-trigger { display: flex; align-items: center; gap: 12px; cursor: pointer; padding: 6px 12px; border-radius: 50px; background: #f8fafc; border: 1px solid #f1f5f9; transition: all 0.2s; }
        .profile-trigger:hover { background: #f1f5f9; border-color: var(--accent-blue); }
        .user-avatar-circle { width: 32px; height: 32px; border-radius: 50%; background: var(--accent-blue); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8rem; }

        .content-body { padding: 2.5rem; }

        @stack('styles')
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="brand-logo">
            <div class="brand-logo-icon"><i class="bi bi-mortarboard-fill"></i></div>
            <div class="brand-name">YARSI<br><span style="font-size: 0.85rem; font-weight: 500; color: #64748b;">Beasiswa Hub</span></div>
        </div>

        <nav class="flex-grow-1">
            <div class="nav-label">Menu</div>
            <ul class="nav-links">
                <li class="nav-item">
                    <a href="{{ route('dashboard.mahasiswa') }}" class="nav-link {{ request()->routeIs('dashboard.mahasiswa') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mahasiswa.katalog') }}" class="nav-link {{ request()->routeIs('mahasiswa.katalog') ? 'active' : '' }}">
                        <i class="bi bi-search-heart-fill"></i> Katalog Beasiswa
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mahasiswa.pengajuan') }}" class="nav-link {{ request()->routeIs('mahasiswa.pengajuan') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-plus-fill"></i> Pengajuan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mahasiswa.riwayat') }}" class="nav-link {{ request()->routeIs('mahasiswa.riwayat') ? 'active' : '' }}">
                        <i class="bi bi-clock-history"></i> Riwayat
                    </a>
                </li>
            </ul>

            <div class="nav-label mt-4">Personal</div>
            <ul class="nav-links">
                <li class="nav-item">
                    <a href="{{ route('mahasiswa.profil') }}" class="nav-link {{ request()->routeIs('mahasiswa.profil') ? 'active' : '' }}">
                        <i class="bi bi-person-fill-gear"></i> Profil Saya
                    </a>
                </li>
            </ul>
        </nav>

        <div class="mt-auto">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link w-100 border-0 bg-transparent text-danger">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <main class="main-wrapper">
        <header class="top-header">
            <div class="header-breadcrumb">
                <h5 class="mb-0 fw-bold">@yield('page_title', 'Dashboard')</h5>
            </div>

            <div class="header-actions">
                <div class="profile-trigger">
                    <div class="user-avatar-circle">AF</div>
                    <div class="d-none d-md-block ms-2 text-start">
                        <div style="font-weight: 700; font-size: 0.8rem; line-height: 1;">Ahmad Fauzi</div>
                        <div style="font-size: 0.7rem; color: #64748b;">Mahasiswa TI</div>
                    </div>
                </div>
            </div>
        </header>

        <div class="content-body">
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
