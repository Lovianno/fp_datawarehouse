<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DimWaktuSeeder extends Seeder
{
    public function run(): void
    {
        // Tanggal transaksi dari PenjualanSeeder + beberapa tambahan untuk kelengkapan dimensi waktu
        $tanggal = [
            '2024-01-05',
            '2024-01-12',
            '2024-02-03',
            '2024-02-18',
            '2024-03-07',
            '2024-03-22',
            '2024-04-10',
            '2024-04-25',
            '2024-05-08',
            '2024-05-20',
            '2024-06-03',
            '2024-06-17',
            '2024-07-09',
            '2024-07-28',
            '2024-08-14',
        ];

        $namaBulan = [
            1  => 'Januari',   2  => 'Februari', 3  => 'Maret',
            4  => 'April',     5  => 'Mei',       6  => 'Juni',
            7  => 'Juli',      8  => 'Agustus',   9  => 'September',
            10 => 'Oktober',   11 => 'November',  12 => 'Desember',
        ];

        $rows = [];
        foreach ($tanggal as $tgl) {
            $dt     = \Carbon\Carbon::parse($tgl);
            $bulan  = (int) $dt->format('n');
            $kuartal = (int) ceil($bulan / 3);

            $rows[] = [
                'tanggal'    => $tgl,
                'tahun'      => (int) $dt->format('Y'),
                'bulan'      => $bulan,
                'bulan_nama' => $namaBulan[$bulan],
                'kuartal'    => $kuartal,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('dim_waktu')->insert($rows);
    }
}
