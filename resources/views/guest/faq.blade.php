@extends('layouts.app')

@push('styles')
<style>
    /* ── Hero Section ── */
    .faq-hero {
        background: linear-gradient(135deg, #0d47a1 0%, #1565c0 40%, #1976d2 70%, #42a5f5 100%);
        position: relative;
        overflow: hidden;
        padding: 100px 0 80px;
    }
    .faq-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='20'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        pointer-events: none;
    }
    .faq-hero .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.15;
        animation: float 8s ease-in-out infinite;
    }
    .faq-hero .blob-1 { width: 400px; height: 400px; background: #90caf9; top: -100px; right: -80px; }
    .faq-hero .blob-2 { width: 300px; height: 300px; background: #ffffff; bottom: -60px; left: -60px; animation-delay: 3s; }
    @keyframes float {
        0%, 100% { transform: translateY(0) scale(1); }
        50% { transform: translateY(-20px) scale(1.05); }
    }

    /* ── Section Headings ── */
    .section-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        border: 1px solid rgba(13, 110, 253, 0.2);
        border-radius: 50px;
        padding: 6px 16px;
        font-size: 0.82rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-bottom: 14px;
    }
    .section-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1a1a2e;
        line-height: 1.25;
    }
    .section-subtitle {
        color: #6c757d;
        font-size: 1rem;
        max-width: 520px;
        margin: 0 auto;
    }

    /* ── Alur / Timeline Cards ── */
    .flow-section { background: #f8f9ff; }

    .step-connector {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .step-connector-line {
        width: 2px;
        height: 50px;
        background: linear-gradient(to bottom, #0d6efd, #e9ecef);
        margin: 6px auto;
    }
    @media (min-width: 992px) {
        .step-connector-line { display: none; }
        .step-h-connector {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
        }
        .step-h-connector::after {
            content: '';
            display: block;
            width: 100%;
            height: 2px;
            background: linear-gradient(to right, #0d6efd, #e9ecef);
        }
    }

    .flow-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #e8eaf6;
        padding: 28px 22px;
        text-align: center;
        position: relative;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }
    .flow-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(13, 110, 253, 0.12);
    }
    .flow-card .step-number {
        position: absolute;
        top: -16px;
        left: 50%;
        transform: translateX(-50%);
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        color: white;
        font-size: 0.8rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.35);
    }
    .flow-card .icon-wrap {
        width: 70px;
        height: 70px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 10px auto 16px;
        font-size: 1.8rem;
    }
    .flow-card .card-title { font-weight: 700; font-size: 1rem; color: #1a1a2e; margin-bottom: 8px; }
    .flow-card .card-desc  { font-size: 0.875rem; color: #6c757d; line-height: 1.6; }

    /* icon wrap color variants */
    .icon-blue   { background: #e3f2fd; color: #1565c0; }
    .icon-green  { background: #e8f5e9; color: #2e7d32; }
    .icon-orange { background: #fff3e0; color: #e65100; }
    .icon-purple { background: #ede7f6; color: #4527a0; }
    .icon-teal   { background: #e0f2f1; color: #00695c; }
    .icon-red    { background: #fce4ec; color: #c62828; }

    /* arrow between cards */
    .flow-arrow {
        display: none;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        color: #0d6efd;
        padding-top: 24px;
    }
    @media (min-width: 768px) { .flow-arrow { display: flex; } }

    /* ── FAQ Accordion ── */
    .faq-section { background: #ffffff; }

    .faq-cat-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1a1a2e;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }
    .faq-cat-title .cat-icon {
        width: 36px; height: 36px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem;
    }

    .accordion-item {
        border: 1px solid #e8eaf6 !important;
        border-radius: 14px !important;
        margin-bottom: 12px;
        overflow: hidden;
        transition: box-shadow 0.25s;
    }
    .accordion-item:hover { box-shadow: 0 6px 20px rgba(13, 110, 253, 0.08); }

    .accordion-button {
        font-weight: 600;
        font-size: 0.95rem;
        color: #1a1a2e !important;
        background: #fff !important;
        border-radius: 14px !important;
        padding: 18px 20px;
        box-shadow: none !important;
    }
    .accordion-button:not(.collapsed) {
        color: #0d6efd !important;
        background: #f0f5ff !important;
    }
    .accordion-button::after { filter: invert(0%); }
    .accordion-button:not(.collapsed)::after { filter: invert(35%) sepia(100%) saturate(500%) hue-rotate(200deg); }
    .accordion-body {
        font-size: 0.9rem;
        color: #495057;
        line-height: 1.75;
        padding: 0 20px 18px;
        background: #f0f5ff;
    }
    .accordion-body ul { padding-left: 1.4rem; margin-bottom: 0; }
    .accordion-body li { margin-bottom: 4px; }

    /* ── CTA Banner ── */
    .cta-section {
        background: linear-gradient(135deg, #0d6efd, #6610f2);
        color: white;
        border-radius: 24px;
        padding: 56px 40px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .cta-section::before {
        content: '';
        position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Ccircle cx='40' cy='40' r='30' stroke='%23ffffff' stroke-width='1' stroke-opacity='0.1'/%3E%3C/g%3E%3C/svg%3E");
    }
    .cta-section h3 { font-size: 1.9rem; font-weight: 800; }
    .cta-section p  { opacity: 0.85; font-size: 1rem; }

    /* animation on scroll */
    .animate-on-scroll { opacity: 0; transform: translateY(30px); transition: opacity 0.6s ease, transform 0.6s ease; }
    .animate-on-scroll.visible { opacity: 1; transform: translateY(0); }
</style>
@endpush

@section('content')

{{-- ══════════════════════════════════════════════ HERO ══ --}}
<section class="faq-hero">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="container position-relative text-center text-white">
        <span class="badge bg-white bg-opacity-25 text-white rounded-pill mb-3 px-3 py-2 fs-6">
            <i class="bi bi-info-circle-fill me-2"></i>Panduan & FAQ
        </span>
        <h1 class="display-5 fw-bolder mb-3">Alur & Pertanyaan Umum<br>Beasiswa YARSI</h1>
        <p class="lead opacity-75 mx-auto" style="max-width:560px">
            Pelajari langkah-langkah pendaftaran beasiswa secara lengkap dan temukan jawaban atas
            pertanyaan yang paling sering diajukan oleh mahasiswa.
        </p>
    </div>
</section>

{{-- ══════════════════════════════════════════════ ALUR PENDAFTARAN ══ --}}
<section class="flow-section py-5">
    <div class="container py-3">

        {{-- Section Header --}}
        <div class="text-center mb-5 animate-on-scroll">
            <div class="section-badge"><i class="bi bi-diagram-3-fill"></i>Alur Pendaftaran</div>
            <h2 class="section-title">Langkah-Langkah Pendaftaran<br>Beasiswa YARSI</h2>
            <p class="section-subtitle mt-3">
                Ikuti prosedur berikut secara berurutan untuk memastikan pengajuan beasiswa Anda
                diproses dengan lancar.
            </p>
        </div>

        {{-- Row 1: Langkah 1 – 4 --}}
        <div class="row g-4 mb-4 align-items-start">

            {{-- Step 1 --}}
            <div class="col-12 col-md-5 col-lg-2 animate-on-scroll" style="transition-delay:.05s">
                <div class="flow-card">
                    <div class="step-number">1</div>
                    <div class="icon-wrap icon-blue">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <div class="card-title">Pendaftaran Eksternal</div>
                    <div class="card-desc">Mahasiswa mendaftarkan diri ke program beasiswa eksternal (Dikti, Yayasan, dll.) sesuai syarat yang berlaku.</div>
                </div>
            </div>

            {{-- Arrow --}}
            <div class="col-12 col-md-2 col-lg-1 flow-arrow animate-on-scroll" style="transition-delay:.1s">
                <i class="bi bi-arrow-right-circle-fill"></i>
            </div>

            {{-- Step 2 --}}
            <div class="col-12 col-md-5 col-lg-2 animate-on-scroll" style="transition-delay:.15s">
                <div class="flow-card">
                    <div class="step-number">2</div>
                    <div class="icon-wrap icon-orange">
                        <i class="bi bi-cloud-upload-fill"></i>
                    </div>
                    <div class="card-title">Unggah SK ke Sistem</div>
                    <div class="card-desc">Setelah dinyatakan lolos seleksi, mahasiswa mengunggah Surat Keputusan (SK) penerima beasiswa ke sistem.</div>
                </div>
            </div>

            {{-- Arrow --}}
            <div class="col-12 col-md-2 col-lg-1 flow-arrow animate-on-scroll" style="transition-delay:.2s">
                <i class="bi bi-arrow-right-circle-fill"></i>
            </div>

            {{-- Step 3 --}}
            <div class="col-12 col-md-5 col-lg-2 animate-on-scroll" style="transition-delay:.25s">
                <div class="flow-card">
                    <div class="step-number">3</div>
                    <div class="icon-wrap icon-purple">
                        <i class="bi bi-person-check-fill"></i>
                    </div>
                    <div class="card-title">Validasi Kaprodi</div>
                    <div class="card-desc">Kepala Program Studi memeriksa dan memvalidasi kelengkapan data serta eligibilitas akademik mahasiswa.</div>
                </div>
            </div>

            {{-- Arrow --}}
            <div class="col-12 col-md-2 col-lg-1 flow-arrow animate-on-scroll" style="transition-delay:.3s">
                <i class="bi bi-arrow-right-circle-fill"></i>
            </div>

            {{-- Step 4 --}}
            <div class="col-12 col-md-5 col-lg-2 animate-on-scroll" style="transition-delay:.35s">
                <div class="flow-card">
                    <div class="step-number">4</div>
                    <div class="icon-wrap icon-green">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div class="card-title">Validasi Admin</div>
                    <div class="card-desc">Admin pusat melakukan verifikasi akhir dokumen, memeriksa keaslian SK dan kesesuaian data sistem.</div>
                </div>
            </div>

        </div>

        {{-- Row 2: Langkah 5 – 6 + Info --}}
        <div class="row g-4 align-items-start">

            {{-- Step 5 --}}
            <div class="col-12 col-md-5 col-lg-2 animate-on-scroll" style="transition-delay:.4s">
                <div class="flow-card">
                    <div class="step-number">5</div>
                    <div class="icon-wrap icon-teal">
                        <i class="bi bi-clipboard2-check-fill"></i>
                    </div>
                    <div class="card-title">Persetujuan Warek</div>
                    <div class="card-desc">Wakil Rektor / Kepala Pusat memberikan persetujuan final dan menetapkan status penerima beasiswa.</div>
                </div>
            </div>

            {{-- Arrow --}}
            <div class="col-12 col-md-2 col-lg-1 flow-arrow animate-on-scroll" style="transition-delay:.45s">
                <i class="bi bi-arrow-right-circle-fill"></i>
            </div>

            {{-- Step 6 --}}
            <div class="col-12 col-md-5 col-lg-2 animate-on-scroll" style="transition-delay:.5s">
                <div class="flow-card">
                    <div class="step-number">6</div>
                    <div class="icon-wrap icon-red">
                        <i class="bi bi-trophy-fill"></i>
                    </div>
                    <div class="card-title">Status Ditetapkan</div>
                    <div class="card-desc">Mahasiswa menerima notifikasi resmi dan status beasiswa aktif tercatat dalam sistem YARSI.</div>
                </div>
            </div>

            {{-- Info box --}}
            <div class="col-12 col-lg-5 animate-on-scroll" style="transition-delay:.55s">
                <div class="p-4 rounded-4" style="background:linear-gradient(135deg,#e3f2fd,#f3e5f5); border: 1px solid #c3d9ff;">
                    <h5 class="fw-bold mb-3" style="color:#1a1a2e">
                        <i class="bi bi-lightbulb-fill text-warning me-2"></i>Catatan Penting
                    </h5>
                    <ul class="list-unstyled mb-0" style="font-size:.9rem; color:#495057; line-height:2">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Pastikan dokumen SK berformat <strong>PDF</strong> dan ukuran maks. 5 MB.</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>SK yang diunggah harus masih <strong>berlaku</strong> (tidak kedaluwarsa).</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Satu mahasiswa hanya boleh melapor <strong>satu beasiswa aktif</strong> per semester.</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Proses validasi berlangsung maksimal <strong>5 hari kerja</strong>.</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Beasiswa <em>One Shot</em> hanya diajukan <strong>satu kali</strong> sepanjang studi.</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════ FAQ ══ --}}
<section class="faq-section py-5">
    <div class="container py-3">

        {{-- Section Header --}}
        <div class="text-center mb-5 animate-on-scroll">
            <div class="section-badge"><i class="bi bi-chat-dots-fill"></i>FAQ</div>
            <h2 class="section-title">Pertanyaan yang Sering<br>Diajukan</h2>
            <p class="section-subtitle mt-3">
                Tidak menemukan jawaban? Hubungi kami melalui email
                <a href="mailto:beasiswa@yarsi.ac.id" class="text-primary fw-semibold">beasiswa@yarsi.ac.id</a>
            </p>
        </div>

        <div class="row g-5">

            {{-- Kolom Kiri — Umum & Jenis --}}
            <div class="col-lg-6">

                {{-- Kategori: Umum --}}
                <div class="faq-cat-title animate-on-scroll">
                    <div class="cat-icon icon-blue"><i class="bi bi-question-circle-fill"></i></div>
                    Pertanyaan Umum
                </div>

                <div class="accordion accordion-flush mb-5" id="accordionUmum">

                    <div class="accordion-item animate-on-scroll" style="transition-delay:.05s">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#umumQ1" aria-expanded="false">
                                Siapa saja yang berhak mendaftar beasiswa YARSI?
                            </button>
                        </h2>
                        <div id="umumQ1" class="accordion-collapse collapse" data-bs-parent="#accordionUmum">
                            <div class="accordion-body">
                                Mahasiswa aktif Universitas YARSI yang memiliki IPK minimal 3.00, tidak sedang
                                menerima beasiswa lain (kecuali untuk kategori tertentu), dan telah menyelesaikan
                                minimal 1 semester aktif dapat mendaftar.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item animate-on-scroll" style="transition-delay:.1s">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#umumQ2" aria-expanded="false">
                                Bagaimana jika saya sudah punya beasiswa dari lembaga lain?
                            </button>
                        </h2>
                        <div id="umumQ2" class="accordion-collapse collapse" data-bs-parent="#accordionUmum">
                            <div class="accordion-body">
                                Mahasiswa yang telah menerima beasiswa <strong>Full Funded</strong> dari lembaga lain
                                <em>tidak dapat</em> mendaftar beasiswa Full/Partially Funded YARSI secara bersamaan.
                                Namun, beasiswa <strong>One Shot</strong> (bantuan insidental) masih dapat diajukan
                                selama memenuhi syarat khusus yang ditentukan.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item animate-on-scroll" style="transition-delay:.15s">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#umumQ3" aria-expanded="false">
                                Kapan pendaftaran beasiswa dibuka setiap tahunnya?
                            </button>
                        </h2>
                        <div id="umumQ3" class="accordion-collapse collapse" data-bs-parent="#accordionUmum">
                            <div class="accordion-body">
                                Jadwal pendaftaran mengikuti kalender akademik YARSI, umumnya dibuka pada awal
                                semester gasal (Agustus–September) dan semester genap (Februari–Maret). Pantau
                                terus halaman <strong>Pengumuman</strong> untuk informasi terbaru.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item animate-on-scroll" style="transition-delay:.2s">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#umumQ4" aria-expanded="false">
                                Berapa lama proses validasi berlangsung?
                            </button>
                        </h2>
                        <div id="umumQ4" class="accordion-collapse collapse" data-bs-parent="#accordionUmum">
                            <div class="accordion-body">
                                Setelah berkas diunggah, proses validasi oleh Kaprodi membutuhkan <strong>1–3 hari
                                kerja</strong>, dilanjutkan validasi Admin <strong>1–2 hari kerja</strong>. Total
                                proses lengkap maksimal <strong>5 hari kerja</strong>. Anda akan menerima notifikasi
                                di setiap tahap.
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Kategori: Dokumen --}}
                <div class="faq-cat-title animate-on-scroll">
                    <div class="cat-icon icon-orange"><i class="bi bi-file-earmark-text-fill"></i></div>
                    Dokumen & Persyaratan
                </div>

                <div class="accordion accordion-flush" id="accordionDokumen">

                    <div class="accordion-item animate-on-scroll" style="transition-delay:.05s">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#dokQ1" aria-expanded="false">
                                Dokumen apa saja yang perlu disiapkan?
                            </button>
                        </h2>
                        <div id="dokQ1" class="accordion-collapse collapse" data-bs-parent="#accordionDokumen">
                            <div class="accordion-body">
                                Dokumen utama yang wajib diunggah meliputi:
                                <ul class="mt-2">
                                    <li>Surat Keputusan (SK) penerimaan beasiswa dari lembaga pemberi</li>
                                    <li>Transkrip nilai terbaru (IPK terlihat jelas)</li>
                                    <li>KTM (Kartu Tanda Mahasiswa) aktif</li>
                                    <li>Surat keterangan aktif kuliah dari Fakultas</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item animate-on-scroll" style="transition-delay:.1s">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#dokQ2" aria-expanded="false">
                                Apa format file yang diterima untuk unggah dokumen?
                            </button>
                        </h2>
                        <div id="dokQ2" class="accordion-collapse collapse" data-bs-parent="#accordionDokumen">
                            <div class="accordion-body">
                                Sistem hanya menerima file berformat <strong>PDF</strong> dengan ukuran maksimal
                                <strong>5 MB per file</strong>. Pastikan dokumen terbaca dengan jelas (resolusi dan
                                orientasi halaman yang benar) sebelum diunggah.
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Kolom Kanan — Jenis Beasiswa & Teknis --}}
            <div class="col-lg-6">

                {{-- Kategori: Jenis Beasiswa --}}
                <div class="faq-cat-title animate-on-scroll">
                    <div class="cat-icon icon-purple"><i class="bi bi-award-fill"></i></div>
                    Jenis Beasiswa
                </div>

                <div class="accordion accordion-flush mb-5" id="accordionJenis">

                    <div class="accordion-item animate-on-scroll" style="transition-delay:.05s">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#jenisQ1" aria-expanded="false">
                                Apa itu beasiswa One Shot?
                            </button>
                        </h2>
                        <div id="jenisQ1" class="accordion-collapse collapse" data-bs-parent="#accordionJenis">
                            <div class="accordion-body">
                                Beasiswa <strong>One Shot</strong> adalah bantuan dana yang diberikan
                                <em>satu kali</em> (tidak berulang) untuk membantu mahasiswa yang
                                mengalami kesulitan ekonomi mendadak, musibah, atau keperluan mendesak terkait studi.
                                Berbeda dengan beasiswa periodik, One Shot tidak memerlukan perpanjangan setiap
                                semester.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item animate-on-scroll" style="transition-delay:.1s">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#jenisQ2" aria-expanded="false">
                                Apa perbedaan Full Funded dan Partially Funded?
                            </button>
                        </h2>
                        <div id="jenisQ2" class="accordion-collapse collapse" data-bs-parent="#accordionJenis">
                            <div class="accordion-body">
                                <ul>
                                    <li><strong>Full Funded</strong> – menanggung seluruh biaya pendidikan (UKT/SPP),
                                        biaya hidup, dan tunjangan lain sesuai ketentuan pemberi beasiswa.</li>
                                    <li><strong>Partially Funded</strong> – hanya menanggung sebagian komponen biaya
                                        (misalnya hanya UKT atau hanya biaya hidup), sehingga mahasiswa masih
                                        menanggung sisa biaya secara mandiri.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item animate-on-scroll" style="transition-delay:.15s">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#jenisQ3" aria-expanded="false">
                                Bisakah satu orang mendapat lebih dari satu jenis beasiswa?
                            </button>
                        </h2>
                        <div id="jenisQ3" class="accordion-collapse collapse" data-bs-parent="#accordionJenis">
                            <div class="accordion-body">
                                Secara umum, mahasiswa hanya dapat menerima <strong>satu beasiswa aktif</strong> pada
                                satu waktu. Namun, kombinasi tertentu diperbolehkan, misalnya menerima beasiswa
                                Partially Funded bersamaan dengan beasiswa One Shot, dengan syarat keduanya disetujui
                                oleh Warek dan tidak terjadi tumpang tindih komponen pembiayaan.
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Kategori: Teknis Sistem --}}
                <div class="faq-cat-title animate-on-scroll">
                    <div class="cat-icon icon-teal"><i class="bi bi-laptop-fill"></i></div>
                    Teknis & Sistem
                </div>

                <div class="accordion accordion-flush" id="accordionTeknis">

                    <div class="accordion-item animate-on-scroll" style="transition-delay:.05s">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#tekQ1" aria-expanded="false">
                                Bagaimana cara mendaftar akun di sistem?
                            </button>
                        </h2>
                        <div id="tekQ1" class="accordion-collapse collapse" data-bs-parent="#accordionTeknis">
                            <div class="accordion-body">
                                Akun mahasiswa dibuat secara otomatis oleh Admin menggunakan NIM yang terdaftar di
                                sistem akademik YARSI. Anda cukup login menggunakan <strong>NIM</strong> dan
                                <strong>password default</strong> yang diberikan, lalu ubah password segera setelah
                                login pertama.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item animate-on-scroll" style="transition-delay:.1s">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#tekQ2" aria-expanded="false">
                                Apa yang harus dilakukan jika dokumen ditolak?
                            </button>
                        </h2>
                        <div id="tekQ2" class="accordion-collapse collapse" data-bs-parent="#accordionTeknis">
                            <div class="accordion-body">
                                Anda akan menerima notifikasi beserta <strong>catatan alasan penolakan</strong> dari
                                Kaprodi atau Admin. Perbaiki dokumen sesuai catatan tersebut, lalu unggah ulang
                                melalui menu <em>Pengajuan Saya</em> di dashboard mahasiswa. Pastikan revisi
                                dilakukan sebelum batas waktu yang ditentukan.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item animate-on-scroll" style="transition-delay:.15s">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#tekQ3" aria-expanded="false">
                                Apakah saya bisa melacak status pengajuan saya?
                            </button>
                        </h2>
                        <div id="tekQ3" class="accordion-collapse collapse" data-bs-parent="#accordionTeknis">
                            <div class="accordion-body">
                                Ya! Setelah login, dashboard <em>Mahasiswa</em> menampilkan <strong>timeline
                                status</strong> pengajuan secara real-time, mulai dari <em>Menunggu Validasi
                                Kaprodi</em> → <em>Disetujui Kaprodi</em> → <em>Diverifikasi Admin</em> →
                                <em>Disetujui Warek</em>.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════ CTA ══ --}}
<section class="py-5">
    <div class="container">
        <div class="cta-section animate-on-scroll">
            <h3 class="mb-3">Masih Punya Pertanyaan?</h3>
            <p class="mb-4">Tim kami siap membantu Anda. Kirimkan pertanyaan melalui email atau kunjungi
            kantor Panitia Beasiswa YARSI.</p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="mailto:beasiswa@yarsi.ac.id"
                   class="btn btn-light fw-semibold px-4 py-2 rounded-pill shadow-sm">
                    <i class="bi bi-envelope-fill me-2 text-primary"></i>Kirim Email
                </a>
                <a href="{{ route('login') }}"
                   class="btn btn-outline-light fw-semibold px-4 py-2 rounded-pill">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk & Daftar
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Animate on scroll using IntersectionObserver
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
</script>
@endpush
