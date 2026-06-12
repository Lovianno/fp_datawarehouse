<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Http\Requests\PelangganRequest;
use App\Services\PelangganService;

class PelangganController extends Controller
{
    public function __construct(private PelangganService $pelangganService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $pelanggans = $this->pelangganService->getAll($search);

        $currentPage = $pelanggans->currentPage();
        $lastPage    = $pelanggans->lastPage();
        $perPage     = $pelanggans->perPage();
        $total       = $pelanggans->total();

        return view('pages.admin.pelanggan.index', compact(
            'pelanggans', 'search', 'currentPage', 'lastPage', 'perPage', 'total'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PelangganRequest $request)
    {
        try {
            $this->pelangganService->create($request->validated());
            return redirect()->route('pelanggan.index')->with('success', 'Data Pelanggan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $pelanggan = $this->pelangganService->getPelangganById($id);
        return view('pages.admin.pelanggan.show', compact('pelanggan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $pelanggan = $this->pelangganService->getPelangganById($id);

        return view('pages.admin.pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PelangganRequest $request, int $id)
    {
        $pelanggan = $this->pelangganService->getPelangganById($id);
        
        try {
            $this->pelangganService->update($pelanggan, $request->validated());
            return redirect()->route('pelanggan.index')->with('success', 'Data Pelanggan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $this->pelangganService->delete($pelanggan);
        return redirect()->route('pelanggan.index')->with('success', 'Data Pelanggan berhasil dihapus.');
    }
}
