<footer class="bg-dark text-light py-5 mt-auto">
    <div class="container">
        <div class="row gy-4 justify-content-center">
            <!-- Brand & Description -->
            <div class="col-lg-4 col-md-6 pe-lg-5">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <img src="{{ asset('images/logo yarsi.png') }}" alt="Logo Yarsi" class="rounded" height="90">
                </div>
                <p class="text-secondary mb-4">Sistem Informasi Manajemen Beasiswa Universitas YARSI. Mendukung
                    pendidikan berkelanjutan dan mewujudkan generasi berprestasi.</p>
            </div>

            <!-- Tautan Cepat -->
            <div class="col-lg-2 col-md-6">
                <h5 class="fw-bold mb-4 text-white">Tautan</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Beranda</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Program
                            Beasiswa</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Panduan & FAQ</a>
                    </li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Pengumuman</a></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="col-lg-3 col-md-6 text-secondary">
                <h5 class="fw-bold mb-4 text-white">Hubungi Kami</h5>
                <div class="d-flex mb-3">
                    <i class="bi bi-geo-alt-fill me-3 mt-1 text-primary"></i>
                    <div>
                        <strong>Panitia Beasiswa YARSI</strong><br>
                        Jl. Letjen Suprapto, Cempaka Putih,<br>
                        Jakarta Pusat 10510
                    </div>
                </div>
                <div class="d-flex mb-3 align-items-center">
                    <i class="bi bi-telephone-fill me-3 text-primary"></i>
                    <span>+62 21 420 6674</span>
                </div>
                <div class="d-flex align-items-center">
                    <i class="bi bi-envelope-fill me-3 text-primary"></i>
                    <span>beasiswa@yarsi.ac.id</span>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <hr class="border-secondary my-4">
        <div class="row text-secondary align-items-center">
            <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                <small>&copy; {{ date('Y') }} Universitas YARSI. Semua Hak Cipta Dilindungi.</small>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <small>
                    <a href="#" class="text-secondary text-decoration-none me-3">Kebijakan Privasi</a>
                    <a href="#" class="text-secondary text-decoration-none">Syarat & Ketentuan</a>
                </small>
            </div>
        </div>
    </div>
</footer>
<style>
    /* Utilities Hover Footer */
    footer .text-secondary {
        transition: color 0.3s;
    }

    footer a.text-secondary:hover {
        color: #fff !important;
    }

    footer .btn-outline-secondary:hover {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
    }
</style>