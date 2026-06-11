<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    public function run(): void
    {
        // [id_produk, id_pelanggan, jumlah, harga_satuan, tanggal_transaksi]
        $data = [
            [1,  3,  1, 8500000.00, '2024-01-05'],
            [2,  7,  3,  250000.00, '2024-01-12'],
            [3,  1,  2,  950000.00, '2024-02-03'],
            [4,  5,  1, 2100000.00, '2024-02-18'],
            [5,  9,  2, 1800000.00, '2024-03-07'],
            [6,  2,  1, 1200000.00, '2024-03-22'],
            [7,  11, 1, 1350000.00, '2024-04-10'],
            [8,  4,  1, 4200000.00, '2024-04-25'],
            [9,  6,  2,  850000.00, '2024-05-08'],
            [10, 13, 5,   85000.00, '2024-05-20'],
            [11, 8,  2,  750000.00, '2024-06-03'],
            [12, 15, 3,  320000.00, '2024-06-17'],
            [13, 10, 4,  175000.00, '2024-07-09'],
            [14, 12, 2,  450000.00, '2024-07-28'],
            [15, 14, 1,  950000.00, '2024-08-14'],
        ];

        $rows = [];
        foreach ($data as [$id_produk, $id_pelanggan, $jumlah, $harga_satuan, $tgl]) {
            $rows[] = [
                'id_produk'    => $id_produk,
                'id_pelanggan' => $id_pelanggan,
                'jumlah'       => $jumlah,
                'harga_satuan' => $harga_satuan,
                'total_harga'  => $jumlah * $harga_satuan,
                'created_at'   => $tgl . ' 08:00:00',
                'updated_at'   => $tgl . ' 08:00:00',
            ];
        }

        DB::table('penjualan')->insert($rows);
    }
}
