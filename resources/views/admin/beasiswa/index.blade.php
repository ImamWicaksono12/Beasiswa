<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Program Beasiswa | Admin YARSI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
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
            --card-shadow: 0 10px 15px -3px rgba(0, 0, 0, .1), 0 4px 6px -2px rgba(0, 0, 0, .05);
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--primary-bg);
            color: #1e293b;
            margin: 0;
            overflow-x: hidden;
        }

        /* ---- Sidebar ---- */
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
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 2.5rem;
            padding: .5rem;
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
            box-shadow: 0 4px 12px rgba(59, 130, 246, .3);
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
            letter-spacing: -.5px;
            line-height: 1;
        }

        .nav-section {
            margin-bottom: 2rem;
        }

        .nav-label {
            font-size: .75rem;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: #64748b;
            margin-bottom: 1rem;
            font-weight: 700;
            padding-left: .5rem;
        }

        .nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin-bottom: .5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: .8rem 1rem;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 12px;
            transition: all .2s;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, .05);
            transform: translateX(4px);
        }

        .nav-link.active {
            background: var(--accent-blue);
            color: #fff;
            box-shadow: 0 4px 12px rgba(59, 130, 246, .3);
        }

        .nav-link i {
            font-size: 1.2rem;
        }

        /* ---- Main ---- */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            padding-bottom: 3rem;
        }

        .top-header {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0, 0, 0, .05);
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
            font-size: .875rem;
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
            padding: .5rem 1rem;
            border-radius: 50px;
            background: #fff;
            border: 1px solid #e2e8f0;
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

        .u-name {
            display: block;
            font-weight: 600;
            font-size: .875rem;
        }

        .u-role {
            display: block;
            font-size: .75rem;
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
            transition: all .2s;
        }

        .btn-logout-circle:hover {
            background: var(--accent-danger);
            color: #fff;
            transform: rotate(90deg);
        }

        /* ---- Content ---- */
        .content-body {
            padding: 2.5rem;
        }

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

        .btn-premium {
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-indigo));
            border: none;
            color: #fff;
            padding: .6rem 1.4rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: .875rem;
            transition: all .2s;
            box-shadow: 0 4px 12px rgba(99, 102, 241, .2);
        }

        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(99, 102, 241, .3);
            color: #fff;
        }

        .table-custom {
            margin: 0;
        }

        .table-custom thead th {
            background: #f8fafc;
            border-bottom: 2px solid #f1f5f9;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            font-size: .7rem;
            letter-spacing: .05em;
            padding: 1rem;
        }

        .table-custom tbody td {
            padding: 1rem;
            vertical-align: middle;
            font-size: .9rem;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
        }

        .badge-kategori {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: .72rem;
            font-weight: 600;
        }

        .badge-fully {
            background: #ede9fe;
            color: #6d28d9;
        }

        .badge-partial {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .badge-one {
            background: #fef3c7;
            color: #b45309;
        }

        /* Alert */
        .alert-premium {
            border-radius: 16px;
            border: none;
            padding: 1rem 1.5rem;
            font-size: .9rem;
        }

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

        /* Modal tweaks */
        .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: 0 25px 50px rgba(0, 0, 0, .15);
        }

        .modal-header {
            border-bottom: 1px solid #f1f5f9;
            padding: 1.5rem 2rem;
        }

        .modal-footer {
            border-top: 1px solid #f1f5f9;
            padding: 1rem 2rem;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            font-family: 'Outfit', sans-serif;
            padding: .65rem 1rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, .15);
        }

        .input-group-text {
            border-radius: 10px 0 0 10px;
            border: 1.5px solid #e2e8f0;
            border-right: none;
            background: #f8fafc;
            color: #64748b;
            font-weight: 600;
        }
    </style>
</head>

<body>

    {{-- ====== SIDEBAR ====== --}}
    <aside class="sidebar">
        <div class="brand-logo">
            <div class="brand-logo-icon">
                <img src="{{ asset('images/logo-yarsi.png') }}" alt="Logo YARSI">
            </div>
            <div class="brand-name">
                YARSI<br><span style="font-size:.9rem;font-weight:500;color:#94a3b8;">Scholarship</span>
            </div>
        </div>

        <nav class="nav-section">
            <div class="nav-label">Utama</div>
            <ul class="nav-links">
                <li class="nav-item">
                    <a href="{{ route('dashboard.admin') }}" class="nav-link">
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
                    <a href="{{ route('admin.beasiswa.index') }}" class="nav-link active">
                        <i class="bi bi-award-fill"></i> Program Beasiswa
                    </a>
                </li>
            </ul>
        </nav>

        <nav class="nav-section">
            <div class="nav-label">Proses</div>
            <ul class="nav-links">
                <li class="nav-item">
                    <a href="#" class="nav-link"><i class="bi bi-file-earmark-check-fill"></i> Verifikasi SK</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"><i class="bi bi-activity"></i> Monitoring</a>
                </li>
            </ul>
        </nav>

        <nav class="nav-section" style="margin-top:auto;">
            <div class="nav-label">System</div>
            <ul class="nav-links">
                <li class="nav-item">
                    <a href="#" class="nav-link"><i class="bi bi-journal-text"></i> Laporan</a>
                </li>
            </ul>
        </nav>
    </aside>

    {{-- ====== MAIN ====== --}}
    <main class="main-wrapper">

        <header class="top-header">
            <div class="page-title">
                <h1>Program Beasiswa</h1>
                <p>Kelola seluruh program beasiswa yang tersedia di sistem.</p>
            </div>
            <div class="header-actions">
                <div class="user-profile">
                    <div class="user-avatar">AD</div>
                    <div class="user-info">
                        <span class="u-name">Admin YARSI</span>
                        <span class="u-role">Super Administrator</span>
                    </div>
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

            {{-- Flash messages --}}
            @if (session('success'))
                <div class="alert alert-success alert-premium alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-premium alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <strong>Terdapat kesalahan:</strong>
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- ====== TABEL BEASISWA ====== --}}
            <div class="section-card">
                <div class="section-header">
                    <h2 class="section-title">
                        <i class="bi bi-award-fill text-primary"></i> Daftar Program Beasiswa
                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill ms-2"
                            style="font-size:.75rem;">
                            {{ $beasiswas->count() }} Program
                        </span>
                    </h2>
                    <button class="btn btn-premium" data-bs-toggle="modal" data-bs-target="#modalBeasiswa"
                        onclick="openCreate()">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Beasiswa
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-custom" id="tableBeasiswa">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Program</th>
                                <th>Sumber Dana</th>
                                <th>Nominal</th>
                                <th>Kategori</th>
                                <th>Link Eksternal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($beasiswas as $i => $b)
                                <tr id="row-{{ $b->id }}">
                                    <td class="text-muted fw-500">{{ $i + 1 }}</td>
                                    <td><strong>{{ $b->nama_beasiswa }}</strong></td>
                                    <td>{{ $b->sumber_dana }}</td>
                                    <td class="fw-600" style="color:#0f172a;">{{ $b->nominal_rupiah }}</td>
                                    <td>
                                        @if ($b->kategori_dana === 'fully_funded')
                                            <span class="badge-kategori badge-fully">Fully Funded</span>
                                        @elseif($b->kategori_dana === 'partially_funded')
                                            <span class="badge-kategori badge-partial">Partially Funded</span>
                                        @else
                                            <span class="badge-kategori badge-one">One Shoot</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($b->link_pendaftaran_luar)
                                            <a href="{{ $b->link_pendaftaran_luar }}" target="_blank"
                                                class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                                                <i class="bi bi-box-arrow-up-right me-1"></i>Link
                                            </a>
                                        @else
                                            <span class="text-muted small">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="form-check form-switch" style="transform:scale(1.1);">
                                            <input class="form-check-input toggle-status" type="checkbox"
                                                data-id="{{ $b->id }}" id="toggle-{{ $b->id }}"
                                                {{ $b->is_active ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-light btn-sm rounded-pill px-3 border"
                                                onclick="openEdit({{ $b->id }}, '{{ addslashes($b->nama_beasiswa) }}', '{{ addslashes($b->sumber_dana) }}', {{ $b->nominal }}, '{{ $b->kategori_dana }}', '{{ $b->link_pendaftaran_luar }}', {{ $b->is_active ? 'true' : 'false' }})"
                                                data-bs-toggle="modal" data-bs-target="#modalBeasiswa">
                                                <i class="bi bi-pencil-fill me-1"></i>Edit
                                            </button>
                                            <button class="btn btn-sm rounded-pill px-3 border text-danger btn-light"
                                                onclick="confirmDelete({{ $b->id }}, '{{ addslashes($b->nama_beasiswa) }}')"
                                                data-bs-toggle="modal" data-bs-target="#modalDelete">
                                                <i class="bi bi-trash-fill me-1"></i>Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center gap-3"
                                            style="color:#94a3b8;">
                                            <i class="bi bi-inbox" style="font-size:3rem;"></i>
                                            <span>Belum ada program beasiswa. Klik <strong>Tambah Beasiswa</strong>
                                                untuk mulai.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>{{-- /content-body --}}
    </main>

    {{-- ====== MODAL CREATE / EDIT ====== --}}
    <div class="modal fade" id="modalBeasiswa" tabindex="-1" aria-labelledby="modalBeasiswaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form id="formBeasiswa" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">

                    <div class="modal-header">
                        <h5 class="modal-title fw-700" id="modalBeasiswaLabel">
                            <i class="bi bi-award-fill text-primary me-2"></i>
                            <span id="modalBeasiswaTitle">Tambah Program Beasiswa</span>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-600 small text-uppercase">Nama Program Beasiswa <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama_beasiswa" id="field_nama"
                                    placeholder="Contoh: Beasiswa Prestasi Akademik" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-600 small text-uppercase">Sumber Dana <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="sumber_dana" id="field_sumber"
                                    placeholder="Contoh: Yayasan YARSI" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-600 small text-uppercase">Nominal (Rp) <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" name="nominal" id="field_nominal"
                                        placeholder="0" min="0" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-600 small text-uppercase">Kategori Dana <span
                                        class="text-danger">*</span></label>
                                <select class="form-select" name="kategori_dana" id="field_kategori" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="fully_funded">Fully Funded</option>
                                    <option value="partially_funded">Partially Funded</option>
                                    <option value="one_shoot">One Shoot</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-600 small text-uppercase">Link Pendaftaran Luar</label>
                                <input type="url" class="form-control" name="link_pendaftaran_luar"
                                    id="field_link" placeholder="https://...">
                            </div>
                            <div class="col-12">
                                <div
                                    class="form-check form-switch d-flex align-items-center gap-3 p-3 rounded-3 bg-light">
                                    <input class="form-check-input" type="checkbox" name="is_active"
                                        id="field_active" role="switch" style="width:2.5em;height:1.4em;" checked>
                                    <div>
                                        <label class="form-check-label fw-600 mb-0" for="field_active">Status
                                            Aktif</label>
                                        <p class="text-muted small mb-0">Program aktif akan tampil kepada mahasiswa.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light rounded-pill px-4"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-premium rounded-pill px-4">
                            <i class="bi bi-save-fill me-1"></i> <span id="btnSubmitText">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ====== MODAL DELETE ====== --}}
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-700 text-danger"><i
                            class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body px-4 pb-0">
                    <p>Anda yakin ingin menghapus program <strong id="deleteNama"></strong>?</p>
                    <p class="text-muted small">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill px-4"
                        data-bs-dismiss="modal">Batal</button>
                    <form id="formDelete" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger rounded-pill px-4">
                            <i class="bi bi-trash-fill me-1"></i> Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const routeStore = "{{ route('admin.beasiswa.store') }}";
        const routeUpdate = (id) => `/dashboard/admin/beasiswa/${id}`;
        const routeDelete = (id) => `/dashboard/admin/beasiswa/${id}`;
        const routeToggle = (id) => `/dashboard/admin/beasiswa/${id}/toggle`;

        function openCreate() {
            document.getElementById('modalBeasiswaTitle').textContent = 'Tambah Program Beasiswa';
            document.getElementById('btnSubmitText').textContent = 'Simpan';
            document.getElementById('formBeasiswa').action = routeStore;
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('field_nama').value = '';
            document.getElementById('field_sumber').value = '';
            document.getElementById('field_nominal').value = '';
            document.getElementById('field_kategori').value = '';
            document.getElementById('field_link').value = '';
            document.getElementById('field_active').checked = true;
        }

        function openEdit(id, nama, sumber, nominal, kategori, link, isActive) {
            document.getElementById('modalBeasiswaTitle').textContent = 'Edit Program Beasiswa';
            document.getElementById('btnSubmitText').textContent = 'Perbarui';
            document.getElementById('formBeasiswa').action = routeUpdate(id);
            document.getElementById('formMethod').value = 'PUT';
            document.getElementById('field_nama').value = nama;
            document.getElementById('field_sumber').value = sumber;
            document.getElementById('field_nominal').value = nominal;
            document.getElementById('field_kategori').value = kategori;
            document.getElementById('field_link').value = link === 'null' ? '' : link;
            document.getElementById('field_active').checked = isActive;
        }

        function confirmDelete(id, nama) {
            document.getElementById('deleteNama').textContent = nama;
            document.getElementById('formDelete').action = routeDelete(id);
        }

        // Toggle status via AJAX
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-status').forEach(function(toggle) {
                toggle.addEventListener('change', function() {
                    const id = this.dataset.id;
                    fetch(routeToggle(id), {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content,
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                            }
                        })
                        .then(r => r.json())
                        .then(data => {
                            if (!data.success) this.checked = !this.checked;
                        })
                        .catch(() => {
                            this.checked = !this.checked;
                        });
                });
            });
        });
    </script>
</body>

</html>
