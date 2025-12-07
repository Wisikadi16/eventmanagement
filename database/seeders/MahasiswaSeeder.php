<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $namaPria = [
            'Ahmad Fauzi', 'Budi Santoso', 'Eko Prasetyo', 'Gilang Ramadhan', 'Irfan Hakim',
            'Kevin Anggara', 'Muhammad Rizki', 'Andi Wijaya', 'Dimas Pratama', 'Reza Firmansyah',
            'Arief Rahman', 'Bayu Setiawan', 'Faisal Akbar', 'Hendra Gunawan', 'Ilham Maulana',
            'Joko Widodo', 'Kurniawan Dwi', 'Lukman Hakim', 'Maman Suryaman', 'Nanda Pratama',
            'Omar Abdullah', 'Putra Mahardika', 'Qori Hamdani', 'Rendi Saputra', 'Samsul Bahri',
            'Teguh Santoso', 'Umar Faruq', 'Vino Bastian', 'Wahyu Hidayat', 'Yusuf Mansur',
            'Zainal Abidin', 'Adi Nugroho', 'Bambang Pamungkas', 'Candra Wijaya', 'Doni Setiawan',
            'Erick Thohir', 'Fadli Zon', 'Gerry Mahesa', 'Haris Azhar', 'Ivan Gunawan',
            'Jefri Nichol', 'Kamal Nasrullah', 'Lucky Hakim', 'Mulyadi Tamsir', 'Nino Fernandez',
            'Oka Antara', 'Pandu Purnama', 'Qomar Zaman', 'Raffi Ahmad', 'Satria Bergitar'
        ];

        $namaWanita = [
            'Siti Nurhaliza', 'Dewi Lestari', 'Farah Diba', 'Hana Safitri', 'Julia Amelia',
            'Linda Wijaya', 'Nadya Hutagalung', 'Ayu Ting Ting', 'Citra Kirana', 'Dian Sastro',
            'Eka Nusa Pertiwi', 'Fitri Tropica', 'Gita Gutawa', 'Hesti Purwadinata', 'Intan Nuraini',
            'Jessica Iskandar', 'Kartika Putri', 'Luna Maya', 'Maudy Ayunda', 'Nagita Slavina',
            'Olla Ramlan', 'Prilly Latuconsina', 'Qory Sandioriva', 'Raline Shah', 'Sandra Dewi',
            'Titi Kamal', 'Ucie Sucita', 'Velove Vexia', 'Wulan Guritno', 'Yuki Kato',
            'Zaskia Adya Mecca', 'Acha Septriasa', 'Bunga Citra Lestari', 'Chelsea Islan', 'Dinda Hauw',
            'Emma Waroka', 'Fanny Fabriana', 'Gracia Indri', 'Hannah Al Rashid', 'Isyana Sarasvati',
            'Jennifer Bachdim', 'Karina Salim', 'Laudya Cynthia Bella', 'Michelle Ziudith', 'Nikita Willy',
            'Oline Mendeng', 'Paula Verhoeven', 'Queennara Azzahra', 'Rossa Roslaina', 'Syahrini Ashaf'
        ];

        $kota = [
            'Jakarta', 'Bandung', 'Surabaya', 'Semarang', 'Yogyakarta', 'Malang', 'Bogor', 'Depok',
            'Tangerang', 'Bekasi', 'Solo', 'Medan', 'Palembang', 'Makassar', 'Denpasar',
            'Banjarmasin', 'Samarinda', 'Pontianak', 'Balikpapan', 'Manado', 'Padang', 'Pekanbaru',
            'Jambi', 'Bengkulu', 'Lampung', 'Serang', 'Cirebon', 'Tasikmalaya', 'Purwokerto', 'Magelang'
        ];

        $jalan = [
            'Jl. Merdeka', 'Jl. Gatot Subroto', 'Jl. Sudirman', 'Jl. Ahmad Yani', 'Jl. Diponegoro',
            'Jl. Veteran', 'Jl. Pahlawan', 'Jl. Pemuda', 'Jl. Proklamasi', 'Jl. Kartini',
            'Jl. Asia Afrika', 'Jl. Thamrin', 'Jl. Imam Bonjol', 'Jl. Gajah Mada', 'Jl. Hayam Wuruk',
            'Jl. Cikini Raya', 'Jl. Cendana', 'Jl. Melati', 'Jl. Anggrek', 'Jl. Mawar',
            'Jl. Kenanga', 'Jl. Flamboyan', 'Jl. Dahlia', 'Jl. Teratai', 'Jl. Cempaka'
        ];

        $golDarah = ['A', 'B', 'AB', 'O', '-'];

        $mahasiswas = [];
        $counter = 1;

        // Generate data untuk 4 angkatan
        for ($angkatan = 2021; $angkatan <= 2024; $angkatan++) {
            // Tentukan jumlah mahasiswa per angkatan
            $jumlahMhs = 25; // 25 mahasiswa per angkatan = 100 total

            for ($i = 0; $i < $jumlahMhs; $i++) {
                $jenisKelamin = $i % 2 == 0 ? 'L' : 'P';
                $nama = $jenisKelamin == 'L'
                    ? $namaPria[array_rand($namaPria)]
                    : $namaWanita[array_rand($namaWanita)];

                // Angkatan 2021-2022 ada yang sudah lulus
                $isLulus = false;
                $tanggalLulus = null;

                if ($angkatan == 2021) {
                    // 80% dari angkatan 2021 sudah lulus
                    $isLulus = $i < 20;
                    $tanggalLulus = $isLulus ? sprintf('%d-%02d-01', 2024 + rand(0, 1), rand(6, 10)) : null;
                } elseif ($angkatan == 2022) {
                    // 40% dari angkatan 2022 sudah lulus
                    $isLulus = $i < 10;
                    $tanggalLulus = $isLulus ? sprintf('2024-%02d-01', rand(10, 12)) : null;
                }

                $bulanMasuk = rand(8, 9); // Agustus atau September
                $tanggalMasuk = sprintf('%d-%02d-%02d', $angkatan, $bulanMasuk, rand(1, 28));

                $mahasiswas[] = [
                    'nim' => sprintf('%d%03d', $angkatan, $counter),
                    'nama' => $nama,
                    'angkatan' => $angkatan,
                    'jenis_kelamin' => $jenisKelamin,
                    'alamat' => $jalan[array_rand($jalan)] . ' No. ' . rand(1, 200),
                    'kabupaten_kota' => $kota[array_rand($kota)],
                    'golongan_darah' => $golDarah[array_rand($golDarah)],
                    'tanggal_masuk' => $tanggalMasuk,
                    'is_lulus' => $isLulus,
                    'tanggal_lulus' => $tanggalLulus,
                ];

                $counter++;
                if ($counter > 999) $counter = 1; // Reset counter if exceeds 3 digits
            }
        }

        // Shuffle untuk variasi data
        shuffle($mahasiswas);

        // Reset NIM agar sequential per angkatan
        $nimCounter = [];
        foreach ($mahasiswas as &$mhs) {
            $angkatan = $mhs['angkatan'];
            if (!isset($nimCounter[$angkatan])) {
                $nimCounter[$angkatan] = 1;
            }
            $mhs['nim'] = sprintf('%d%03d', $angkatan, $nimCounter[$angkatan]);
            $nimCounter[$angkatan]++;
        }

        foreach ($mahasiswas as $mahasiswa) {
            Mahasiswa::create($mahasiswa);
        }
    }
}
