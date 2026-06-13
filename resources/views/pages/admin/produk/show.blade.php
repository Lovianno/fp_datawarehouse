@extends('layouts.admin')

@section('title', 'Detail Produk')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('produk.index') }}" class="text-decoration-none">Data Produk</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail Produk</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm border-0 mb-4 p-3">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold fs-4">Detail Produk</h5>
                <div class="d-flex gap-2">
                  
                    <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Kode Produk</label>
                    <input type="text" class="form-control" value="{{ $produk->kode_produk }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" value="{{ $produk->nama_produk }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" class="form-control" value="{{ $produk->kategori }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="text" class="form-control " value="Rp {{ number_format($produk->harga, 0, ',', '.') }}" readonly>
                </div>
                <hr>
                <div class="mb-3">
                    <label class="form-label">Dibuat Pada</label>
                    <input type="text" class="form-control" value="{{ $produk->created_at->translatedFormat('d F Y, H:i') }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Diperbarui Pada</label>
                    <input type="text" class="form-control" value="{{ $produk->updated_at->translatedFormat('d F Y, H:i') }}" readonly>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // No JS needed for show view
    </script>
@endpush