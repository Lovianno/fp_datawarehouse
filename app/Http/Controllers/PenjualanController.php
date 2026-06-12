<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenjualanRequest;
use App\Models\Penjualan;
use App\Services\PelangganService;
use App\Services\PenjualanService;
use App\Services\ProdukService;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function __construct(
        private PenjualanService $penjualanService,
        private ProdukService $produkService,
        private PelangganService $pelangganService
        ) {}

    public function index(Request $request)
    { $search = $request->query('search');
        $penjualan = $this->penjualanService->getAll($search);
        return view('pages.admin.penjualan.index', compact('penjualan'));
    }

    public function create()
    {
        $produk = $this->produkService->getProdukOptions();
        $pelanggan = $this->pelangganService->getPelangganOptions();
        return view('pages.admin.penjualan.create', compact('produk', 'pelanggan'));
    }

    // Controller - tangkap untuk feedback ke user
    public function store(PenjualanRequest $request)
    {
       $data = $request->validated();

        try {
            $penjualan = $this->penjualanService->create($data);
            return redirect()->route('penjualan.index')
                ->with('success', 'Penjualan berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(Penjualan $penjualan)
    {
        // Tampilkan detail penjualan berdasarkan ID
        return view('pages.admin.penjualan.show', compact('penjualan'));
    }

    public function edit(Penjualan $penjualan) {}

    public function update(Request $request, Penjualan $penjualan) {}

    public function destroy(Penjualan $penjualan) {}
}
