@extends('layouts.admin')

@section('title', 'Ubah Pengguna')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="text-decoration-none">Data Pengguna</a></li>
	<li class="breadcrumb-item active" aria-current="page">Ubah Pengguna</li>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="card shadow-sm border-0 mb-4 p-3">
			<div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
				<h5 class="mb-0 fw-semibold fs-4">Ubah Pengguna</h5>
				<a href="{{ route('users.index') }}" class="btn btn-secondary">
					<i class="bi bi-arrow-left"></i> Batal
				</a>
			</div>
			<div class="card-body">
				<form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
					@csrf
					@method('PUT')

					{{-- NAMA --}}
					<div class="mb-3">
						<label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
						<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required placeholder="Masukkan nama lengkap"
							value="{{ old('name', $user->name) }}">
						@error('name')
							<div class="invalid-feedback d-block">{{ $message }}</div>
						@enderror
					</div>

					{{-- EMAIL --}}
					<div class="mb-3">
						<label for="email" class="form-label">Email <span class="text-danger">*</span></label>
						<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required placeholder="Masukkan email"
							value="{{ old('email', $user->email) }}">
						@error('email')
							<div class="invalid-feedback d-block">{{ $message }}</div>
						@enderror
					</div>


					{{-- PASSWORD --}}
					<div class="mb-3">
						<label for="password" class="form-label">Password <span class="text-muted">(Opsional)</span></label>
						<div class="input-group">
							<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
								placeholder="Biarkan kosong jika tidak ingin mengubah password">
							<button type="button" class="btn password-toggle-btn" id="togglePassword">
								<i class="bi bi-eye-slash"></i>
							</button>
						</div>
						@error('password')
							<div class="invalid-feedback d-block">{{ $message }}</div>
						@enderror
					</div>

					{{-- SUBMIT BUTTON --}}
					<div class="d-flex justify-content-end mt-4">
						<button type="submit" class="btn btn-app-secondary" id="submitUserBtn">
							<span class="button-content">
								Simpan
							</span>
							<span class="spinner-content d-none">
								<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
								Sedang Menyimpan...
							</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	@endsection

	@push('scripts')
		<script>
			// No photo/teacher JS needed for migration-aligned users

			const passwordInput = document.getElementById("password");
			const togglePassword = document.getElementById("togglePassword");

			togglePassword.addEventListener("click", function() {
				const type = passwordInput.type === "password" ? "text" : "password";
				passwordInput.type = type;
				this.querySelector("i").classList.toggle("bi-eye");
				this.querySelector("i").classList.toggle("bi-eye-slash");
			});

			const userForm = document.querySelector('form[action="{{ route('users.update', $user) }}"]');
			const submitUserBtn = document.getElementById('submitUserBtn');
			if (userForm && submitUserBtn) {
				userForm.addEventListener('submit', function() {
					submitUserBtn.disabled = true;
					submitUserBtn.querySelector('.button-content').classList.add('d-none');
					submitUserBtn.querySelector('.spinner-content').classList.remove('d-none');
				});
			}
		</script>
	@endpush
