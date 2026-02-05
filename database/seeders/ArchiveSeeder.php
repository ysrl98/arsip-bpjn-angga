<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Archive;
use App\Models\User;
use Carbon\Carbon;

class ArchiveSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID User pertama (Admin/Pegawai) untuk dijadikan uploader
        $userId = User::first()->id ?? 1;

        // --- 1. KATEGORI: PEMBAYARAN ---
        $pembayaran = [
            ['Pembayaran Termyn I Paket Preservasi Jalan A', 150000000, 'PT. Karya Banua'],
            ['Belanja Bahan Bakar Operasional Kantor', 5000000, 'SPBU Pertamina'],
            ['Pembelian ATK Triwulan I', 2500000, 'CV. Media Tulis'],
            ['Honorarium Tenaga Ahli IT Bulan Januari', 7500000, 'Ahmad Junaidi, S.Kom'],
            ['Biaya Servis Berkala Kendaraan Dinas DA 1234', 1200000, 'Bengkel Toyota'],
        ];

        foreach ($pembayaran as $idx => $item) {
            Archive::create([
                'user_id' => $userId,
                'kategori' => 'pembayaran',
                'nomor_dokumen' => 'KU.01.01/B' . ($idx + 101),
                'nama_dokumen' => $item[0],
                'tanggal_dokumen' => Carbon::now()->subDays(rand(1, 30)),
                'deskripsi' => 'Bukti pembayaran resmi untuk keperluan operasional dan proyek.',
                'file_path' => 'dummy.pdf', // File dummy
                'nominal' => $item[1],
                'penerima' => $item[2],
                'status' => 'valid', // Anggap sudah disetujui
            ]);
        }

        // --- 2. KATEGORI: SPM & SP2D ---
        $spm = [
            'SPM-LS Gaji Induk Januari 2026',
            'SP2D Uang Persediaan (UP) Tahun 2026',
            'SPM-LS Tunjangan Kinerja Desember 2025',
            'SP2D Pembayaran Retensi Paket Jembatan',
            'SPM Ganti Uang (GU) Ke-1',
        ];

        foreach ($spm as $idx => $judul) {
            Archive::create([
                'user_id' => $userId,
                'kategori' => 'spm',
                'nomor_dokumen' => 'SPM/00' . ($idx + 1) . '/2026',
                'nama_dokumen' => $judul,
                'tanggal_dokumen' => Carbon::now()->subDays(rand(1, 10)),
                'deskripsi' => 'Dokumen pencairan dana dari KPPN.',
                'file_path' => 'dummy.pdf',
                'tahun_anggaran' => '2026',
                'status' => 'pending', // Masih pending
            ]);
        }

        // --- 3. KATEGORI: PERJALANAN DINAS ---
        $sppd = [
            ['Koordinasi Program ke Kantor Pusat', 'Jakarta'],
            ['Monitoring Proyek Preservasi Jalan', 'Tanah Bumbu'],
            ['Diklat Manajemen Aset Negara', 'Bandung'],
            ['Survei Lapangan Jembatan Gantung', 'Hulu Sungai Tengah'],
            ['Rapat Koordinasi Balai Wilayah Kalimantan', 'Balikpapan'],
        ];

        foreach ($sppd as $idx => $item) {
            Archive::create([
                'user_id' => $userId,
                'kategori' => 'perjalanan_dinas',
                'nomor_dokumen' => 'ST-2026/0' . ($idx + 1),
                'nama_dokumen' => 'Surat Tugas: ' . $item[0],
                'tanggal_dokumen' => Carbon::now()->subDays(rand(5, 20)),
                'deskripsi' => 'Laporan dan rincian biaya perjalanan dinas pegawai.',
                'file_path' => 'dummy.pdf',
                'lokasi_tujuan' => $item[1],
                'status' => 'valid',
            ]);
        }

        // --- 4. KATEGORI: KONTRAK PROYEK ---
        $kontrak = [
            ['Paket Preservasi Jalan Banjarmasin - Martapura', 15000000000],
            ['Penggantian Jembatan Sei Alalak II', 25000000000],
            ['Pengawasan Teknis Jalan Nasional Wilayah I', 800000000],
            ['Rehabilitasi Drainase Jalan A. Yani', 3500000000],
            ['Pemeliharaan Rutin Jembatan Barito', 500000000],
        ];

        foreach ($kontrak as $idx => $item) {
            Archive::create([
                'user_id' => $userId,
                'kategori' => 'kontrak',
                'nomor_dokumen' => 'HK.02.03/Kontrak/' . ($idx + 1),
                'nama_dokumen' => 'Kontrak: ' . $item[0],
                'tanggal_dokumen' => Carbon::now()->subMonths(rand(1, 6)),
                'deskripsi' => 'Dokumen kontrak fisik dan adendum.',
                'file_path' => 'dummy.pdf',
                'nominal' => $item[1],
                'tahun_anggaran' => '2026',
                'status' => 'valid',
            ]);
        }

        // --- 5. KATEGORI: ANGGARAN ---
        $anggaran = [
            'DIPA Petikan Tahun Anggaran 2026',
            'Usulan Revisi Anggaran (POK) Triwulan I',
            'RKA-KL Satker PJN Wilayah I',
            'Laporan Realisasi Anggaran Bulan Januari',
            'Catatan Hasil Review APIP terkait Anggaran',
        ];

        foreach ($anggaran as $idx => $judul) {
            Archive::create([
                'user_id' => $userId,
                'kategori' => 'anggaran',
                'nomor_dokumen' => 'ANG/2026/0' . ($idx + 1),
                'nama_dokumen' => $judul,
                'tanggal_dokumen' => Carbon::now()->subDays(rand(1, 60)),
                'deskripsi' => 'Dokumen perencanaan dan pelaksanaan anggaran.',
                'file_path' => 'dummy.pdf',
                'tahun_anggaran' => '2026',
                'status' => 'valid',
            ]);
        }

        // --- 6. KATEGORI: KEPEGAWAIAN ---
        $kepegawaian = [
            'SK Kenaikan Pangkat Golongan III/d',
            'Surat Izin Cuti Tahunan Pegawai',
            'SK Penunjukkan Pejabat Pembuat Komitmen (PPK)',
            'Berkas Kenaikan Gaji Berkala (KGB)',
            'Laporan Kinerja Bulanan (SKP) Januari',
        ];

        foreach ($kepegawaian as $idx => $judul) {
            Archive::create([
                'user_id' => $userId,
                'kategori' => 'kepegawaian',
                'nomor_dokumen' => 'KP.04.01/Peg/' . ($idx + 1),
                'nama_dokumen' => $judul,
                'tanggal_dokumen' => Carbon::now()->subDays(rand(1, 15)),
                'deskripsi' => 'Arsip administrasi kepegawaian.',
                'file_path' => 'dummy.pdf',
                'status' => ($idx % 2 == 0) ? 'valid' : 'pending', // Random status
            ]);
        }
    }
}