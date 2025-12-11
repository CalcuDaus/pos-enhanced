@extends('layouts.app')
@section('title', $title)
@section('content')
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ $breadcrumbs[0]['url'] }}">{{ $breadcrumbs[0]['name'] }}</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">{{ $breadcrumbs[1]['name'] }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->

    <div class="row">
        <div class="col-md-4">
            <!-- Form Tambah Pengeluaran -->
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Pengeluaran</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('expenses.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="date" class="form-control"
                                value="{{ old('date', date('Y-m-d')) }}">
                            @error('date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <input type="text" name="category" class="form-control" value="{{ old('category') }}"
                                placeholder="Masukkan kategori pengeluaran">
                            @error('category')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Tambahkan deskripsi">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" step="0.01" name="amount" class="form-control"
                                value="{{ old('amount') }}" placeholder="Masukkan jumlah">
                            @error('amount')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary mb-0">Simpan</button>
                            <button type="reset" class="btn btn-outline-secondary mb-0">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabel Daftar Pengeluaran -->
        <div class="col-md-8">
            <div class="card table-card pt-3 px-3">
                <div class="card-body">
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Daftar Pengeluaran</h5>
                        <div class="d-flex align-items-center">
                            <label class="me-2 mb-0 text-nowrap">Rows per page:</label>
                            <select class="form-select form-select-sm" style="width: auto;"
                                onchange="window.location.href='{{ route('expenses.index') }}?per_page=' + this.value">
                                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="dt-expenses">
                            <thead>
                                <tr>
                                    <th style="width:5%;">#</th>
                                    <th>Tanggal</th>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Jumlah</th>
                                    <th style="width:15%;" class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($expenses as $expense)
                                    <tr>
                                        <td>{{ $expenses->firstItem() + $loop->index }}</td>
                                        <td>{{ \Carbon\Carbon::parse($expense->date)->format('d-m-Y') }}</td>
                                        <td>{{ $expense->category }}</td>
                                        <td>{{ $expense->description ?? '-' }}</td>
                                        <td>Rp {{ number_format($expense->amount, 2, ',', '.') }}</td>
                                        <td class="text-end">
                                            <div class="prod-action-links">
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item" title="Edit">
                                                        <a href="{{ route('expenses.edit', $expense->id) }}"
                                                            class="avtar avtar-xs btn-link-success btn-pc-default">
                                                            <i class="ti ti-edit-circle f-18"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item" title="Delete">
                                                        <form action="{{ route('expenses.destroy', Crypt::encrypt($expense->id)) }}"
                                                            method="post" onsubmit="return confirm('Yakin ingin menghapus pengeluaran ini?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="avtar avtar-xs btn-link-danger btn-pc-default">
                                                                <i class="ti ti-trash f-18"></i>
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada pengeluaran ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($expenses->hasPages())
                        <div class="mt-3 d-flex justify-content-between align-items-center">
                            <span class="text-muted">Showing {{ $expenses->firstItem() ?? 0 }} to {{ $expenses->lastItem() ?? 0 }} of
                                {{ $expenses->total() }} results</span>
                            <nav>
                                <ul class="pagination pagination-sm mb-0">
                                    {{-- Previous Page Link --}}
                                    @if ($expenses->onFirstPage())
                                        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $expenses->previousPageUrl() }}">&laquo;</a></li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($expenses->getUrlRange(max(1, $expenses->currentPage() - 2), min($expenses->lastPage(), $expenses->currentPage() + 2)) as $page => $url)
                                        @if ($page == $expenses->currentPage())
                                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($expenses->hasMorePages())
                                        <li class="page-item"><a class="page-link" href="{{ $expenses->nextPageUrl() }}">&raquo;</a></li>
                                    @else
                                        <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

