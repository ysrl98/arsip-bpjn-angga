<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun ADMIN
        User::create([
            'nip' => '198001012005011001', // NIP Format standar
            'password' => Hash::make('password123'), // Password default
            'nama_lengkap' => 'Administrator BPJN',
            'role' => 'admin',
            'email' => 'admin@bpjn.go.id',
            'no_hp' => '081234567890',
            'pangkat_golongan' => 'Pembina (IV/a)',
            'jabatan' => 'Kepala Bagian Tata Usaha',
            'unit_kerja' => 'Bagian Tata Usaha',
            'status_kepegawaian' => 'PNS',
        ]);

        // 2. Akun USER (Pegawai Biasa)
        User::create([
            'nip' => '1', 
            'password' => Hash::make('password123'),
            'nama_lengkap' => 'Budi Santoso, S.T.',
            'role' => 'user',
            'email' => 'budi@bpjn.go.id',
            'no_hp' => '089876543210',
            'pangkat_golongan' => 'Penata Muda (III/a)',
            'jabatan' => 'Staf Teknis',
            'unit_kerja' => 'Satker PJN Wilayah 1',
            'status_kepegawaian' => 'PNS',
        ]);
        
        // 3. Akun USER (PPNPN/Honorer)
         User::create([
            'nip' => 'HONORER001', 
            'password' => Hash::make('password123'),
            'nama_lengkap' => 'Siti Aminah',
            'role' => 'user',
            'email' => 'siti@bpjn.go.id',
            'no_hp' => '08555555555',
            'pangkat_golongan' => '-',
            'jabatan' => 'Staff Administrasi',
            'unit_kerja' => 'Subbag Umum',
            'status_kepegawaian' => 'Honorer/PPNPN',
        ]);
        
        // 4. Akun PIMPINAN
         User::create([
            'nip' => '197001011995031002', 
            'password' => Hash::make('password123'),
            'nama_lengkap' => 'Ir. Pimpinan Tertinggi, M.T.',
            'role' => 'pimpinan',
            'email' => 'pimpinan@bpjn.go.id',
            'no_hp' => '08111111111',
            'pangkat_golongan' => 'Pembina Utama (IV/e)',
            'jabatan' => 'Kepala Balai',
            'unit_kerja' => 'BPJN',
            'status_kepegawaian' => 'PNS',
        ]);
    }
}