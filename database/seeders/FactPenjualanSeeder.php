<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FactPenjualanSeeder extends Seeder
{
    public function run(): void
    {
        /**
         * Mapping ke surrogate key dimensi:
         *  id_penjualan  → id di tabel penjualan (OLTP)
         *  id_pelanggan  → id di dim_pelanggan  (urutan insert = 1-15)
         *  id_produk     → id di dim_produk     (urutan insert = 1-15)
         *  id_waktu      → id di dim_waktu      (urutan insert = 1-15, sesuai urutan tanggal)
         *
         * [id_penjualan, id_pelanggan, id_produk, id_waktu, jumlah, harga_satuan, tanggal_created]
         */
        $data = [
            [1,  3,  1,  1, 1, 8500000.00, '2024-01-05'],
            [2,  7,  2,  2, 3,  250000.00, '2024-01-12'],
            [3,  1,  3,  3, 2,  950000.00, '2024-02-03'],
            [4,  5,  4,  4, 1, 2100000.00, '2024-02-18'],
            [5,  9,  5,  5, 2, 1800000.00, '2024-03-07'],
            [6,  2,  6,  6, 1, 1200000.00, '2024-03-22'],
            [7,  11, 7,  7, 1, 1350000.00, '2024-04-10'],
            [8,  4,  8,  8, 1, 4200000.00, '2024-04-25'],
            [9,  6,  9,  9, 2,  850000.00, '2024-05-08'],
            [10, 13, 10, 10, 5,  85000.00, '2024-05-20'],
            [11, 8,  11, 11, 2, 750000.00, '2024-06-03'],
            [12, 15, 12, 12, 3, 320000.00, '2024-06-17'],
            [13, 10, 13, 13, 4, 175000.00, '2024-07-09'],
            [14, 12, 14, 14, 2, 450000.00, '2024-07-28'],
            [15, 14, 15, 15, 1, 950000.00, '2024-08-14'],
        ];

        $rows = [];
        foreach ($data as [$id_penj, $id_pelanggan, $id_produk, $id_waktu, $jumlah, $harga_satuan, $tgl]) {
            $rows[] = [
                'id_penjualan' => $id_penj,
                'id_pelanggan' => $id_pelanggan,
                'id_produk'    => $id_produk,
                'id_waktu'     => $id_waktu,
                'jumlah'       => $jumlah,
                'harga_satuan' => $harga_satuan,
                'total_harga'  => $jumlah * $harga_satuan,
                'created_at'   => $tgl . ' 08:00:00',
                'updated_at'   => $tgl . ' 08:00:00',
            ];
        }

        DB::table('fact_penjualan')->insert($rows);
    }
}
