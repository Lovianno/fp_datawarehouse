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
        Schema::create('dim_pelanggan', function (Blueprint $table) {
            $table->id('id_pelanggan');
            $table->integer('id_pelanggan_asli')->unique();
            $table->string('kode_pelanggan');
            $table->string('nama_pelanggan');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('kota');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dim_pelanggan');
    }
};
