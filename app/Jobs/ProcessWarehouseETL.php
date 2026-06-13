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
            $table->integer('jumlah');
            $table->decimal('total_harga', 15, 2);
            $table->timestamp('created_at');
        });
    }

    private function extractAndTransformToStaging(): void
    {
        DB::statement("
            INSERT INTO temp_staging_penjualan (id_pelanggan, nama_pelanggan, id_produk, nama_produk, jumlah, total_harga, created_at)
            SELECT p.id_pelanggan, pl.nama_pelanggan, p.id_produk, pr.nama_produk, p.jumlah, p.total_harga, p.created_at
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
            INSERT INTO dim_pelanggan (id_pelanggan, kode_pelanggan, nama_pelanggan, jenis_kelamin, kota, created_at, updated_at)
            SELECT DISTINCT id_pelanggan, kode_pelanggan, nama_pelanggan, jenis_kelamin, kota, ?, ? FROM pelanggan
            ON DUPLICATE KEY UPDATE kode_pelanggan = VALUES(kode_pelanggan), nama_pelanggan = VALUES(nama_pelanggan), jenis_kelamin = VALUES(jenis_kelamin), kota = VALUES(kota), updated_at = ?
        ", [$now, $now, $now]);

        // Sync Dimensi Produk
        DB::statement("
            INSERT INTO dim_produk (id_produk, kode_produk, nama_produk, kategori, harga, created_at, updated_at)
            SELECT DISTINCT id_produk, kode_produk, nama_produk, kategori, harga, ?, ? FROM produk
            ON DUPLICATE KEY UPDATE kategori = VALUES(kategori), harga = VALUES(harga), updated_at = ?
        ", [$now, $now, $now]);

        // Sync Dimensi Waktu
        DB::statement("
            INSERT IGNORE INTO dim_waktu (tanggal, tahun, bulan, bulan_nama, kuartal, created_at, updated_at)
            SELECT DISTINCT 
                DATE(created_at), YEAR(created_at), MONTH(created_at), MONTHNAME(created_at), CEIL(MONTH(created_at) / 3), ?, ?
            FROM penjualan
        ", [$now, $now]);

        // Sync Tabel Fakta Penjualan
        DB::statement("
            INSERT INTO fact_penjualan (id_pelanggan, id_produk, id_waktu, jumlah, harga_satuan, total_harga, created_at, updated_at)
            SELECT p.id_pelanggan, p.id_produk, dw.id_waktu, p.jumlah, p.harga_satuan, p.total_harga, ?, ?
            FROM penjualan p
            JOIN dim_waktu dw ON dw.tanggal = DATE(p.created_at)
            ON DUPLICATE KEY UPDATE jumlah = VALUES(jumlah), harga_satuan = VALUES(harga_satuan), total_harga = VALUES(total_harga), updated_at = ?
        ", [$now, $now, $now]);
    }
}
