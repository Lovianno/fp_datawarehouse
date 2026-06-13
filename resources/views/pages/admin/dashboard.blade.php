
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row g-4">

            @include('components.extract-button')

            {{-- Welcome Card --}}
            <div class="col-12">
                <div class="card border-0 shadow-sm b text-app-gray overflow-hidden">
                    <div class="card-body d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 p-4">
                        <div>
                            <div class="small opacity-75 mb-1">
                                <i class="bi bi-calendar3 me-1"></i>
                                Rabu, 11 Juni 2026
                            </div>

                            <h4 class="fw-bold mb-1 text-app-primary">
                                Selamat datang, Admin
                            </h4>

                            <p class="mb-0 opacity-75 small">
                                Sistem Informasi Manajemen Produk
                            </p>
                        </div>

                        <img src="{{ asset('assets/img/logo/Logo Full Megastore.png') }}"
                            class="img-fluid d-none d-sm-block"
                            style="max-height: 60px;"
                            alt="MEGASTORE">
                    </div>
                </div>
            </div>

            {{-- Kendaraan & Laporan --}}
            <div class="col-12">
                <div class="d-flex align-items-center mb-3 text-muted small fw-semibold text-uppercase">
                    <i class="bi bi-truck me-2"></i>
                    Kendaraan & Laporan
                </div>

                <div class="row g-3">

                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-uppercase text-app-primary small text-muted fw-semibold mb-1">
                                        Total Kendaraan
                                    </div>

                                    <h3 class="fw-bold mb-1 text-app-primary">
                                        25
                                    </h3>

                                    <small class="text-muted">Unit Terdaftar</small>
                                </div>

                                <div class="fs-3 text-app-primary">
                                    <i class="bi bi-car-front"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-uppercase text-app-primary small text-muted fw-semibold mb-1">
                                        Total Laporan
                                    </div>

                                    <h3 class="fw-bold mb-1 text-app-primary">
                                        142
                                    </h3>

                                    <small class="text-muted">Laporan Perbaikan</small>
                                </div>

                                <div class="fs-3 text-app-primary">
                                    <i class="bi bi-file-earmark-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-uppercase text-app-primary small text-muted fw-semibold mb-1">
                                        Laporan Bulan Ini
                                    </div>

                                    <h3 class="fw-bold mb-1 text-app-primary">
                                        18
                                    </h3>

                                    <small class="text-muted">
                                        Juni 2026
                                    </small>
                                </div>

                                <div class="fs-3 text-app-primary">
                                    <i class="bi bi-calendar-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-uppercase text-app-primary small text-muted fw-semibold mb-1">
                                        Pendapatan Bulan Ini
                                    </div>

                                    <h5 class="fw-bold mb-1 text-app-primary">
                                        Rp 45.750.000
                                    </h5>

                                    <small class="text-muted">Total Pendapatan</small>
                                </div>

                                <div class="fs-3 text-app-primary">
                                    <i class="bi bi-cash-coin"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Suku Cadang --}}
            <div class="col-12">
                <div class="d-flex align-items-center mb-3 text-muted small fw-semibold text-uppercase">
                    <i class="bi bi-box-seam me-2"></i>
                    Suku Cadang
                </div>

                <div class="row g-3">

                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-uppercase text-app-primary small text-muted fw-semibold mb-1">
                                        Total Suku Cadang
                                    </div>

                                    <h3 class="fw-bold mb-1 text-app-primary">
                                        156
                                    </h3>

                                    <small class="text-muted">Jenis Onderdil</small>
                                </div>

                                <div class="fs-3 text-app-primary">
                                    <i class="bx bx-package"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-uppercase text-app-primary small text-muted fw-semibold mb-1">
                                        Stok Kritis
                                    </div>

                                    <h3 class="fw-bold text-app-primary mb-1">
                                        12
                                    </h3>

                                    <small class="text-muted">Stok ≤ 5 Unit</small>
                                </div>

                                <div class="fs-3 text-app-primary">
                                    <i class="bi bi-exclamation-triangle"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-uppercase text-app-primary small text-muted fw-semibold mb-1">
                                        Stok Masuk
                                    </div>

                                    <h3 class="fw-bold text-app-primary mb-1">
                                        34
                                    </h3>

                                    <small class="text-muted">Transaksi Bulan Ini</small>
                                </div>

                                <div class="fs-3 text-app-primary">
                                    <i class="bx bx-trending-up"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-uppercase text-app-primary small text-muted fw-semibold mb-1">
                                        Stok Keluar
                                    </div>

                                    <h3 class="fw-bold text-app-primary mb-1">
                                        47
                                    </h3>

                                    <small class="text-muted">Transaksi Bulan Ini</small>
                                </div>

                                <div class="fs-3 text-app-primary">
                                    <i class="bx bx-trending-down"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent Reports --}}
            <div class="col-12 col-lg-5">
                <div class="card border-0 shadow-sm h-100">

                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-bold mb-0 text-app-primary">Laporan Terbaru</h6>
                            <small class="text-muted">5 laporan perbaikan terakhir</small>
                        </div>

                        <a href="#" class="text-app-primary text-decoration-none small fw-semibold">
                            Lihat semua
                        </a>
                    </div>

                    <div class="card-body">
                        <a href="#"
                            class="d-flex align-items-center justify-content-between text-decoration-none text-dark border-bottom py-3 gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class=" bg-opacity-10 text-app-primary rounded p-2">
                                    <i class="bi bi-car-front"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">B1234XY</div>
                                    <small class="text-muted">Truck · 10 Jun 2026</small>
                                </div>
                            </div>
                            <div class="text-end">
                                <div class="fw-bold">Rp 3.500.000</div>
                                <span class="badge bg-success-subtle text-success">Aktif</span>
                            </div>
                        </a>

                        <a href="#"
                            class="d-flex align-items-center justify-content-between text-decoration-none text-dark border-bottom py-3 gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class=" bg-opacity-10 text-app-primary rounded p-2">
                                    <i class="bi bi-car-front"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">B5678AB</div>
                                    <small class="text-muted">Van · 09 Jun 2026</small>
                                </div>
                            </div>
                            <div class="text-end">
                                <div class="fw-bold">Rp 2.750.000</div>
                                <span class="badge bg-success-subtle text-success">Aktif</span>
                            </div>
                        </a>

                        <a href="#"
                            class="d-flex align-items-center justify-content-between text-decoration-none text-dark border-bottom py-3 gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class=" bg-opacity-10 text-app-primary rounded p-2">
                                    <i class="bi bi-car-front"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">B9012CD</div>
                                    <small class="text-muted">Bus · 08 Jun 2026</small>
                                </div>
                            </div>
                            <div class="text-end">
                                <div class="fw-bold">Rp 4.200.000</div>
                                <span class="badge bg-danger-subtle text-danger">Dibatalkan</span>
                            </div>
                        </a>

                        <a href="#"
                            class="d-flex align-items-center justify-content-between text-decoration-none text-dark border-bottom py-3 gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class=" bg-opacity-10 text-app-primary rounded p-2">
                                    <i class="bi bi-car-front"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">B3456EF</div>
                                    <small class="text-muted">Truck · 07 Jun 2026</small>
                                </div>
                            </div>
                            <div class="text-end">
                                <div class="fw-bold">Rp 3.100.000</div>
                                <span class="badge bg-success-subtle text-success">Aktif</span>
                            </div>
                        </a>

                        <a href="#"
                            class="d-flex align-items-center justify-content-between text-decoration-none text-dark py-3 gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class=" bg-opacity-10 text-app-primary rounded p-2">
                                    <i class="bi bi-car-front"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">B7890GH</div>
                                    <small class="text-muted">Pickup · 06 Jun 2026</small>
                                </div>
                            </div>
                            <div class="text-end">
                                <div class="fw-bold">Rp 2.200.000</div>
                                <span class="badge bg-success-subtle text-success">Aktif</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Low Stock --}}
            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm h-100">

                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-bold mb-0 text-app-primary">Stok Hampir Habis</h6>
                            <small class="text-muted">Onderdil dengan stok ≤ 10 unit</small>
                        </div>

                        <a href="#"
                            class="text-app-primary text-decoration-none small fw-semibold">
                            Kelola
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="border-bottom py-3">
                            <div class="d-flex justify-content-between align-items-center mb-2 gap-2">
                                <div class="fw-semibold text-truncate">
                                    Filter Oli Mesin
                                </div>
                                <span class="badge bg-light text-dark border">
                                    3 unit
                                </span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-danger"
                                    style="width: 30%"></div>
                            </div>
                        </div>

                        <div class="border-bottom py-3">
                            <div class="d-flex justify-content-between align-items-center mb-2 gap-2">
                                <div class="fw-semibold text-truncate">
                                    Kampas Rem Depan
                                </div>
                                <span class="badge bg-light text-dark border">
                                    5 unit
                                </span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-danger"
                                    style="width: 50%"></div>
                            </div>
                        </div>

                        <div class="border-bottom py-3">
                            <div class="d-flex justify-content-between align-items-center mb-2 gap-2">
                                <div class="fw-semibold text-truncate">
                                    Busi Motor Standar
                                </div>
                                <span class="badge bg-light text-dark border">
                                    7 unit
                                </span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-warning"
                                    style="width: 70%"></div>
                            </div>
                        </div>

                        <div class="border-bottom py-3">
                            <div class="d-flex justify-content-between align-items-center mb-2 gap-2">
                                <div class="fw-semibold text-truncate">
                                    Selang Radiator
                                </div>
                                <span class="badge bg-light text-dark border">
                                    4 unit
                                </span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-danger"
                                    style="width: 40%"></div>
                            </div>
                        </div>

                        <div class="py-3">
                            <div class="d-flex justify-content-between align-items-center mb-2 gap-2">
                                <div class="fw-semibold text-truncate">
                                    Aki 12V 55A
                                </div>
                                <span class="badge bg-light text-dark border">
                                    8 unit
                                </span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-warning"
                                    style="width: 80%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Action --}}
            <div class="col-12 col-lg-3">
                <div class="card border-0 shadow-sm h-100">

                    <div class="card-header bg-white border-0">
                        <h6 class="fw-bold mb-0 text-app-primary">Aksi Cepat</h6>
                        <small class="text-muted">Pintasan menu utama</small>
                    </div>

                    <div class="card-body d-grid gap-2">
                        <a href="#" class="btn btn-app-primary">
                            <i class="bi bi-plus-circle me-1"></i>
                            Buat Laporan
                        </a>

                        <a href="#" class="btn btn-outline-secondary">
                            <i class="bx bxs-truck me-1"></i>
                            Tambah Kendaraan
                        </a>

                        <a href="#" class="btn btn-outline-secondary">
                            <i class="bx bx-package me-1"></i>
                            Tambah Suku Cadang
                        </a>

                        <a href="#" class="btn btn-outline-secondary">
                            <i class="bx bx-transfer me-1"></i>
                            Riwayat Stok
                        </a>

                        <a href="#" class="btn btn-outline-secondary">
                            <i class="bi bi-people me-1"></i>
                            Data Pengguna
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
```
