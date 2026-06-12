<?php

namespace App\Services;

use App\Models\Pelanggan;
use Illuminate\Pagination\LengthAwarePaginator;

class PelangganService
{
    public function getAll(?string $search): LengthAwarePaginator
    {
        return Pelanggan::query()
            ->when($search, function ($query, $search) {
                $query->where('nama_pelanggan', 'like', "%{$search}%")
                      ->orWhere('kode_pelanggan', 'like', "%{$search}%")
                      ->orWhere('kota', 'like', "%{$search}%");
            })
            ->orderBy('nama_pelanggan')
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
}