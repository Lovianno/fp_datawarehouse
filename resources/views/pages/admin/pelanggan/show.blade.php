@extends('layouts.admin')

@section('title', 'Detail Pelanggan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}" class="text-decoration-none">Data Pelanggan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail Pelanggan</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm border-0 mb-4 p-3">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold fs-4">Detail Data Pelanggan</h5>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Kode Pelanggan</label>
                    <input type="text" class="form-control" value="{{ $pelanggan->kode_pelanggan }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Pelanggan</label>
                    <input type="text" class="form-control" value="{{ $pelanggan->nama_pelanggan }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <input type="text" class="form-control" value="{{ $pelanggan->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kota</label>
                    <input type="text" class="form-control" value="{{ $pelanggan->kota }}" readonly>
                </div>
                <hr>
                <div class="mb-3">
                    <label class="form-label">Dibuat Pada</label>
                    <input type="text" class="form-control" value="{{ $pelanggan->created_at->translatedFormat('d F Y, H:i') }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Diperbarui Pada</label>
                    <input type="text" class="form-control" value="{{ $pelanggan->updated_at->translatedFormat('d F Y, H:i') }}" readonly>
                </div>
            </div>
        </div>
    </div>
@endsection