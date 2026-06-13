@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card" style="max-width: 700px; margin: auto;">
        <div class="card-header d-flex align-items-center gap-2">
            <a href="{{ route('produk.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h5 class="mb-0">Edit Produk</h5>
        </div>

        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('produk.update', $produk->id_produk) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="kode_produk" class="form-label">Kode Produk <span class="text-danger">*</span></label>
                    <input type="text" id="kode_produk" name="kode_produk"
                           class="form-control @error('kode_produk') is-invalid @enderror"
                           value="{{ old('kode_produk', $produk->kode_produk) }}">
                    @error('kode_produk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_produk" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                    <input type="text" id="nama_produk" name="nama_produk"
                           class="form-control @error('nama_produk') is-invalid @enderror"
                           value="{{ old('nama_produk', $produk->nama_produk) }}">
                    @error('nama_produk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select id="kategori" name="kategori"
                            class="form-select @error('kategori') is-invalid @enderror">
                        @foreach(['Elektronik', 'Furniture', 'Aksesori', 'Peralatan'] as $kat)
                            <option value="{{ $kat }}"
                                {{ old('kategori', $produk->kategori) === $kat ? 'selected' : '' }}>
                                {{ $kat }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="harga" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" id="harga" name="harga"
                               class="form-control @error('harga') is-invalid @enderror"
                               value="{{ old('harga', $produk->harga) }}"
                               min="0" step="1000">
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-save me-1"></i> Update
                    </button>
                    <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
