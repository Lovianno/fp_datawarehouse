@extends('layouts.admin')

@section('title', 'Detail Produk')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card" style="max-width: 600px; margin: auto;">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('produk.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <h5 class="mb-0">Detail Produk</h5>
            </div>
            <a href="{{ route('produk.edit', $produk->id_produk) }}" class="btn btn-sm btn-warning">
                <i class="bi bi-pencil me-1"></i> Edit
            </a>
        </div>

        <div class="card-body">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <th style="width: 40%">Kode Produk</th>
                        <td>
                            <span class="badge bg-primary">{{ $produk->kode_produk }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Nama Produk</th>
                        <td>{{ $produk->nama_produk }}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>
                            <span class="badge bg-info">{{ $produk->kategori }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td class="fw-semibold text-success">
                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <th>Ditambahkan</th>
                        <td>{{ $produk->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Diperbarui</th>
                        <td>{{ $produk->updated_at->format('d M Y, H:i') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
