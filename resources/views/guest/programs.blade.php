@extends('layouts.app')

@push('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

        body {
            font-family: 'Inter', system-ui, sans-serif;
        }

        /* ═══ Hero ═══ */
        .prog-hero {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 55%, #1d4ed8 100%);
            padding: 80px 0 60px;
            position: relative;
            overflow: hidden;
        }

        .prog-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle at 70% 25%, rgba(99, 102, 241, .18) 0%, transparent 55%),
                radial-gradient(circle at 20% 80%, rgba(59, 130, 246, .12) 0%, transparent 45%);
            pointer-events: none;
        }

        .prog-hero .dot-grid {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(255, 255, 255, .05) 1px, transparent 1px);
            background-size: 28px 28px;
            pointer-events: none;
        }

        /* ═══ Badges ═══ */
        .bdg {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            border-radius: 50px;
            padding: 4px 12px;
            font-size: .73rem;
            font-weight: 700;
        }

        .bdg-green {
            background: #dcfce7;
            color: #15803d;
        }

        .bdg-amber {
            background: #fef3c7;
            color: #b45309;
        }

        .bdg-red {
            background: #fee2e2;
            color: #991b1b;
        }

        .bdg-blue {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .bdg-purple {
            background: #ede9fe;
            color: #7c3aed;
        }

        .bdg-slate {
            background: #f1f5f9;
            color: #475569;
        }

        .bdg-white {
            background: rgba(255, 255, 255, .18);
            color: #fff;
        }

        .bdg-pulse::before {
            content: '';
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
            animation: pulse-dot 1.5s infinite;
        }

        @keyframes pulse-dot {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: .3
            }
        }

        /* ═══ Section ═══ */
        .sec-label {
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #1d4ed8;
            margin-bottom: 6px;
        }

        .sec-title {
            font-size: clamp(1.4rem, 2.5vw, 1.9rem);
            font-weight: 800;
            color: #0f172a;
            line-height: 1.25;
        }

        /* ═══ Program Card ═══ */
        .program-card {
            background: #fff;
            border: 1px solid #e8edf5;
            border-radius: 22px;
            overflow: hidden;
            margin-bottom: 40px;
            transition: box-shadow .3s;
        }

        .program-card:hover {
            box-shadow: 0 20px 50px rgba(29, 78, 216, .08);
        }

        .pc-header {
            padding: 28px 32px 24px;
            border-bottom: 1px solid #f1f5f9;
            position: relative;
        }

        .pc-header .accent-bar {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
        }

        .pc-identity {
            display: flex;
            align-items: flex-start;
            gap: 18px;
            flex-wrap: wrap;
        }

        .pc-icon-wrap {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            flex-shrink: 0;
        }

        .pc-name {
            font-size: 1.35rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .pc-sponsor {
            font-size: .82rem;
            color: #64748b;
        }

        .pc-body {
            padding: 28px 32px;
        }

        /* ─── Detail Stats Grid ─── */
        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
            margin-bottom: 24px;
        }

        .detail-cell {
            background: #f8faff;
            border: 1px solid #eef2ff;
            border-radius: 14px;
            padding: 16px;
            text-align: center;
        }

        .dc-val {
            font-size: 1.25rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 4px;
        }

        .dc-lbl {
            font-size: .72rem;
            color: #64748b;
        }

        /* ─── Coverage List ─── */
        .coverage-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 8px;
        }

        .coverage-list li {
            font-size: .84rem;
            color: #374151;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 10px;
            background: #f8faff;
            border: 1px solid #eef2ff;
        }

        .coverage-list li i {
            color: #1d4ed8;
            flex-shrink: 0;
        }

        /* ─── Accordion Premium ─── */
        .acc-premium .accordion-item {
            border: 1px solid #e8edf5 !important;
            border-radius: 14px !important;
            margin-bottom: 10px;
            overflow: hidden;
            transition: box-shadow .2s;
        }

        .acc-premium .accordion-item:hover {
            box-shadow: 0 4px 16px rgba(29, 78, 216, .06);
        }

        .acc-premium .accordion-button {
            font-weight: 700;
            font-size: .9rem;
            color: #0f172a !important;
            background: #fff !important;
            border-radius: 14px !important;
            padding: 16px 20px;
            box-shadow: none !important;
        }

        .acc-premium .accordion-button:not(.collapsed) {
            color: #1d4ed8 !important;
            background: #f8faff !important;
        }

        .acc-premium .accordion-button::after {
            filter: none;
        }

        .acc-premium .accordion-button:not(.collapsed)::after {
            filter: invert(30%) sepia(90%) saturate(600%) hue-rotate(200deg);
        }

        .acc-premium .accordion-body {
            font-size: .85rem;
            color: #4b5563;
            line-height: 1.75;
            padding: 0 20px 18px;
            background: #f8faff;
        }

        .acc-premium .accordion-body ul {
            padding-left: 1.2rem;
            margin-bottom: 0;
        }

        .acc-premium .accordion-body li {
            margin-bottom: 6px;
        }

        /* ─── Alur Step inside accordion ─── */
        .alur-step {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 12px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .alur-step:last-child {
            border-bottom: none;
        }

        .alur-num {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .75rem;
            font-weight: 800;
            color: #fff;
            flex-shrink: 0;
        }

        .alur-title {
            font-weight: 700;
            font-size: .85rem;
            color: #0f172a;
            margin-bottom: 2px;
        }

        .alur-desc {
            font-size: .8rem;
            color: #64748b;
            line-height: 1.6;
            margin: 0;
        }

        /* ─── Doc Chips ─── */
        .doc-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f8faff;
            border: 1px solid #e0e9ff;
            border-radius: 10px;
            padding: 8px 14px;
            font-size: .8rem;
            font-weight: 600;
            color: #374151;
            transition: all .2s;
        }

        .doc-chip:hover {
            background: #dbeafe;
            border-color: #93c5fd;
        }

        .doc-chip i {
            color: #1d4ed8;
        }

        /* ═══ Compare Table ═══ */
        .compare-table {
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid #e8edf5;
        }

        .compare-table thead th {
            background: #0f172a;
            color: #fff;
            font-size: .8rem;
            font-weight: 700;
            padding: 14px 18px;
            border: none;
            text-align: center;
            letter-spacing: .3px;
        }

        .compare-table thead th:first-child {
            text-align: left;
            background: #1e293b;
        }

        .compare-table tbody td {
            padding: 14px 18px;
            font-size: .83rem;
            color: #374151;
            text-align: center;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .compare-table tbody td:first-child {
            text-align: left;
            font-weight: 600;
            color: #0f172a;
        }

        .compare-table tbody tr:last-child td {
            border-bottom: none;
        }

        .compare-table tbody tr:hover {
            background: #f8faff;
        }

        .check-yes {
            color: #16a34a;
            font-size: 1.1rem;
        }

        .check-no {
            color: #dc2626;
            font-size: 1.1rem;
        }

        .check-partial {
            color: #f59e0b;
            font-size: 1.1rem;
        }

        /* ═══ CTA ═══ */
        .btn-cta-primary {
            background: linear-gradient(135deg, #1d4ed8, #0a58ca);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 700;
            font-size: .9rem;
            transition: all .25s;
            box-shadow: 0 4px 14px rgba(29, 78, 216, .3);
        }

        .btn-cta-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(29, 78, 216, .4);
            color: #fff;
        }

        /* ═══ Fade animation ═══ */
        .fade-up {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity .55s ease, transform .55s ease;
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @media(max-width:767.98px) {

            .pc-header,
            .pc-body {
                padding: 20px;
            }

            .detail-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
@endpush

@section('content')

    {{-- ══════════ HERO ══════════ --}}
    <section class="prog-hero">
        <div class="dot-grid"></div>
        <div class="container position-relative text-white">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <span class="bdg bdg-white bdg-pulse mb-3"><i class="bi bi-collection-fill"></i> Program Beasiswa</span>
                    <h1 class="fw-bolder mb-3" style="font-size:clamp(1.8rem,4vw,2.8rem);line-height:1.2">
                        Program Beasiswa<br>Universitas YARSI
                    </h1>
                    <p class="mb-0" style="color:rgba(255,255,255,.75);font-size:1rem;max-width:560px;line-height:1.75">
                        Pelajari secara detail setiap jenis beasiswa yang tersedia — mulai dari
                        identitas program, rincian bantuan, persyaratan, alur pendaftaran, hingga dokumen pendukung.
                    </p>
                </div>
                <div class="col-lg-4">
                    <div class="d-flex gap-3 justify-content-lg-end flex-wrap">
                        <div class="text-center px-3 py-3 rounded-4"
                            style="background:rgba(255,255,255,.1);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.15)">
                            <div class="fw-black" style="font-size:2rem;line-height:1">3</div>
                            <div style="font-size:.72rem;opacity:.75">Jenis Program</div>
                        </div>
                        <div class="text-center px-3 py-3 rounded-4"
                            style="background:rgba(255,255,255,.1);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.15)">
                            <div class="fw-black" style="font-size:2rem;line-height:1">175</div>
                            <div style="font-size:.72rem;opacity:.75">Total Kuota</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════ MAIN CONTENT ══════════ --}}
    <section class="py-5" style="background:#f8faff">
        <div class="container py-2">

            {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
            CARD 1 — FULL FUNDED
            ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
            <div class="program-card fade-up">
                <div class="pc-header">
                    <div class="accent-bar" style="background:linear-gradient(90deg,#1d4ed8,#6366f1)"></div>
                    <div class="pc-identity">
                        <div class="pc-icon-wrap" style="background:#dbeafe;color:#1d4ed8"><i class="bi bi-trophy-fill"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                                <h2 class="pc-name mb-0">Beasiswa Kartu Indonesia Pintar</h2>
                                <span class="bdg bdg-green bdg-pulse"><i class="bi bi-broadcast"></i> Sedang Dibuka</span>
                            </div>
                            <div class="pc-sponsor">
                                <i class="bi bi-building me-1"></i>Dikti / KIP Kuliah / Yayasan YARSI
                                <span class="mx-2 text-muted">•</span>
                                <span class="bdg bdg-blue" style="padding:2px 8px;font-size:.65rem"><i
                                        class="bi bi-star-fill"></i> Paling Diminati</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pc-body">
                    <p style="font-size:.9rem;color:#4b5563;line-height:1.75;max-width:700px">
                        Beasiswa Full Funded menanggung <strong>seluruh biaya pendidikan</strong> mahasiswa selama masa
                        studi aktif,
                        termasuk UKT, tunjangan hidup bulanan, dan biaya penunjang akademik. Program ini diberikan
                        secara berkelanjutan setiap semester dengan evaluasi berkala.
                    </p>

                    {{-- Detail Stats --}}
                    <div class="detail-grid">
                        <div class="detail-cell">
                            <div class="dc-val" style="color:#1d4ed8">100%</div>
                            <div class="dc-lbl">Cakupan UKT</div>
                        </div>
                        <div class="detail-cell">
                            <div class="dc-val" style="color:#15803d">100</div>
                            <div class="dc-lbl">Kuota / Semester</div>
                        </div>
                        <div class="detail-cell">
                            <div class="dc-val" style="color:#7c3aed">8</div>
                            <div class="dc-lbl">Maks. Semester</div>
                        </div>
                        <div class="detail-cell">
                            <div class="dc-val" style="color:#f59e0b">3.00</div>
                            <div class="dc-lbl">IPK Minimal</div>
                        </div>
                        <div class="detail-cell">
                            <div class="dc-val" style="color:#dc2626">30 Apr</div>
                            <div class="dc-lbl">Deadline 2025</div>
                        </div>
                    </div>

                    {{-- Rincian Bantuan --}}
                    <h6 class="fw-bold mb-3" style="font-size:.9rem;color:#0f172a">
                        <i class="bi bi-gift-fill text-primary me-2"></i>Rincian Bantuan yang Diberikan
                    </h6>
                    <ul class="coverage-list mb-4">
                        <li><i class="bi bi-check-circle-fill"></i> Biaya kuliah (UKT) 100%</li>
                        <li><i class="bi bi-check-circle-fill"></i> Tunjangan hidup bulanan</li>
                        <li><i class="bi bi-check-circle-fill"></i> Biaya buku & alat tulis</li>
                        <li><i class="bi bi-check-circle-fill"></i> Biaya penelitian / skripsi</li>
                        <li><i class="bi bi-check-circle-fill"></i> Asuransi kesehatan</li>
                        <li><i class="bi bi-check-circle-fill"></i> Berlaku s.d. lulus tepat waktu</li>
                    </ul>

                    {{-- Accordion: Persyaratan & Alur --}}
                    <div class="accordion acc-premium" id="accFull">

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#fullReq">
                                    <i class="bi bi-clipboard-check-fill text-primary me-2"></i>Persyaratan Pendaftaran
                                </button>
                            </h2>
                            <div id="fullReq" class="accordion-collapse collapse" data-bs-parent="#accFull">
                                <div class="accordion-body">
                                    <ul>
                                        <li>Mahasiswa aktif Universitas YARSI (S1/D3) minimal semester 2</li>
                                        <li>IPK kumulatif minimal <strong>3.00</strong> dari 4.00</li>
                                        <li><strong>Tidak sedang</strong> menerima beasiswa penuh dari lembaga lain</li>
                                        <li>Memiliki Surat Keputusan (SK) penerimaan dari pemberi beasiswa eksternal</li>
                                        <li>Tidak memiliki tunggakan administrasi di Universitas YARSI</li>
                                        <li>Bersedia mematuhi semua ketentuan yang ditetapkan pemberi beasiswa</li>
                                        <li>Berkelakuan baik dan tidak pernah menerima sanksi akademik</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#fullAlur">
                                    <i class="bi bi-diagram-3-fill text-primary me-2"></i>Alur Pendaftaran
                                </button>
                            </h2>
                            <div id="fullAlur" class="accordion-collapse collapse" data-bs-parent="#accFull">
                                <div class="accordion-body">
                                    <div class="alur-step">
                                        <div class="alur-num" style="background:#1d4ed8">1</div>
                                        <div>
                                            <div class="alur-title">Pendaftaran Eksternal</div>
                                            <p class="alur-desc">Daftarkan diri ke program beasiswa eksternal (Dikti, KIP,
                                                dll.) sesuai syarat masing-masing.</p>
                                        </div>
                                    </div>
                                    <div class="alur-step">
                                        <div class="alur-num" style="background:#6366f1">2</div>
                                        <div>
                                            <div class="alur-title">Unggah SK ke Sistem</div>
                                            <p class="alur-desc">Setelah dinyatakan lolos, unggah Surat Keputusan (SK)
                                                penerima ke sistem beasiswa YARSI.</p>
                                        </div>
                                    </div>
                                    <div class="alur-step">
                                        <div class="alur-num" style="background:#7c3aed">3</div>
                                        <div>
                                            <div class="alur-title">Validasi Kaprodi</div>
                                            <p class="alur-desc">Kaprodi memeriksa kelengkapan data dan kesesuaian akademik
                                                mahasiswa.</p>
                                        </div>
                                    </div>
                                    <div class="alur-step">
                                        <div class="alur-num" style="background:#16a34a">4</div>
                                        <div>
                                            <div class="alur-title">Verifikasi Admin</div>
                                            <p class="alur-desc">Admin pusat melakukan verifikasi akhir keaslian dokumen dan
                                                kesesuaian data sistem.</p>
                                        </div>
                                    </div>
                                    <div class="alur-step">
                                        <div class="alur-num" style="background:#0e7490">5</div>
                                        <div>
                                            <div class="alur-title">Persetujuan Warek</div>
                                            <p class="alur-desc">Wakil Rektor / Kepala Pusat memberikan persetujuan final
                                                dan menetapkan status.</p>
                                        </div>
                                    </div>
                                    <div class="alur-step">
                                        <div class="alur-num" style="background:#b45309">6</div>
                                        <div>
                                            <div class="alur-title">Status Aktif</div>
                                            <p class="alur-desc">Beasiswa dikonfirmasi aktif dan mahasiswa menerima
                                                notifikasi resmi melalui sistem.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#fullDoc">
                                    <i class="bi bi-folder-fill text-primary me-2"></i>Dokumen Pendukung
                                </button>
                            </h2>
                            <div id="fullDoc" class="accordion-collapse collapse" data-bs-parent="#accFull">
                                <div class="accordion-body">
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="doc-chip"><i class="bi bi-file-earmark-pdf-fill"></i> Surat Keputusan
                                            (SK)</span>
                                        <span class="doc-chip"><i class="bi bi-file-earmark-text-fill"></i> Transkrip
                                            Nilai</span>
                                        <span class="doc-chip"><i class="bi bi-person-badge-fill"></i> KTM Aktif</span>
                                        <span class="doc-chip"><i class="bi bi-file-earmark-check-fill"></i> Surat Aktif
                                            Kuliah</span>
                                        <span class="doc-chip"><i class="bi bi-file-earmark-medical-fill"></i> SKTM / Surat
                                            Keterangan</span>
                                        <span class="doc-chip"><i class="bi bi-image-fill"></i> Pas Foto 3×4</span>
                                    </div>
                                    <div class="mt-3 p-3 rounded-3"
                                        style="background:#fffbeb;border:1px solid #fde68a;font-size:.8rem;color:#92400e">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                        Semua file harus berformat <strong>PDF</strong> dengan ukuran maksimal <strong>5
                                            MB</strong> per file.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-3 flex-wrap">
                        <a href="{{ route('login') }}" class="btn-cta-primary"><i
                                class="bi bi-box-arrow-in-right me-2"></i>Daftar Sekarang</a>
                        <a href="{{ route('guest.faq') }}" class="btn btn-outline-secondary rounded-3 fw-semibold"
                            style="font-size:.88rem"><i class="bi bi-question-circle me-1"></i>Lihat FAQ</a>
                    </div>
                </div>
            </div>

            {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
            CARD 2 — PARTIALLY FUNDED
            ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
            <div class="program-card fade-up">
                <div class="pc-header">
                    <div class="accent-bar" style="background:linear-gradient(90deg,#7c3aed,#a855f7)"></div>
                    <div class="pc-identity">
                        <div class="pc-icon-wrap" style="background:#ede9fe;color:#7c3aed"><i class="bi bi-award-fill"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                                <h2 class="pc-name mb-0">Beasiswa Partially Funded</h2>
                                <span class="bdg bdg-green bdg-pulse"><i class="bi bi-broadcast"></i> Sedang Dibuka</span>
                            </div>
                            <div class="pc-sponsor">
                                <i class="bi bi-building me-1"></i>Yayasan YARSI / Mitra Kerja Sama
                                <span class="mx-2 text-muted">•</span>
                                <span class="bdg bdg-purple" style="padding:2px 8px;font-size:.65rem"><i
                                        class="bi bi-graph-up-arrow"></i> Populer</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pc-body">
                    <p style="font-size:.9rem;color:#4b5563;line-height:1.75;max-width:700px">
                        Beasiswa Partially Funded memberikan <strong>bantuan sebagian biaya pendidikan</strong>, misalnya
                        potongan UKT 25–75% atau subsidi komponen tertentu. Cocok bagi mahasiswa berprestasi yang
                        ingin meringankan beban biaya kuliah.
                    </p>

                    <div class="detail-grid">
                        <div class="detail-cell">
                            <div class="dc-val" style="color:#7c3aed">25–75%</div>
                            <div class="dc-lbl">Cakupan UKT</div>
                        </div>
                        <div class="detail-cell">
                            <div class="dc-val" style="color:#15803d">50</div>
                            <div class="dc-lbl">Kuota / Semester</div>
                        </div>
                        <div class="detail-cell">
                            <div class="dc-val" style="color:#1d4ed8">8</div>
                            <div class="dc-lbl">Maks. Semester</div>
                        </div>
                        <div class="detail-cell">
                            <div class="dc-val" style="color:#f59e0b">3.25</div>
                            <div class="dc-lbl">IPK Minimal</div>
                        </div>
                        <div class="detail-cell">
                            <div class="dc-val" style="color:#dc2626">15 Mei</div>
                            <div class="dc-lbl">Deadline 2025</div>
                        </div>
                    </div>

                    <h6 class="fw-bold mb-3" style="font-size:.9rem;color:#0f172a">
                        <i class="bi bi-gift-fill text-primary me-2"></i>Rincian Bantuan yang Diberikan
                    </h6>
                    <ul class="coverage-list mb-4">
                        <li><i class="bi bi-check-circle-fill"></i> Subsidi UKT 25–75%</li>
                        <li><i class="bi bi-check-circle-fill"></i> Bantuan biaya pendidikan</li>
                        <li><i class="bi bi-check-circle-fill"></i> Perpanjangan per semester</li>
                        <li><i class="bi bi-check-circle-fill"></i> Evaluasi berkala IPK</li>
                    </ul>

                    <div class="accordion acc-premium" id="accPartial">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#partReq">
                                    <i class="bi bi-clipboard-check-fill text-primary me-2"></i>Persyaratan Pendaftaran
                                </button>
                            </h2>
                            <div id="partReq" class="accordion-collapse collapse" data-bs-parent="#accPartial">
                                <div class="accordion-body">
                                    <ul>
                                        <li>Mahasiswa aktif Universitas YARSI minimal semester 2</li>
                                        <li>IPK kumulatif minimal <strong>3.25</strong> dari 4.00</li>
                                        <li>Boleh menerima beasiswa lain <em>selama tidak bertumpang tindih</em> pada
                                            komponen biaya yang sama</li>
                                        <li>Memiliki rekomendasi dari Dosen Pembimbing Akademik</li>
                                        <li>Tidak memiliki tunggakan administrasi</li>
                                        <li>Aktif dalam kegiatan kemahasiswaan (nilai plus)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#partAlur">
                                    <i class="bi bi-diagram-3-fill text-primary me-2"></i>Alur Pendaftaran
                                </button>
                            </h2>
                            <div id="partAlur" class="accordion-collapse collapse" data-bs-parent="#accPartial">
                                <div class="accordion-body">
                                    <div class="alur-step">
                                        <div class="alur-num" style="background:#7c3aed">1</div>
                                        <div>
                                            <div class="alur-title">Pendaftaran Internal / Eksternal</div>
                                            <p class="alur-desc">Daftarkan diri melalui sistem YARSI atau melalui mitra
                                                beasiswa yang bekerja sama.</p>
                                        </div>
                                    </div>
                                    <div class="alur-step">
                                        <div class="alur-num" style="background:#8b5cf6">2</div>
                                        <div>
                                            <div class="alur-title">Unggah Berkas Pendukung</div>
                                            <p class="alur-desc">Upload transkrip nilai, surat rekomendasi, dan dokumen
                                                pendukung lainnya.</p>
                                        </div>
                                    </div>
                                    <div class="alur-step">
                                        <div class="alur-num" style="background:#a855f7">3</div>
                                        <div>
                                            <div class="alur-title">Validasi Kaprodi</div>
                                            <p class="alur-desc">Kaprodi memeriksa kelayakan akademik dan merekomendasikan
                                                mahasiswa.</p>
                                        </div>
                                    </div>
                                    <div class="alur-step">
                                        <div class="alur-num" style="background:#16a34a">4</div>
                                        <div>
                                            <div class="alur-title">Verifikasi & Persetujuan</div>
                                            <p class="alur-desc">Admin dan Warek melakukan verifikasi final dan menetapkan
                                                besaran bantuan.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#partDoc">
                                    <i class="bi bi-folder-fill text-primary me-2"></i>Dokumen Pendukung
                                </button>
                            </h2>
                            <div id="partDoc" class="accordion-collapse collapse" data-bs-parent="#accPartial">
                                <div class="accordion-body">
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="doc-chip"><i class="bi bi-file-earmark-text-fill"></i> Transkrip
                                            Nilai</span>
                                        <span class="doc-chip"><i class="bi bi-person-badge-fill"></i> KTM Aktif</span>
                                        <span class="doc-chip"><i class="bi bi-file-earmark-check-fill"></i> Surat Aktif
                                            Kuliah</span>
                                        <span class="doc-chip"><i class="bi bi-chat-square-text-fill"></i> Surat Rekomendasi
                                            DPA</span>
                                        <span class="doc-chip"><i class="bi bi-image-fill"></i> Pas Foto 3×4</span>
                                    </div>
                                    <div class="mt-3 p-3 rounded-3"
                                        style="background:#fffbeb;border:1px solid #fde68a;font-size:.8rem;color:#92400e">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                        Format <strong>PDF</strong>, maks. <strong>5 MB</strong> per file. Transkrip harus
                                        memperlihatkan IPK dengan jelas.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-3 flex-wrap">
                        <a href="{{ route('login') }}" class="btn-cta-primary"
                            style="background:linear-gradient(135deg,#7c3aed,#6d28d9)"><i
                                class="bi bi-box-arrow-in-right me-2"></i>Daftar Sekarang</a>
                        <a href="{{ route('guest.faq') }}" class="btn btn-outline-secondary rounded-3 fw-semibold"
                            style="font-size:.88rem"><i class="bi bi-question-circle me-1"></i>Lihat FAQ</a>
                    </div>
                </div>
            </div>

            {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
            CARD 3 — ONE SHOT
            ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
            <div class="program-card fade-up">
                <div class="pc-header">
                    <div class="accent-bar" style="background:linear-gradient(90deg,#f59e0b,#f97316)"></div>
                    <div class="pc-identity">
                        <div class="pc-icon-wrap" style="background:#fef3c7;color:#b45309"><i
                                class="bi bi-lightning-fill"></i></div>
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                                <h2 class="pc-name mb-0">Beasiswa One Shot</h2>
                                <span class="bdg bdg-green bdg-pulse"><i class="bi bi-broadcast"></i> Sedang Dibuka</span>
                                <span class="bdg bdg-amber"><i class="bi bi-lightning-fill"></i> Cepat Cair</span>
                            </div>
                            <div class="pc-sponsor">
                                <i class="bi bi-building me-1"></i>Dana Internal Universitas YARSI
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pc-body">
                    <p style="font-size:.9rem;color:#4b5563;line-height:1.75;max-width:700px">
                        Bantuan dana <strong>satu kali (insidental)</strong> yang diberikan untuk mahasiswa yang mengalami
                        kesulitan ekonomi mendadak, musibah, atau keperluan mendesak terkait studi. Tidak memerlukan
                        perpanjangan dan tidak menutup beasiswa lain.
                    </p>

                    <div class="detail-grid">
                        <div class="detail-cell">
                            <div class="dc-val" style="color:#b45309">1×</div>
                            <div class="dc-lbl">Pemberian</div>
                        </div>
                        <div class="detail-cell">
                            <div class="dc-val" style="color:#15803d">25</div>
                            <div class="dc-lbl">Kuota / Batch</div>
                        </div>
                        <div class="detail-cell">
                            <div class="dc-val" style="color:#1d4ed8">N/A</div>
                            <div class="dc-lbl">Batas Semester</div>
                        </div>
                        <div class="detail-cell">
                            <div class="dc-val" style="color:#f59e0b">2.50</div>
                            <div class="dc-lbl">IPK Minimal</div>
                        </div>
                        <div class="detail-cell">
                            <div class="dc-val" style="color:#dc2626">30 Apr</div>
                            <div class="dc-lbl">Deadline Q2</div>
                        </div>
                    </div>

                    <h6 class="fw-bold mb-3" style="font-size:.9rem;color:#0f172a">
                        <i class="bi bi-gift-fill text-primary me-2"></i>Rincian Bantuan yang Diberikan
                    </h6>
                    <ul class="coverage-list mb-4">
                        <li><i class="bi bi-check-circle-fill"></i> Dana bantuan tunai sekali</li>
                        <li><i class="bi bi-check-circle-fill"></i> Proses persetujuan cepat (≤ 3 hari)</li>
                        <li><i class="bi bi-check-circle-fill"></i> Tidak menutup beasiswa lain</li>
                        <li><i class="bi bi-check-circle-fill"></i> Untuk kondisi darurat / mendesak</li>
                    </ul>

                    <div class="accordion acc-premium" id="accOne">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#oneReq">
                                    <i class="bi bi-clipboard-check-fill text-primary me-2"></i>Persyaratan Pendaftaran
                                </button>
                            </h2>
                            <div id="oneReq" class="accordion-collapse collapse" data-bs-parent="#accOne">
                                <div class="accordion-body">
                                    <ul>
                                        <li>Mahasiswa aktif Universitas YARSI (semua jenjang)</li>
                                        <li>IPK kumulatif minimal <strong>2.50</strong></li>
                                        <li>Belum pernah menerima bantuan One Shot sebelumnya</li>
                                        <li>Memiliki surat keterangan kondisi darurat dari pihak berwenang (RT/RW,
                                            Kelurahan, dsb.)</li>
                                        <li>Direkomendasikan oleh Dosen Pembimbing Akademik atau Kaprodi</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#oneAlur">
                                    <i class="bi bi-diagram-3-fill text-primary me-2"></i>Alur Pengajuan
                                </button>
                            </h2>
                            <div id="oneAlur" class="accordion-collapse collapse" data-bs-parent="#accOne">
                                <div class="accordion-body">
                                    <div class="alur-step">
                                        <div class="alur-num" style="background:#f59e0b">1</div>
                                        <div>
                                            <div class="alur-title">Pengajuan Online</div>
                                            <p class="alur-desc">Isi formulir pengajuan One Shot melalui sistem dan unggah
                                                dokumen pendukung.</p>
                                        </div>
                                    </div>
                                    <div class="alur-step">
                                        <div class="alur-num" style="background:#f97316">2</div>
                                        <div>
                                            <div class="alur-title">Review Kaprodi</div>
                                            <p class="alur-desc">Kaprodi melakukan verifikasi singkat dan memberikan
                                                rekomendasi.</p>
                                        </div>
                                    </div>
                                    <div class="alur-step">
                                        <div class="alur-num" style="background:#16a34a">3</div>
                                        <div>
                                            <div class="alur-title">Persetujuan Cepat</div>
                                            <p class="alur-desc">Admin dan Warek melakukan persetujuan prioritas (maks. 3
                                                hari kerja).</p>
                                        </div>
                                    </div>
                                    <div class="alur-step">
                                        <div class="alur-num" style="background:#1d4ed8">4</div>
                                        <div>
                                            <div class="alur-title">Pencairan Dana</div>
                                            <p class="alur-desc">Dana bantuan dicairkan langsung ke rekening mahasiswa yang
                                                bersangkutan.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#oneDoc">
                                    <i class="bi bi-folder-fill text-primary me-2"></i>Dokumen Pendukung
                                </button>
                            </h2>
                            <div id="oneDoc" class="accordion-collapse collapse" data-bs-parent="#accOne">
                                <div class="accordion-body">
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="doc-chip"><i class="bi bi-file-earmark-pdf-fill"></i> Surat Keterangan
                                            Darurat</span>
                                        <span class="doc-chip"><i class="bi bi-file-earmark-text-fill"></i> Transkrip
                                            Nilai</span>
                                        <span class="doc-chip"><i class="bi bi-person-badge-fill"></i> KTM Aktif</span>
                                        <span class="doc-chip"><i class="bi bi-chat-square-text-fill"></i> Rekomendasi
                                            DPA/Kaprodi</span>
                                        <span class="doc-chip"><i class="bi bi-credit-card-fill"></i> Fotokopi
                                            Rekening</span>
                                    </div>
                                    <div class="mt-3 p-3 rounded-3"
                                        style="background:#dcfce7;border:1px solid #86efac;font-size:.8rem;color:#166534">
                                        <i class="bi bi-info-circle-fill me-2"></i>
                                        Pengajuan One Shot diproses secara <strong>prioritas</strong> — maksimal 3 hari
                                        kerja setelah dokumen lengkap.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-3 flex-wrap">
                        <a href="{{ route('login') }}" class="btn-cta-primary"
                            style="background:linear-gradient(135deg,#f59e0b,#d97706);box-shadow:0 4px 14px rgba(245,158,11,.3)"><i
                                class="bi bi-box-arrow-in-right me-2"></i>Ajukan Bantuan</a>
                        <a href="{{ route('guest.faq') }}" class="btn btn-outline-secondary rounded-3 fw-semibold"
                            style="font-size:.88rem"><i class="bi bi-question-circle me-1"></i>Lihat FAQ</a>
                    </div>
                </div>
            </div>

            {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
            TABEL PERBANDINGAN
            ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
            <div class="fade-up mt-3">
                <div class="text-center mb-4">
                    <p class="sec-label"><i class="bi bi-arrow-left-right me-1"></i>Perbandingan</p>
                    <h2 class="sec-title">Bandingkan Ketiga Program</h2>
                </div>
                <div class="table-responsive">
                    <table class="table compare-table mb-0">
                        <thead>
                            <tr>
                                <th style="min-width:180px">Komponen</th>
                                <th><i class="bi bi-trophy-fill me-1"></i>Full Funded</th>
                                <th><i class="bi bi-award-fill me-1"></i>Partially</th>
                                <th><i class="bi bi-lightning-fill me-1"></i>One Shot</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Status</td>
                                <td><span class="bdg bdg-green bdg-pulse" style="font-size:.68rem">Dibuka</span></td>
                                <td><span class="bdg bdg-green bdg-pulse" style="font-size:.68rem">Dibuka</span></td>
                                <td><span class="bdg bdg-green bdg-pulse" style="font-size:.68rem">Dibuka</span></td>
                            </tr>
                            <tr>
                                <td>Cakupan UKT</td>
                                <td class="fw-bold" style="color:#1d4ed8">100%</td>
                                <td class="fw-bold" style="color:#7c3aed">25–75%</td>
                                <td class="text-muted">—</td>
                            </tr>
                            <tr>
                                <td>Tunjangan Hidup</td>
                                <td><i class="bi bi-check-circle-fill check-yes"></i></td>
                                <td><i class="bi bi-dash-circle-fill check-partial"></i></td>
                                <td><i class="bi bi-x-circle-fill check-no"></i></td>
                            </tr>
                            <tr>
                                <td>Biaya Buku & Riset</td>
                                <td><i class="bi bi-check-circle-fill check-yes"></i></td>
                                <td><i class="bi bi-x-circle-fill check-no"></i></td>
                                <td><i class="bi bi-x-circle-fill check-no"></i></td>
                            </tr>
                            <tr>
                                <td>Bantuan Tunai Langsung</td>
                                <td><i class="bi bi-x-circle-fill check-no"></i></td>
                                <td><i class="bi bi-x-circle-fill check-no"></i></td>
                                <td><i class="bi bi-check-circle-fill check-yes"></i></td>
                            </tr>
                            <tr>
                                <td>IPK Minimal</td>
                                <td>3.00</td>
                                <td>3.25</td>
                                <td>2.50</td>
                            </tr>
                            <tr>
                                <td>Kuota</td>
                                <td>100 / semester</td>
                                <td>50 / semester</td>
                                <td>25 / batch</td>
                            </tr>
                            <tr>
                                <td>Durasi</td>
                                <td>Maks 8 semester</td>
                                <td>Maks 8 semester</td>
                                <td>Satu kali</td>
                            </tr>
                            <tr>
                                <td>Perpanjangan</td>
                                <td><i class="bi bi-check-circle-fill check-yes"></i></td>
                                <td><i class="bi bi-check-circle-fill check-yes"></i></td>
                                <td><i class="bi bi-x-circle-fill check-no"></i></td>
                            </tr>
                            <tr>
                                <td>Bisa Kombinasi?</td>
                                <td><i class="bi bi-x-circle-fill check-no"></i></td>
                                <td><i class="bi bi-check-circle-fill check-yes"></i></td>
                                <td><i class="bi bi-check-circle-fill check-yes"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
            CTA BANNER
            ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
            <div class="fade-up mt-5">
                <div class="rounded-4 p-5 text-white text-center position-relative overflow-hidden"
                    style="background:linear-gradient(135deg,#0f172a,#1e3a8a)">
                    <div
                        style="position:absolute;inset:0;background-image:radial-gradient(circle at 30% 50%, rgba(99,102,241,.18) 0%,transparent 50%);pointer-events:none">
                    </div>
                    <div class="position-relative">
                        <i class="bi bi-mortarboard-fill d-block mb-3" style="font-size:2.5rem;opacity:.85"></i>
                        <h3 class="fw-bolder mb-2" style="font-size:1.6rem">Masih Bingung Memilih Program?</h3>
                        <p style="opacity:.75;max-width:480px;margin:0 auto 1.5rem;font-size:.92rem;line-height:1.7">
                            Kunjungi halaman FAQ untuk jawaban lengkap, atau hubungi tim panitia beasiswa kami untuk
                            konsultasi langsung.
                        </p>
                        <div class="d-flex gap-3 justify-content-center flex-wrap">
                            <a href="{{ route('login') }}" class="btn btn-light fw-bold rounded-pill px-4">
                                <i class="bi bi-box-arrow-in-right me-2 text-primary"></i>Masuk & Daftar
                            </a>
                            <a href="{{ route('guest.faq') }}" class="btn btn-outline-light fw-semibold rounded-pill px-4">
                                <i class="bi bi-question-circle me-1"></i>Lihat FAQ
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

@push('scripts')
    <script>
        const obs = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); }
            });
        }, { threshold: 0.08 });
        document.querySelectorAll('.fade-up').forEach(el => obs.observe(el));
    </script>
@endpush