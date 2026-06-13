<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Requests\ProdukRequest;
use App\Services\ProdukService;

class ProdukController extends Controller
{


    public function __construct(private ProdukService $produkService) {}


    public function index(Request $request)
    {
        $search = $request->query('search');
        $produks = $this->produkService->getAll($search);

        $currentPage = $produks->currentPage();
        $lastPage    = $produks->lastPage();
        $perPage     = $produks->perPage();
        $total       = $produks->total();

        return view('pages.admin.produk.index', compact(
            'produks', 'search', 'currentPage', 'lastPage', 'perPage', 'total'
        ));
    }

    public function create()
    {
        $kategoriOptions = $this->produkService->getKategoriOptions();
        return view('pages.admin.produk.create', compact('kategoriOptions'));
    }

    public function store(ProdukRequest $request)
    {
        try {
            $this->produkService->create($request->validated());
            return redirect()->route('produk.index')
                ->with('success', 'Data Produk berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menambah produk.']);
        }
    }

    public function show(Produk $produk)
    {
        return view('pages.admin.produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        $kategoriOptions = $this->produkService->getKategoriOptions();

        return view('pages.admin.produk.edit', compact('produk', 'kategoriOptions'));
    }

    public function update(ProdukRequest $request, Produk $produk)
    {
        try {
            $this->produkService->update($produk, $request->validated());
            return redirect()->route('produk.index')
                ->with('success', 'Data Produk berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui produk.']);
        }
    }

    public function destroy(Produk $produk)
    {
        $this->produkService->delete($produk);
        return redirect()->route('produk.index')
            ->with('success', 'Data Produk berhasil dihapus.');
    }
}
