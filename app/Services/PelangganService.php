<?php

namespace App\Services;

use App\Models\Pelanggan;

class PelangganService
{
    /**
     * Get all users with optional search filter and pagination.
     */
   
    public function getPelangganOptions()
    {
        return Pelanggan::orderBy('kode_pelanggan')->get();
    }
}