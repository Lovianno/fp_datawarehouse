<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class ProcessWarehouseETL implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct() {}

    public function handle(): void
    {
        DB::transaction(function () {
            // 1. Buat Staging Table (Temporary)
            $this->createTemporaryStagingTable();

            // 2. Extract & Transform ke Staging Table langsung via Database (Tanpa Load ke Memori PHP)
            $this->extractAndTransformToStaging();

            // 3. Load ke Tabel Dimensi & Fakta secara Massal
            $this->loadToDimensionsAndFact();
        });
    }

    private function createTemporaryStagingTable(): void
    {
        Schema::create('temp_staging_penjualan', function (Blueprint $table) {
            $table->temporary();
            $table->unsignedBigInteger('id_pelanggan');
            $table->string('nama_pelanggan');
            $table->unsignedBigInteger('id_produk');
            $table->string('nama_produk');
            $table->integer('kuantitas');
            $table->decimal('total_harga', 15, 2);
            $table->timestamp('created_at');
        });
    }

    private function extractAndTransformToStaging(): void
    {
        DB::statement("
            INSERT INTO temp_staging_penjualan (id_pelanggan, nama_pelanggan, id_produk, nama_produk, kuantitas, total_harga, created_at)
            SELECT p.id_pelanggan, pl.nama_pelanggan, p.id_produk, pr.nama_produk, p.kuantitas, p.total_harga, p.created_at
            FROM penjualan p
            JOIN pelanggan pl ON p.id_pelanggan = pl.id_pelanggan
            JOIN produk pr ON p.id_produk = pr.id_produk
        ");
    }

    private function loadToDimensionsAndFact(): void
    {
        $now = now();

        // Sync Dimensi Pelanggan
        DB::statement("
            INSERT INTO dim_pelanggan (id_pelanggan, kode_pelanggan, nama_pelanggan, created_at, updated_at)
            SELECT DISTINCT id_pelanggan, kode_pelanggan, nama_pelanggan, ?, ?, ? FROM temp_staging_penjualan
            ON DUPLICATE KEY UPDATE kode_pelanggan = VALUES(kode_pelanggan), nama_pelanggan = VALUES(nama_pelanggan), updated_at = ?
        ", [$now, $now, $now]);

        // Sync Dimensi Produk
        DB::statement("
            INSERT INTO dim_produk (id_produk, kode_produk, nama_produk, kategori, harga, created_at, updated_at)
            SELECT DISTINCT id_produk, kode_produk, nama_produk, kategori, harga, ?, ? FROM temp_staging_penjualan
            ON DUPLICATE KEY UPDATE kategori = VALUES(kategori), harga = VALUES(harga), updated_at = ?
        ", [$now, $now, $now]);

        // Sync Dimensi Waktu
        DB::statement("
            INSERT IGNORE INTO dim_waktu (id_waktu, tanggal, hari, bulan, tahun, created_at, updated_at)
            SELECT DISTINCT 
                DATE_FORMAT(created_at, '%Y%m%d'), DATE(created_at), DAY(created_at), MONTH(created_at), YEAR(created_at), ?, ?
            FROM temp_staging_penjualan
        ", [$now, $now]);

        // Sync Tabel Fakta Penjualan
        DB::statement("
            INSERT INTO fact_penjualan (id_pelanggan, id_produk, id_waktu, jumlah, harga_satuan, total_harga, created_at, updated_at)
            SELECT id_pelanggan, id_produk, DATE_FORMAT(created_at, '%Y%m%d'), jumlah, harga_satuan, total_harga, ?, ?
            FROM temp_staging_penjualan
            ON DUPLICATE KEY UPDATE jumlah = VALUES(jumlah), harga_satuan = VALUES(harga_satuan), total_harga = VALUES(total_harga), updated_at = ?
        ", [$now, $now, $now]);
    }
}
