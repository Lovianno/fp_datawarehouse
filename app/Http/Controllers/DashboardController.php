<?php

namespace App\Http\Controllers;

use App\Models\FactPenjualan;
use App\Models\Pelanggan;
use App\Models\Produk;

class DashboardController extends Controller
{

    public function index()
    {
        $bulanIni = now()->month;
        $tahunIni = now()->year;

        $stats = [
            'total_produk'             => Produk::count(),
            'total_pelanggan'          => Pelanggan::count(),
            'total_penjualan_bulanan'  => FactPenjualan::join('dim_waktu', 'fact_penjualan.id_waktu', '=', 'dim_waktu.id_waktu')
                ->where('dim_waktu.bulan', $bulanIni)
                ->orWhere('dim_waktu.tahun', $tahunIni)
                ->count(),
            'pendapatan_bulanan'       => FactPenjualan::join('dim_waktu', 'fact_penjualan.id_waktu', '=', 'dim_waktu.id_waktu')
                ->where('dim_waktu.bulan', $bulanIni)
                ->orWhere('dim_waktu.tahun', $tahunIni)
                ->sum('fact_penjualan.total_harga'),
        ];
        $pendapatanPerBulan = $this->getPenjualanPerbulan();
        $produkTerlaris = $this->getTopProduk();
        $pelangganTerbaik = $this->getPelangganTerbaik();

        return view('pages.admin.dashboard', compact(
            'stats',
            'produkTerlaris',
            'pendapatanPerBulan',
            'pelangganTerbaik'
        ));
    }
    public function getPenjualanPerbulan()
    {
        // Query 2: Pendapatan per bulan
        return FactPenjualan::query()
            ->join('dim_waktu', 'fact_penjualan.id_waktu', '=', 'dim_waktu.id_waktu')
            ->selectRaw('dim_waktu.bulan_nama, SUM(fact_penjualan.total_harga) as total_pendapatan')
            ->groupBy('dim_waktu.bulan', 'dim_waktu.bulan_nama')
            ->orderBy('dim_waktu.bulan', 'asc')
            ->get();
    }

    public function getPenjualanPerKategori()
    {
        // Distribusi per kategori produk
        return  FactPenjualan::query()
            ->join('dim_produk', 'fact_penjualan.id_produk', '=', 'dim_produk.id_produk')
            ->selectRaw('dim_produk.kategori, SUM(fact_penjualan.total_harga) as total')
            ->groupBy('dim_produk.kategori')
            ->get();
    }

    public function getTopProduk()
    {
        return FactPenjualan::query()
            ->join('dim_produk', 'fact_penjualan.id_produk', '=', 'dim_produk.id_produk')
            ->selectRaw('dim_produk.nama_produk, SUM(fact_penjualan.jumlah) as total_terjual, SUM(fact_penjualan.total_harga) as total_pendapatan')
            ->groupBy('dim_produk.id_produk', 'dim_produk.nama_produk')
            ->orderBy('total_pendapatan')
            ->limit(5)
            ->get();
    }

    public function getPelangganTerbaik()
    {
        // Query 3: Pelanggan dengan belanja terbanyak
        return FactPenjualan::query()
            ->join('dim_pelanggan', 'fact_penjualan.id_pelanggan', '=', 'dim_pelanggan.id_pelanggan')
            ->selectRaw('dim_pelanggan.nama_pelanggan, SUM(fact_penjualan.total_harga) as total_belanja, COUNT(fact_penjualan.id_penjualan) as jumlah_transaksi')
            ->groupBy('dim_pelanggan.id_pelanggan', 'dim_pelanggan.nama_pelanggan')
            ->orderByDesc('total_belanja')
            ->limit(5)
            ->get();
    }
}
