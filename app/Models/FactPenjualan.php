<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FactPenjualan extends Model
{
    protected $table = 'fact_penjualan';
    protected $primaryKey = 'id_penjualan';
    protected $guarded = ['id_penjualan'];

    public function produk()
    {
        return $this->belongsTo(DimProduk::class, 'id_produk', 'id_produk');
    }

    public function pelanggan()
    {
        return $this->belongsTo(DimPelanggan::class, 'id_pelanggan', 'id_pelanggan');    
    }

    public function waktu()
    {
        return $this->belongsTo(DimWaktu::class, 'id_waktu', 'id_waktu');
    }
}
