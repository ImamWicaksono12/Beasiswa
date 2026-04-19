<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Default password for all seeded accounts: password123
     */
    public function run(): void
    {
        $password = Hash::make('password123');

        // ──────────────────────────────────────────────
        // ADMIN
        // ──────────────────────────────────────────────
        User::create([
            'username'      => 'admin',
            'nama'          => 'Administrator',
            'email'         => 'admin@yarsi.ac.id',
            'password'      => $password,
            'role'          => 'admin',
            'kode_prodi'    => null,
            'kode_fakultas' => null,
        ]);

        // ──────────────────────────────────────────────
        // WAREK (Wakil Rektor)
        // ──────────────────────────────────────────────
        User::create([
            'username'      => 'warek',
            'nama'          => 'Wakil Rektor Bidang Kemahasiswaan',
            'email'         => 'warek@yarsi.ac.id',
            'password'      => $password,
            'role'          => 'warek',
            'kode_prodi'    => null,
            'kode_fakultas' => null,
        ]);

        // ──────────────────────────────────────────────
        // PUSKAKA (Pusat Karir & Kesejahteraan)
        // ──────────────────────────────────────────────
        User::create([
            'username'      => 'puskaka',
            'nama'          => 'Kepala Pusat Karir & Kesejahteraan',
            'email'         => 'puskaka@yarsi.ac.id',
            'password'      => $password,
            'role'          => 'puskaka',
            'kode_prodi'    => null,
            'kode_fakultas' => null,
        ]);

        // ──────────────────────────────────────────────
        // WADEK (Wakil Dekan) — satu per fakultas
        // ──────────────────────────────────────────────
        $fakultasList = [
            ['kode' => 'FK',  'nama' => 'Wakil Dekan Fakultas Kedokteran'],
            ['kode' => 'FKG', 'nama' => 'Wakil Dekan Fakultas Kedokteran Gigi'],
            ['kode' => 'FEB', 'nama' => 'Wakil Dekan Fakultas Ekonomi dan Bisnis'],
            ['kode' => 'FTI', 'nama' => 'Wakil Dekan Fakultas Teknologi Informasi'],
            ['kode' => 'FH',  'nama' => 'Wakil Dekan Fakultas Hukum'],
            ['kode' => 'FP',  'nama' => 'Wakil Dekan Fakultas Psikologi'],
        ];

        foreach ($fakultasList as $fak) {
            $slug = strtolower($fak['kode']);
            User::create([
                'username'      => "wadek_{$slug}",
                'nama'          => $fak['nama'],
                'email'         => "wadek.{$slug}@yarsi.ac.id",
                'password'      => $password,
                'role'          => 'wadek',
                'kode_prodi'    => null,
                'kode_fakultas' => $fak['kode'],
            ]);
        }

        // ──────────────────────────────────────────────
        // KAPRODI (Ketua Program Studi)
        // ──────────────────────────────────────────────
        $prodiList = [
            ['kode_fakultas' => 'FK',  'kode_prodi' => 'KU',  'nama' => 'Kaprodi Kedokteran Umum'],
            ['kode_fakultas' => 'FKG', 'kode_prodi' => 'KG',  'nama' => 'Kaprodi Kedokteran Gigi'],
            ['kode_fakultas' => 'FEB', 'kode_prodi' => 'MNJ', 'nama' => 'Kaprodi Manajemen'],
            ['kode_fakultas' => 'FEB', 'kode_prodi' => 'AKT', 'nama' => 'Kaprodi Akuntansi'],
            ['kode_fakultas' => 'FTI', 'kode_prodi' => 'TI',  'nama' => 'Kaprodi Teknik Informatika'],
            ['kode_fakultas' => 'FTI', 'kode_prodi' => 'PSI', 'nama' => 'Kaprodi Perpustakaan dan Sains Informasi'],
            ['kode_fakultas' => 'FH',  'kode_prodi' => 'HKM', 'nama' => 'Kaprodi Hukum'],
            ['kode_fakultas' => 'FP',  'kode_prodi' => 'PSK', 'nama' => 'Kaprodi Psikologi'],
        ];

        foreach ($prodiList as $prodi) {
            $slug = strtolower($prodi['kode_prodi']);
            User::create([
                'username'      => "kaprodi_{$slug}",
                'nama'          => $prodi['nama'],
                'email'         => "kaprodi.{$slug}@yarsi.ac.id",
                'password'      => $password,
                'role'          => 'kaprodi',
                'kode_prodi'    => $prodi['kode_prodi'],
                'kode_fakultas' => $prodi['kode_fakultas'],
            ]);
        }

        // ──────────────────────────────────────────────
        // MAHASISWA
        // ──────────────────────────────────────────────
        $mahasiswaData = [
            ['nama' => 'Ahmad Fauzi',    'username' => '1900001', 'kode_prodi' => 'KU',  'kode_fakultas' => 'FK'],
            ['nama' => 'Siti Nurhaliza',  'username' => '1900002', 'kode_prodi' => 'KG',  'kode_fakultas' => 'FKG'],
            ['nama' => 'Budi Santoso',    'username' => '1900003', 'kode_prodi' => 'MNJ', 'kode_fakultas' => 'FEB'],
            ['nama' => 'Dewi Lestari',    'username' => '1900004', 'kode_prodi' => 'AKT', 'kode_fakultas' => 'FEB'],
            ['nama' => 'Rizky Pratama',   'username' => '1900005', 'kode_prodi' => 'TI',  'kode_fakultas' => 'FTI'],
            ['nama' => 'Nurul Hidayah',   'username' => '1900006', 'kode_prodi' => 'PSI', 'kode_fakultas' => 'FTI'],
            ['nama' => 'Fajar Ramadhan',  'username' => '1900007', 'kode_prodi' => 'HKM', 'kode_fakultas' => 'FH'],
            ['nama' => 'Anisa Putri',     'username' => '1900008', 'kode_prodi' => 'PSK', 'kode_fakultas' => 'FP'],
        ];

        foreach ($mahasiswaData as $mhs) {
            User::create([
                'username'      => $mhs['username'],
                'nama'          => $mhs['nama'],
                'email'         => "{$mhs['username']}@yarsi.ac.id",
                'password'      => $password,
                'role'          => 'mahasiswa',
                'kode_prodi'    => $mhs['kode_prodi'],
                'kode_fakultas' => $mhs['kode_fakultas'],
            ]);
        }
    }
}
