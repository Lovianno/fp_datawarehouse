<?php

namespace App\Services;

use App\Models\Produk;

class ProdukService
{
    /**
     * Get all users with optional search filter and pagination.
     */
    public function getProdukOptions()
    {
        return Produk::orderBy('kode_produk')->get();
    }
}