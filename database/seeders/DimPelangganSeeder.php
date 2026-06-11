<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DimPelangganSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['PLG-001', 'Budi Santoso',      'L', 'Surabaya'],
            ['PLG-002', 'Siti Rahayu',       'P', 'Sidoarjo'],
            ['PLG-003', 'Ahmad Fauzi',       'L', 'Malang'],
            ['PLG-004', 'Dewi Permata',      'P', 'Gresik'],
            ['PLG-005', 'Eko Prasetyo',      'L', 'Pasuruan'],
            ['PLG-006', 'Fitri Handayani',   'P', 'Mojokerto'],
            ['PLG-007', 'Gunawan Wibowo',    'L', 'Jember'],
            ['PLG-008', 'Hana Kusuma',       'P', 'Kediri'],
            ['PLG-009', 'Irfan Hakim',       'L', 'Blitar'],
            ['PLG-010', 'Juwita Sari',       'P', 'Madiun'],
            ['PLG-011', 'Kurniawan Adi',     'L', 'Banyuwangi'],
            ['PLG-012', 'Lestari Ningrum',   'P', 'Probolinggo'],
            ['PLG-013', 'Muhammad Rizky',    'L', 'Tuban'],
            ['PLG-014', 'Nurul Hidayah',     'P', 'Lamongan'],
            ['PLG-015', 'Oka Putranto',      'L', 'Bojonegoro'],
        ];

        $rows = [];
        foreach ($data as [$kode, $nama, $gender, $kota]) {
            $rows[] = [
                'kode_pelanggan' => $kode,
                'nama_pelanggan' => $nama,
                'jenis_kelamin'  => $gender,
                'kota'           => $kota,
                'created_at'     => now(),
                'updated_at'     => now(),
            ];
        }

        DB::table('dim_pelanggan')->insert($rows);
    }
}
