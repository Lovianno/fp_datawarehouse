@extends('layouts.admin')

@section('title', 'Tambah Produk')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('produk.index') }}" class="text-decoration-none">Data Produk</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Produk</li>
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="container-fluid">
        <div class="card shadow-sm border-0 mb-4 p-3">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold fs-4">Tambah Produk</h5>
                <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i> Batal
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('produk.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Kode Produk <span class="text-danger">*</span></label>
                        <input type="text" name="kode_produk" class="form-control @error('kode_produk') is-invalid @enderror"
                            required placeholder="Contoh: PRD-016" value="{{ old('kode_produk') }}">
                        @error('kode_produk')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Produk <span class="text-danger">*</span></label>
                        <input type="text" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror"
                            required placeholder="Nama lengkap produk" value="{{ old('nama_produk') }}">
                        @error('nama_produk')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                            <option value="" disabled {{ old('kategori') ? '' : 'selected' }}>-- Pilih Kategori --</option>
                            @foreach ($kategoriOptions as $kat)
                                <option value="{{ $kat }}" {{ old('kategori') === $kat ? 'selected' : '' }}>
                                    {{ $kat }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
                                required min="0" step="1000" placeholder="0" value="{{ old('harga') }}">
                            @error('harga')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-app-secondary" id="submitBtn">
                            <span class="button-content">Simpan</span>
                            <span class="spinner-content d-none">
                                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                Sedang Menyimpan...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelector('form').addEventListener('submit', function () {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.querySelector('.button-content').classList.add('d-none');
            btn.querySelector('.spinner-content').classList.remove('d-none');
        });
    </script>
@endpush