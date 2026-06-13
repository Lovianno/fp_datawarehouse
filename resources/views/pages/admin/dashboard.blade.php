@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row g-4">

            {{-- Welcome Card --}}
            <div class="col-12">
                <div class="card border-0 shadow-sm b text-app-gray overflow-hidden">
                    <div
                        class="card-body d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 p-4">
                        <div>
                            <div class="small opacity-75 mb-1">
                                <i class="bi bi-calendar3 me-1"></i>
                                {{ now()->translatedFormat('l, d F Y') }}
                            </div>

                            <h4 class="fw-bold mb-1 text-app-primary">
                                Selamat datang, {{ auth()->user()->name }}
                            </h4>

                            <p class="mb-0 opacity-75 small">
                                Sistem Informasi Data Warehouse Penjualan
                            </p>
                        </div>

                        <img src="{{ asset('assets/img/logo/Logo Full Megastore.png') }}"
                            class="img-fluid d-none d-sm-block" style="max-height: 60px;" alt="MEGASTORE">
                    </div>
                </div>
            </div>

            {{-- Summary Cards --}}
            <div class="col-12">
                <div class="d-flex align-items-center mb-3 text-muted small fw-semibold text-uppercase">
                    <i class="bi bi-bar-chart-line me-2"></i>
                    Ringkasan Penjualan
                </div>

                <div class="row g-3">

                  <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-uppercase text-app-primary small text-muted fw-semibold mb-1">
                                        Total Produk
                                    </div>

                                    <h3 class="fw-bold mb-1 text-app-primary">
                                        {{ $stats['total_produk'] }}
                                    </h3>

                                    <small class="text-muted">Seluruh Produk</small>
                                </div>

                                <div class="fs-3 text-app-primary">
                                    <i class="bi bi-box-seam"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-uppercase text-app-primary small text-muted fw-semibold mb-1">
                                        Total Pelanggan
                                    </div>

                                    <h3 class="fw-bold mb-1 text-app-primary">
                                        {{ $stats['total_pelanggan'] }}
                                    </h3>

                                    <small class="text-muted">Seluruh Pelanggan</small>
                                </div>

                                <div class="fs-3 text-app-primary">
                                    <i class="bi bi-people"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-uppercase text-app-primary small text-muted fw-semibold mb-1">
                                        Total Penjualan
                                    </div>

                                    <h3 class="fw-bold mb-1 text-app-primary">
                                        {{ $stats['total_penjualan_bulanan'] }}
                                    </h3>

                                    <small class="text-muted">Transaksi Bulan Ini</small>
                                </div>

                                <div class="fs-3 text-app-primary">
                                    <i class="bi bi-receipt"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-uppercase text-app-primary small text-muted fw-semibold mb-1">
                                        Total Pendapatan
                                    </div>

                                    <h5 class="fw-bold mb-1 text-app-primary">
                                        Rp {{ number_format($stats['pendapatan_bulanan'], 0, ',', '.') }}
                                    </h5>

                                    <small class="text-muted">Pendapatan Bulan Ini</small>
                                </div>

                                <div class="fs-3 text-app-primary">
                                    <i class="bi bi-cash-coin"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ============== OLAP CHARTS ============== --}}
            <div class="col-12">
                <div class="d-flex align-items-center mb-3 text-muted small fw-semibold text-uppercase">
                    <i class="bi bi-graph-up me-2"></i>
                    Analisis Penjualan (OLAP)
                </div>

                <div class="row g-3">
                    {{-- Tren Penjualan per Bulan --}}
                    <div class="col-12">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white border-0">
                                <h6 class="fw-bold mb-0 text-app-primary">Tren Penjualan per Bulan</h6>
                                <small class="text-muted">Total pendapatan setiap bulan</small>
                            </div>
                            <div class="card-body">
                                <div id="chartTrenPenjualan"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Produk Terlaris --}}
                    <div class="col-12 col-lg-7">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white border-0">
                                <h6 class="fw-bold mb-0 text-app-primary">Produk Terlaris</h6>
                                <small class="text-muted">Berdasarkan jumlah unit terjual (Top 5)</small>
                            </div>
                            <div class="card-body">
                                <div id="chartTopProduk"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Pelanggan Terbaik --}}
                    <div class="col-12 col-lg-5">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white border-0">
                                <h6 class="fw-bold mb-0 text-app-primary">Pelanggan Terbaik</h6>
                                <small class="text-muted">Berdasarkan total belanja (Top 5)</small>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless align-middle mb-0">
                                        <thead>
                                            <tr class="text-muted small text-uppercase">
                                                <th>Pelanggan</th>
                                                <th class="text-end">Transaksi</th>
                                                <th class="text-end">Total Belanja</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($pelangganTerbaik->take(5) as $pelanggan)
                                                <tr class="border-bottom">
                                                    <td class="fw-semibold">{{ $pelanggan->nama_pelanggan }}</td>
                                                    <td class="text-end">
                                                        <span
                                                            class="">{{ $pelanggan->jumlah_transaksi }} Kali</span>
                                                    </td>
                                                    <td class="text-end fw-bold text-success">
                                                        Rp {{ number_format($pelanggan->total_belanja, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted py-4">
                                                        <i class="bi bi-folder-x fs-4 d-block mb-2"></i>
                                                        Belum ada data transaksi.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Action --}}
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0">
                        <h6 class="fw-bold mb-0 text-app-primary">Aksi Cepat</h6>
                        <small class="text-muted">Pintasan menu utama</small>
                    </div>

                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-6 col-md-3">
                                <a href="{{ route('penjualan.create') }}" class="btn btn-app-primary w-100">
                                    <i class="bi bi-plus-circle me-1"></i>
                                    Transaksi Baru
                                </a>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-box-seam me-1"></i>
                                    Data Produk
                                </a>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-people me-1"></i>
                                    Data Pelanggan
                                </a>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="{{ route('penjualan.index') }}" class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-receipt me-1"></i>
                                    Data Penjualan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ===== Tren Penjualan per Bulan (Area Chart) =====
            const trenPenjualan = new ApexCharts(document.querySelector("#chartTrenPenjualan"), {
                chart: {
                    type: 'area',
                    height: 320,
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Total Pendapatan',
                    data: @json($pendapatanPerBulan->pluck('total_pendapatan'))
                }],
                xaxis: {
                    categories: @json($pendapatanPerBulan->pluck('bulan_nama'))
                },
                colors: ['#0d6efd'],
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                dataLabels: {
                    enabled: false
                },
                yaxis: {
                    labels: {
                        formatter: function(val) {
                            return 'Rp ' + (val / 1000000).toFixed(1) + ' Jt';
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(val);
                        }
                    }
                }
            });
            trenPenjualan.render();

            // ===== Produk Terlaris (Bar Chart Horizontal) =====
            const topProdukChart = new ApexCharts(document.querySelector("#chartTopProduk"), {
                chart: {
                    type: 'bar',
                    height: 320,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        borderRadius: 4
                    }
                },
                series: [{
                    name: 'Jumlah Terjual',
                    data: @json($produkTerlaris->take(5)->pluck('total_terjual'))
                }],
                xaxis: {
                    categories: @json($produkTerlaris->take(5)->pluck('nama_produk'))
                },
                colors: ['#198754'],
                dataLabels: {
                    enabled: true
                }
            });
            topProdukChart.render();

        });
    </script>
@endpush
