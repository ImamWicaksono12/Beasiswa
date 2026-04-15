<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('password123');
        User::create([
            'nama'     => 'Administrator',
            'email'    => 'admin@yarsi.ac.id',
            'password' => $password,
            'username' => 'admin',
            'npm'      => null,
            'fakultas' => null,
            'prodi'    => null,
            'role'     => 'admin',
        ]);
        User::create([
            'nama'     => 'Wakil Rektor Bidang Kemahasiswaan',
            'email'    => 'warek@yarsi.ac.id',
            'password' => $password,
            'username' => 'warek',
            'npm'      => null,
            'fakultas' => null,
            'prodi'    => null,
            'role'     => 'puskaka',
        ]);

        User::create([
            'nama'     => 'Kepala Pusat Karir & Kesejahteraan',
            'email'    => 'puskaka@yarsi.ac.id',
            'password' => $password,
            'username' => 'puskaka',
            'npm'      => null,
            'fakultas' => null,
            'prodi'    => null,
            'role'     => 'puskaka',
        ]);
        $prodiList = [
            ['fakultas' => 'Fakultas Kedokteran',              'prodi' => 'Kedokteran Umum'],
            ['fakultas' => 'Fakultas Kedokteran Gigi',         'prodi' => 'Kedokteran Gigi'],
            ['fakultas' => 'Fakultas Ekonomi dan Bisnis',      'prodi' => 'Manajemen'],
            ['fakultas' => 'Fakultas Ekonomi dan Bisnis',      'prodi' => 'Akuntansi'],
            ['fakultas' => 'Fakultas Teknologi Informasi',     'prodi' => 'Teknik Informatika'],
            ['fakultas' => 'Fakultas Teknologi Informasi',     'prodi' => 'Perpustakaan dan Sains Informasi'],
            ['fakultas' => 'Fakultas Hukum',                   'prodi' => 'Hukum'],
            ['fakultas' => 'Fakultas Psikologi',               'prodi' => 'Psikologi'],
        ];

        foreach ($prodiList as $item) {
            $slug = strtolower(str_replace(' ', '_', $item['prodi']));

            User::create([
                'nama'     => 'Kaprodi ' . $item['prodi'],
                'email'    => "kaprodi.{$slug}@yarsi.ac.id",
                'password' => $password,
                'username' => "kaprodi_{$slug}",
                'npm'      => null,
                'fakultas' => $item['fakultas'],
                'prodi'    => $item['prodi'],
                'role'     => 'verifikator_prodi',
            ]);
        }
        $mahasiswaData = [
            ['nama' => 'Ahmad Fauzi',    'prodi' => 'Kedokteran Umum',                  'fakultas' => 'Fakultas Kedokteran',          'npm' => '1900001'],
            ['nama' => 'Siti Nurhaliza',  'prodi' => 'Kedokteran Gigi',                  'fakultas' => 'Fakultas Kedokteran Gigi',     'npm' => '1900002'],
            ['nama' => 'Budi Santoso',    'prodi' => 'Manajemen',                        'fakultas' => 'Fakultas Ekonomi dan Bisnis',  'npm' => '1900003'],
            ['nama' => 'Dewi Lestari',    'prodi' => 'Akuntansi',                        'fakultas' => 'Fakultas Ekonomi dan Bisnis',  'npm' => '1900004'],
            ['nama' => 'Rizky Pratama',   'prodi' => 'Teknik Informatika',               'fakultas' => 'Fakultas Teknologi Informasi', 'npm' => '1900005'],
            ['nama' => 'Nurul Hidayah',   'prodi' => 'Perpustakaan dan Sains Informasi', 'fakultas' => 'Fakultas Teknologi Informasi', 'npm' => '1900006'],
            ['nama' => 'Fajar Ramadhan',  'prodi' => 'Hukum',                            'fakultas' => 'Fakultas Hukum',               'npm' => '1900007'],
            ['nama' => 'Anisa Putri',     'prodi' => 'Psikologi',                        'fakultas' => 'Fakultas Psikologi',           'npm' => '1900008'],
        ];

        foreach ($mahasiswaData as $mhs) {
            $slug = strtolower(str_replace(' ', '_', $mhs['nama']));

            User::create([
                'nama'     => $mhs['nama'],
                'email'    => "{$slug}@yarsi.ac.id",
                'password' => $password,
                'username' => $slug,
                'npm'      => $mhs['npm'],
                'fakultas' => $mhs['fakultas'],
                'prodi'    => $mhs['prodi'],
                'role'     => 'mahasiswa',
            ]);
        }
    }
}
