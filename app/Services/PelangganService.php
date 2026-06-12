<?php

namespace App\Services;

use App\Models\Pelanggan;
use Illuminate\Pagination\LengthAwarePaginator;

class PelangganService
{
    /**
     * Get all users with optional search filter and pagination.
     */
   

 public function getPelangganOptions()
    {
        return Pelanggan::orderBy('kode_pelanggan')->get();
    }
    public function getAll(?string $search): LengthAwarePaginator
    {
        return Pelanggan::query()
            ->when($search, function ($query, $search) {
                $query->where('nama_pelanggan', 'like', "%{$search}%")
                      ->orWhere('kode_pelanggan', 'like', "%{$search}%")
                      ->orWhere('kota', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();
    }

    public function create(array $data): Pelanggan
    {
        return Pelanggan::create($data);
    }

    public function update(Pelanggan $pelanggan, array $data): Pelanggan
    {
        $pelanggan->update($data);
        return $pelanggan;
    }

    public function delete(Pelanggan $pelanggan): void
    {
        $pelanggan->delete();
    }

    public function getPelangganById(int $id): ?Pelanggan
    {
        return Pelanggan::where('id_pelanggan', $id)->first();
    }
}