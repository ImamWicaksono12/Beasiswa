# Dokumen Konteks Pengembangan: Sistem Informasi Manajemen Beasiswa YARSI

## 1. Spesifikasi Teknologi (Stack)

- **Framework Utama**: Laravel 12 (pendekatan Server-Side Rendering / SSR).
- **Frontend**: Blade Templating Engine & Bootstrap 5.
- **Asset Bundler**: Vite.
- **Database**: MySQL.
- **Autentikasi**: Integrasi LDAP dan Single Sign-On (SSO) institusi (direncanakan pada tahap akhir).

## 2. Struktur Pengguna & Hak Akses (RBAC)

Sistem ini mengelola empat peran pengguna utama:

- **Admin**: Bertanggung jawab memverifikasi dokumen SK, mengelola periode pendaftaran, dan memasukkan data mahasiswa ke jenis beasiswa yang sesuai.
- **Mahasiswa**: Mengunggah dokumen SK, mengisi laporan monitoring (KHS, IPK/IPS, esai), dan melihat status pengajuan.
- **Kaprodi / Wadek**: Melakukan validasi terhadap monitoring akademik mahasiswa di tingkat program studi.
- **Warek / Kapus**: Memantau statistik data penerima secara keseluruhan untuk kebutuhan audit dan pelaporan.

## 3. Klasifikasi & Alur Bisnis Beasiswa

Sistem membedakan perlakuan berdasarkan jenis bantuan yang diterima mahasiswa:

- **Full Funded & Partially Funded**:
    - Membutuhkan monitoring perkembangan akademik setiap semester.
    - Mahasiswa wajib mengunggah KHS, menginput IPK/IPS secara manual, dan menulis esai aktivitas organisasi.
- **One Shot**:
    - Bantuan bersifat sekali pemberian tanpa kewajiban monitoring dokumen tambahan.
    - Mendapatkan prioritas dalam fitur antrean pendaftaran.

## 4. Alur Pendaftaran & Validasi

- **Pendaftaran Mandiri**: Mahasiswa yang belum memiliki beasiswa diarahkan ke portal eksternal.
- **Validasi SK**: Mahasiswa (baik baru maupun eksisting) mengunggah Surat Keputusan (SK) ke dalam sistem untuk divalidasi oleh Admin.
- **Fitur Antrean (Waiting List)**: Mahasiswa dapat mendaftar ke sistem sebagai calon penerima saat program beasiswa belum dibuka untuk mendapatkan prioritas.

## 5. Fitur Antarmuka (Welcome Page)

Halaman utama sistem menyediakan informasi publik yang mencakup:

- Profil Kampus dan Daftar Program Beasiswa yang tersedia.
- FAQ dan Alur Pendaftaran sistem.
- Testimoni penerima beasiswa dan slide statistik prestasi mahasiswa.

## 6. Fitur Pendukung & Pelaporan

- **Dashboard**: Tampilan responsif untuk memantau data pendaftar dan penerima.
- **Notifikasi**: Pengingat otomatis untuk pengisian laporan monitoring di setiap periode.
- **Export Data**: Fitur untuk mengunduh laporan penerima beasiswa dalam format Excel/Spreadsheet untuk kebutuhan institusi.
