@extends('layouts.admin')

@section('title', 'Transaksi Penjualan')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('penjualan.index') }}" class="text-decoration-none">Data Penjualan</a></li>
	<li class="breadcrumb-item active" aria-current="page">Tambah Penjualan</li>
@endsection

@section('content')
	<div class="container-fluid">
		<form action="{{ route('penjualan.store') }}" method="POST" id="formPenjualan">
			@csrf

			<div class="row g-3">
				{{-- ============== KIRI: PILIH PRODUK ============== --}}
				<div class="col-lg-7">
					<div class="card shadow-sm border-0 mb-3">
						<div class="card-header bg-white border-0">
							<h5 class="mb-0 fw-semibold fs-4">
								<i class="bi bi-cart-plus me-2"></i> Transaksi Penjualan
							</h5>
						</div>
						<div class="card-body">
							<div class="row">
								{{-- PELANGGAN --}}
								<div class="col-md-12 mb-3">
									<label for="id_pelanggan" class="form-label">Pelanggan <span class="text-danger">*</span></label>
									<select name="id_pelanggan" id="id_pelanggan" class="form-select form-select-lg @error('id_pelanggan') is-invalid @enderror" required>
										<option value="">-- Pilih Pelanggan --</option>
										@foreach ($pelanggan as $p)
											<option value="{{ $p->id_pelanggan }}" {{ old('id_pelanggan') == $p->id_pelanggan ? 'selected' : '' }}>
												{{ $p->kode_pelanggan }} - {{ $p->nama_pelanggan }}
											</option>
										@endforeach
									</select>
									@error('id_pelanggan')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
							</div>

							<hr>

							<div class="row">
								{{-- PRODUK --}}
								<div class="col-md-7 mb-3">
									<label for="id_produk" class="form-label">Pilih Produk <span class="text-danger">*</span></label>
									<select name="id_produk" id="id_produk" class="form-select form-select-lg @error('id_produk') is-invalid @enderror" required>
										<option value="">-- Pilih Produk --</option>
										@foreach ($produk as $p)
											<option value="{{ $p->id_produk }}"
												data-kode="{{ $p->kode_produk }}"
												data-nama="{{ $p->nama_produk }}"
												data-kategori="{{ $p->kategori }}"
												data-harga="{{ $p->harga }}"
												{{ old('id_produk') == $p->id_produk ? 'selected' : '' }}>
												{{ $p->kode_produk }} - {{ $p->nama_produk }}
											</option>
										@endforeach
									</select>
									@error('id_produk')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

								{{-- JUMLAH --}}
								<div class="col-md-5 mb-3">
									<label for="jumlah" class="form-label">Jumlah <span class="text-danger">*</span></label>
									<div class="input-group input-group-lg">
										<button type="button" class="btn btn-outline-secondary" id="btnMinus">
											<i class="bi bi-dash-lg"></i>
										</button>
										<input type="number" name="jumlah" id="jumlah" min="1" class="form-control text-center @error('jumlah') is-invalid @enderror"
											value="{{ old('jumlah', 1) }}" required>
										<button type="button" class="btn btn-outline-secondary" id="btnPlus">
											<i class="bi bi-plus-lg"></i>
										</button>
									</div>
									@error('jumlah')
										<div class="invalid-feedback d-block">{{ $message }}</div>
									@enderror
								</div>
							</div>

							{{-- PREVIEW PRODUK DIPILIH --}}
							<div id="produkPreview" class="d-none">
								<div class="border rounded p-3 bg-light-subtle d-flex justify-content-between align-items-center flex-wrap gap-2">
									<div>
										<span class="badge text-bg-secondary mb-1" id="previewKode">-</span>
										<h6 class="mb-1 fw-semibold" id="previewNama">-</h6>
										<small class="text-muted" id="previewKategori">-</small>
									</div>
									<div class="text-end">
										<small class="text-muted d-block">Harga Satuan</small>
										<span class="fs-5 fw-bold text-primary" id="previewHarga">Rp 0</span>
									</div>
								</div>
							</div>

							<input type="hidden" name="harga_satuan" id="harga_satuan" value="{{ old('harga_satuan') }}">
							@error('harga_satuan')
								<div class="invalid-feedback d-block">{{ $message }}</div>
							@enderror
						</div>
					</div>
				</div>

				{{-- ============== KANAN: RINGKASAN / STRUK ============== --}}
				<div class="col-lg-5">
					<div class="card shadow-sm border-0">
						<div class="card-header text-app-white border-0">
							<h5 class="mb-0 fw-semibold fs-4">
								<i class="bi bi-receipt me-2"></i> Ringkasan Transaksi
							</h5>
						</div>
						<div class="card-body">
							{{-- INFO PELANGGAN --}}
							<div class="mb-3 pb-3 border-bottom">
								<small class="text-muted d-block">Pelanggan</small>
								<span class="fw-semibold fs-5" id="ringkasanPelanggan">-</span>
							</div>

							{{-- DETAIL ITEM --}}
							<div class="mb-3 pb-3 border-bottom">
								<div class="d-flex justify-content-between text-muted small mb-1">
									<span>Produk</span>
								</div>
								<div class="fw-semibold mb-2" id="ringkasanProduk">-</div>

								<div class="d-flex justify-content-between mb-1">
									<span class="text-muted">Harga Satuan</span>
									<span id="ringkasanHarga">Rp 0</span>
								</div>
								<div class="d-flex justify-content-between">
									<span class="text-muted">Jumlah</span>
									<span id="ringkasanJumlah">1</span>
								</div>
							</div>

							{{-- TOTAL --}}
							<div class="d-flex justify-content-between align-items-center mb-4">
								<span class="fs-5 fw-semibold">Total Bayar</span>
								<span class="fs-3 fw-bold text-success" id="ringkasanTotal">Rp 0</span>
							</div>

							<input type="hidden" name="total_harga" id="total_harga">

							{{-- SUBMIT BUTTON --}}
							<button type="submit" class="btn btn-app-secondary w-100 btn-lg" id="submitPenjualanBtn">
								<span class="button-content">
									<i class="bi bi-check-circle me-2"></i> Proses Transaksi
								</span>
								<span class="spinner-content d-none">
									<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
									Sedang Menyimpan...
								</span>
							</button>

							<a href="{{ route('penjualan.index') }}" class="btn btn-secondary w-100 mt-2">
								<i class="bi bi-arrow-left me-2"></i> Batal
							</a>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
@endsection

@push('styles')
	<style>
		.bg-light-subtle {
			background-color: #f8f9fb;
		}
	</style>
@endpush

@push('scripts')
	<script>
		const pelangganSelect = document.getElementById('id_pelanggan');
		const produkSelect = document.getElementById('id_produk');
		const jumlahInput = document.getElementById('jumlah');
		const hargaSatuanInput = document.getElementById('harga_satuan');
		const totalHargaInput = document.getElementById('total_harga');

		const produkPreview = document.getElementById('produkPreview');
		const previewKode = document.getElementById('previewKode');
		const previewNama = document.getElementById('previewNama');
		const previewKategori = document.getElementById('previewKategori');
		const previewHarga = document.getElementById('previewHarga');

		const ringkasanPelanggan = document.getElementById('ringkasanPelanggan');
		const ringkasanProduk = document.getElementById('ringkasanProduk');
		const ringkasanHarga = document.getElementById('ringkasanHarga');
		const ringkasanJumlah = document.getElementById('ringkasanJumlah');
		const ringkasanTotal = document.getElementById('ringkasanTotal');

		function formatRupiah(angka) {
			return 'Rp ' + new Intl.NumberFormat('id-ID', { minimumFractionDigits: 0 }).format(angka);
		}

		function updatePelanggan() {
			const selected = pelangganSelect.options[pelangganSelect.selectedIndex];
			ringkasanPelanggan.textContent = selected && selected.value ? selected.text : '-';
		}

		function updateProduk() {
			const selected = produkSelect.options[produkSelect.selectedIndex];

			if (selected && selected.value) {
				const harga = parseFloat(selected.getAttribute('data-harga')) || 0;

				previewKode.textContent = selected.getAttribute('data-kode');
				previewNama.textContent = selected.getAttribute('data-nama');
				previewKategori.textContent = selected.getAttribute('data-kategori');
				previewHarga.textContent = formatRupiah(harga);
				produkPreview.classList.remove('d-none');

				hargaSatuanInput.value = harga.toFixed(2);
				ringkasanProduk.textContent = selected.getAttribute('data-nama');
				ringkasanHarga.textContent = formatRupiah(harga);
			} else {
				produkPreview.classList.add('d-none');
				hargaSatuanInput.value = '';
				ringkasanProduk.textContent = '-';
				ringkasanHarga.textContent = formatRupiah(0);
			}

			hitungTotal();
		}

		function hitungTotal() {
			let jumlah = parseInt(jumlahInput.value) || 1;
			if (jumlah < 1) {
				jumlah = 1;
				jumlahInput.value = 1;
			}

			const hargaSatuan = parseFloat(hargaSatuanInput.value) || 0;
			const total = jumlah * hargaSatuan;

			totalHargaInput.value = total.toFixed(2);
			ringkasanJumlah.textContent = jumlah;
			ringkasanTotal.textContent = formatRupiah(total);
		}

		// Tombol +/-
		document.getElementById('btnPlus').addEventListener('click', function () {
			jumlahInput.value = (parseInt(jumlahInput.value) || 1) + 1;
			hitungTotal();
		});

		document.getElementById('btnMinus').addEventListener('click', function () {
			const current = parseInt(jumlahInput.value) || 1;
			jumlahInput.value = current > 1 ? current - 1 : 1;
			hitungTotal();
		});

		pelangganSelect.addEventListener('change', updatePelanggan);
		produkSelect.addEventListener('change', updateProduk);
		jumlahInput.addEventListener('input', hitungTotal);

		// Inisialisasi saat load (jika ada old value)
		document.addEventListener('DOMContentLoaded', function () {
			updatePelanggan();
			updateProduk();
		});

		// Spinner on submit
		const penjualanForm = document.getElementById('formPenjualan');
		const submitPenjualanBtn = document.getElementById('submitPenjualanBtn');
		if (penjualanForm && submitPenjualanBtn) {
			penjualanForm.addEventListener('submit', function () {
				submitPenjualanBtn.disabled = true;
				submitPenjualanBtn.querySelector('.button-content').classList.add('d-none');
				submitPenjualanBtn.querySelector('.spinner-content').classList.remove('d-none');
			});
		}
	</script>
@endpush