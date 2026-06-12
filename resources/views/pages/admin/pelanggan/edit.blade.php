@extends('layouts.admin')

@section('title', 'Ubah Pelanggan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}" class="text-decoration-none">Data Pelanggan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ubah Pelanggan</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm border-0 mb-4 p-3">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold fs-4">Ubah Pelanggan</h5>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('pelanggan.update', $pelanggan) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Kode Pelanggan <span class="text-danger">*</span></label>
                        <input type="text" name="kode_pelanggan" class="form-control @error('kode_pelanggan') is-invalid @enderror"
                            required placeholder="Contoh: PLG-001" value="{{ old('kode_pelanggan', $pelanggan->kode_pelanggan) }}">
                        @error('kode_pelanggan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Pelanggan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_pelanggan" class="form-control @error('nama_pelanggan') is-invalid @enderror"
                            required placeholder="Masukkan nama lengkap" value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}">
                        @error('nama_pelanggan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                            <option value="" disabled>-- Pilih --</option>
                            <option value="L" {{ old('jenis_kelamin', $pelanggan->jenis_kelamin) === 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $pelanggan->jenis_kelamin) === 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kota <span class="text-danger">*</span></label>
                        <input type="text" name="kota" class="form-control @error('kota') is-invalid @enderror"
                            required placeholder="Masukkan kota" value="{{ old('kota', $pelanggan->kota) }}">
                        @error('kota')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
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