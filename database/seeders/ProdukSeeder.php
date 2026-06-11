<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['PRD-001', 'Laptop ASUS VivoBook 14',     'Elektronik',    8500000.00],
            ['PRD-002', 'Mouse Wireless Logitech M235', 'Elektronik',    250000.00],
            ['PRD-003', 'Keyboard Mechanical Keychron', 'Elektronik',    950000.00],
            ['PRD-004', 'Monitor LG 24 inch FHD',       'Elektronik',   2100000.00],
            ['PRD-005', 'Kursi Ergonomis Ergotec',      'Furniture',    1800000.00],
            ['PRD-006', 'Meja Kantor Minimalis',        'Furniture',    1200000.00],
            ['PRD-007', 'Printer Canon PIXMA G2020',    'Elektronik',   1350000.00],
            ['PRD-008', 'Headset Sony WH-1000XM5',      'Elektronik',   4200000.00],
            ['PRD-009', 'Webcam Logitech C920',         'Elektronik',    850000.00],
            ['PRD-010', 'Flashdisk SanDisk 64GB',       'Aksesori',       85000.00],
            ['PRD-011', 'Hard Disk Seagate 1TB',        'Elektronik',    750000.00],
            ['PRD-012', 'Tas Laptop Thinkpad 14"',      'Aksesori',      320000.00],
            ['PRD-013', 'Lampu Meja LED Philips',       'Peralatan',     175000.00],
            ['PRD-014', 'Power Bank Anker 20000mAh',   'Elektronik',    450000.00],
            ['PRD-015', 'Rak Buku Kayu Jati',           'Furniture',    950000.00],
        ];

        $rows = [];
        foreach ($data as [$kode, $nama, $kategori, $harga]) {
            $rows[] = [
                'kode_produk'   => $kode,
                'nama_produk'   => $nama,
                'kategori'      => $kategori,
                'harga'         => $harga,
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
        }

        DB::table('produk')->insert($rows);
    }
}
