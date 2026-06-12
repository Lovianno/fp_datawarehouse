<?php

namespace App\Services;

use App\Models\Penjualan;
use Illuminate\Support\Facades\DB;

class PenjualanService
{
    /**
     * Get all penjualan with optional search filter and pagination.
     */
    public function getAll(?string $search = null, int $perPage = 10)
    {
         $query = Penjualan::query()->with('produk', 'pelanggan');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereRelation('produk', 'nama_produk', 'like', "%{$search}%");
                $q->orWhereRelation('pelanggan', 'nama_pelanggan', 'like', "%{$search}%");
            });
        }

        return $query->orderByDesc('created_at')
            ->paginate($perPage);
    }

    /**
     * Create a new penjualan.
     */
   // Service - biarkan exception propagate naik
public function create(array $data): Penjualan
{
    return DB::transaction(function () use ($data) {
        $data['total_harga'] = $data['jumlah'] * $data['harga_satuan'];
        return Penjualan::query()->create($data);
    });
}

    /**
     * Update an existing penjualan.
     */
   
}