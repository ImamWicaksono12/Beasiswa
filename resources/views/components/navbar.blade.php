<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top py-3">
    <div class="container">
        <!-- Navbar Brand -->
        <a class="navbar-brand fw-bold text-primary d-flex align-items-center gap-2" href="{{ url('/') }}">
            <img src="{{ asset('images/logo-yarsi-ta.png') }}" alt="Universitas Yarsi" height="60">
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active fw-bold text-primary' : 'text-dark' }} px-3"
                        aria-current="page" href="{{ url('/') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('program-beasiswa') ? 'active fw-bold text-primary' : 'text-dark' }} px-3"
                        href="{{ route('guest.programs') }}">Program Beasiswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('faq') ? 'active fw-bold text-primary' : 'text-dark' }} px-3"
                        href="{{ route('guest.faq') }}">Panduan & FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('pengumuman') ? 'active fw-bold text-primary' : 'text-dark' }} px-3"
                        href="{{ route('guest.announcements') }}">Pengumuman</a>
                </li>
            </ul>

            <!-- Navbar Actions -->
            <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                <a href="{{ route('login') }}" class="btn btn-primary px-4 rounded-pill shadow-sm">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                </a>
            </div>
        </div>
    </div>
</nav>