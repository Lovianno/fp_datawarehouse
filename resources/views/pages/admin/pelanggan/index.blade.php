@extends('layouts.admin')

@section('title', 'Data Pelanggan')

@section('breadcrumb')
    <li class="breadcrumb-item active">Data Pelanggan</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm border-0 mb-4 p-3">
            <div class="card-header bg-white border-0 mb-2">
                <h5 class="card-title fw-semibold mb-4 fs-4">Data Pelanggan</h5>
                @if ($errors->has('delete'))
                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                        <i class="bi bi-exclamation-circle-fill me-2"></i>
                        {{ $errors->first('delete') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="row g-2 align-items-center">
                    <div class="col-12 col-md-6">
                        <form method="GET" class="w-100 d-flex align-items-center gap-2">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control"
                                    placeholder="Cari nama, kode, atau kota...">
                                <button class="btn btn-outline-secondary border btn-search" type="submit">
                                    <span class="button-content">Cari</span>
                                    <span class="spinner-content d-none">
                                        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                        Mencari
                                    </span>
                                </button>
                            </div>
                            <a href="{{ url()->current() }}"
                                class="btn btn-secondary border d-flex align-items-center gap-1 {{ request('search') ? '' : 'd-none' }}">
                                <i class="bi bi-arrow-counterclockwise"></i>
                                <span>Reset</span>
                            </a>
                        </form>
                    </div>
                    <div class="col-12 col-md-auto ms-md-auto text-md-end">
                        <a href="{{ route('pelanggan.create') }}" class="btn btn-app-secondary w-100 w-md-auto">
                            <i class="bi bi-plus-lg me-1"></i> Tambah Baru
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-start">
                                <th>#</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Kota</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pelanggans as $pelanggan)
                                <tr>
                                    <td>{{ $pelanggans->firstItem() + $loop->index }}</td>
                                    <td>{{ $pelanggan->kode_pelanggan }}</td>
                                    <td>{{ $pelanggan->nama_pelanggan }}</td>
                                    <td>{{ $pelanggan->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>{{ $pelanggan->kota }}</td>
                                    <td class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('pelanggan.show', $pelanggan) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i> Lihat
                                        </a>
                                        <a href="{{ route('pelanggan.edit', $pelanggan) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i> Ubah
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete{{ $pelanggan->id_pelanggan }}">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="bi bi-folder-x fs-4 d-block mb-2"></i>
                                        Tidak ada data ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @foreach ($pelanggans as $pelanggan)
                    <div class="modal fade" id="modalDelete{{ $pelanggan->id_pelanggan }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content rounded-4 shadow-lg border-0 p-2">
                                <div class="modal-header border-0 pb-0">
                                    <div class="d-flex align-items-center gap-2 w-100">
                                        <i class="bi bi-exclamation-triangle-fill text-danger fs-3 me-2"></i>
                                        <div class="grow">
                                            <h5 class="modal-title mb-0 fw-bold text-danger">Konfirmasi Hapus</h5>
                                            <small class="text-muted">Aksi ini tidak dapat dibatalkan</small>
                                        </div>
                                        <button type="button" class="btn-close me-2 mt-2" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                </div>
                                <div class="modal-body pt-3 pb-0 px-4">
                                    <p class="mb-3 fs-6">Apakah Anda yakin ingin menghapus
                                        <strong>{{ Str::limit($pelanggan->nama_pelanggan, 20, '...') }}</strong>?
                                    </p>
                                </div>
                                <div class="modal-footer border-0 pt-0 px-4 pb-4 d-flex justify-content-end gap-2">
                                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('pelanggan.destroy', $pelanggan) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger px-4 btn-delete">
                                            <span class="button-content"><i class="bi bi-trash me-1"></i> Hapus</span>
                                            <span class="spinner-content d-none">
                                                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                                Menghapus
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
                    <div class="small text-muted">
                        Halaman <strong>{{ $currentPage }}</strong> dari <strong>{{ $lastPage }}</strong><br>
                        Menampilkan <strong>{{ $perPage }}</strong> data per halaman (total <strong>{{ $total }}</strong> pelanggan)
                    </div>
                    <div>{{ $pelanggans->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.modal form').forEach(function (form) {
                form.addEventListener('submit', function () {
                    var btn = form.querySelector('.btn-delete');
                    if (btn) {
                        btn.disabled = true;
                        btn.querySelector('.button-content').classList.add('d-none');
                        btn.querySelector('.spinner-content').classList.remove('d-none');
                    }
                });
            });

            document.querySelectorAll('form input[name="search"]').forEach(function (input) {
                var form = input.closest('form');
                if (form) {
                    form.addEventListener('submit', function () {
                        var btn = form.querySelector('.btn-search');
                        if (btn) {
                            btn.disabled = true;
                            btn.querySelector('.button-content').classList.add('d-none');
                            btn.querySelector('.spinner-content').classList.remove('d-none');
                        }
                    });
                }
            });
        });
    </script>
@endpush