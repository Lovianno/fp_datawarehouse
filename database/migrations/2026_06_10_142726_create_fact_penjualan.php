<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fact_penjualan', function (Blueprint $table) {
            $table->id('id_penjualan');
            $table->foreignId('id_pelanggan')->constrained('dim_pelanggan', 'id_pelanggan')->onDelete('cascade');
            $table->foreignId('id_produk')->constrained('dim_produk', 'id_produk')->onDelete('cascade');
            $table->foreignId('id_waktu')->constrained('dim_waktu', 'id_waktu')->onDelete('cascade');
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 10, 2);
            $table->decimal('total_harga', 10, 2);
            $table->timestamps();

            $table->unique(['id_pelanggan', 'id_produk', 'id_waktu'], 'fact_penjualan_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fact_penjualan');
    }
};
