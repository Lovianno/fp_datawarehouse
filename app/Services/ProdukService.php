<?php

namespace App\Services;

use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class ProdukService
{
    public function getAll(?string $search = null, int $perPage = 10)
    {
        return Produk::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('kode_produk', 'like', "%{$search}%")
                      ->orWhere('nama_produk', 'like', "%{$search}%")
                      ->orWhere('kategori', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('updated_at')
            ->paginate($perPage);
    }

    public function create(array $data): Produk
    {
        DB::beginTransaction();
        try {
            $produk = Produk::query()->create($data);
            DB::commit();
            return $produk;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(Produk $produk, array $data): bool
    {
        DB::beginTransaction();
        try {
            $result = $produk->update($data);
            DB::commit();
            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(Produk $produk): ?bool
    {
        return $produk->delete();
    }
}
