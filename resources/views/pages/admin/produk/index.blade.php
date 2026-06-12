@extends('layouts.admin')

@section('title', 'Data Produk')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Produk</h5>
            <a href="{{ route('produk.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Produk
            </a>
        </div>

        <div class="card-body">
            {{-- Alert --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Search --}}
            <form method="GET" action="{{ route('produk.index') }}" class="mb-3">
                <div class="input-group" style="max-width: 350px;">
                    <input type="text" name="search" class="form-control"
                           placeholder="Cari kode, nama, atau kategori..."
                           value="{{ $search }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                    @if($search)
                        <a href="{{ route('produk.index') }}" class="btn btn-outline-danger">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    @endif
                </div>
            </form>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produks as $index => $produk)
                            <tr>
                                <td>{{ ($currentPage - 1) * $perPage + $loop->iteration }}</td>
                                <td>
                                    <span class="badge bg-label-primary">
                                        {{ $produk->kode_produk }}
                                    </span>
                                </td>
                                <td>{{ $produk->nama_produk }}</td>
                                <td>
                                    <span class="badge bg-label-info">
                                        {{ $produk->kategori }}
                                    </span>
                                </td>
                                <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('produk.show', $produk->id_produk) }}"
                                       class="btn btn-sm btn-info" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('produk.edit', $produk->id_produk) }}"
                                       class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('produk.destroy', $produk->id_produk) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                    Tidak ada data produk ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination Info + Links --}}
            <div class="d-flex justify-content-between align-items-center mt-3">
                <small class="text-muted">
                    Menampilkan {{ $produks->firstItem() ?? 0 }}–{{ $produks->lastItem() ?? 0 }}
                    dari {{ $total }} data
                </small>
                {{ $produks->appends(['search' => $search])->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
