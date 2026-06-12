@extends('layouts.admin')

@section('title', 'Detail Penjualan')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('penjualan.index') }}" class="text-decoration-none">Data Penjualan</a></li>
	<li class="breadcrumb-item active" aria-current="page">Detail Data Penjualan</li>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="card shadow-sm border-0 mb-4 p-3">
			<div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
				<h5 class="mb-0 fw-semibold fs-4">Detail Data Penjualan</h5>
				<a href="{{ route('penjualan.index') }}" class="btn btn-secondary">
					<i class="bi bi-arrow-left"></i> Kembali
				</a>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6 mb-3">
						<label class="form-label">Kode Pelanggan</label>
						<input type="text" class="form-control" value="{{ $penjualan->pelanggan->kode_pelanggan }}" readonly>
					</div>
					<div class="col-md-6 mb-3">
						<label class="form-label">Nama Pelanggan</label>
						<input type="text" class="form-control" value="{{ $penjualan->pelanggan->nama_pelanggan }}" readonly>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6 mb-3">
						<label class="form-label">Kode Produk</label>
						<input type="text" class="form-control" value="{{ $penjualan->produk->kode_produk }}" readonly>
					</div>
					<div class="col-md-6 mb-3">
						<label class="form-label">Nama Produk</label>
						<input type="text" class="form-control" value="{{ $penjualan->produk->nama_produk }}" readonly>
					</div>
				</div>

				<hr>

				<div class="row">
					<div class="col-md-4 mb-3">
						<label class="form-label">Jumlah</label>
						<input type="text" class="form-control" value="{{ $penjualan->jumlah }}" readonly>
					</div>
					<div class="col-md-4 mb-3">
						<label class="form-label">Harga Satuan</label>
						<input type="text" class="form-control" value="Rp {{ number_format($penjualan->harga_satuan, 0, ',', '.') }}" readonly>
					</div>
					<div class="col-md-4 mb-3">
						<label class="form-label">Total Harga</label>
						<input type="text" class="form-control fw-bold" value="Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}" readonly>
					</div>
				</div>

				<hr>

				<div class="row">
					<div class="col-md-6 mb-3">
						<label class="form-label">Dibuat Pada</label>
						<input type="text" class="form-control" value="{{ $penjualan->created_at->translatedFormat('d F Y, H:i') }}" readonly>
					</div>
					<div class="col-md-6 mb-3">
						<label class="form-label">Diperbarui Pada</label>
						<input type="text" class="form-control" value="{{ $penjualan->updated_at->translatedFormat('d F Y, H:i') }}" readonly>
					</div>
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