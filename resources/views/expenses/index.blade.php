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
                    <h5 class="mb-3">Daftar Pengeluaran</h5>
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
                                        <td>{{ $loop->iteration }}</td>
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
                                                        <form
                                                            action="{{ route('expenses.destroy', Crypt::encrypt($expense->id)) }}"
                                                            method="post"
                                                            onsubmit="return confirm('Yakin ingin menghapus pengeluaran ini?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="avtar avtar-xs btn-link-danger btn-pc-default">
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
                </div>
            </div>
        </div>
    </div>
@endsection
