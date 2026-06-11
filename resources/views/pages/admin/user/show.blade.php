@extends('layouts.admin')

@section('title', 'Detail Pengguna')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="text-decoration-none">Data Pengguna</a></li>
	<li class="breadcrumb-item active" aria-current="page">Detail Data Pengguna</li>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="card shadow-sm border-0 mb-4 p-3">
			<div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
				<h5 class="mb-0 fw-semibold fs-4">Detail Data Pengguna</h5>
				<a href="{{ route('users.index') }}" class="btn btn-secondary">
					<i class="bi bi-arrow-left"></i> Kembali
				</a>
			</div>
			<div class="card-body">
				<div class="mb-3">
					<label class="form-label">Nama</label>
					<input type="text" class="form-control" value="{{ $user->name }}" readonly>
				</div>
				<div class="mb-3">
					<label class="form-label">Email</label>
					<input type="email" class="form-control" value="{{ $user->email }}" readonly>
				</div>
				<hr>
				<div class="mb-3">
					<label class="form-label">Dibuat Pada</label>
					<input type="text" class="form-control" value="{{ $user->created_at->translatedFormat('d F Y, H:i') }}" readonly>
				</div>
				<div class="mb-3">
					<label class="form-label">Diperbarui Pada</label>
					<input type="text" class="form-control" value="{{ $user->updated_at->translatedFormat('d F Y, H:i') }}" readonly>
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
