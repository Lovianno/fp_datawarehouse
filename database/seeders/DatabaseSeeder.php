<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PelangganSeeder::class,
            ProdukSeeder::class,
            PenjualanSeeder::class,

            // OLAP Dimension & Fact Tables
            // DimPelangganSeeder::class,
            // DimWaktuSeeder::class,
            // DimProdukSeeder::class,
            // FactPenjualanSeeder::class,
        ]);
    }
}
