@extends('layouts.app')
@section('title', $title)
@section('content')
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ $breadcrumbs[0]['url'] }}">{{ $breadcrumbs[0]['name'] }}</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            {{ $breadcrumbs[1]['name'] }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->

    <div class="row">
        <div class="card table-card">
            <div class="card-body">
                <div class="p-sm-4 pb-sm-2 d-flex justify-content-between align-items-center">
                    <h4>{{ $title }}</h4>
                    <a href="{{ route('deposits.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus f-18"></i> Tambah Titipan
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover " id="dt-deposits">
                        <thead>
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th>Pelanggan</th>
                                <th>Jumlah Titipan</th>
                                <th>Tambah Titipan</th>
                                <th>Ambil Sebagian</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($deposits as $deposit)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $deposit->customer->name ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span></span>Rp {{ number_format($deposit->amount, 2, ',', '.') }}</span>

                                        </div>
                                    </td>
                                    <td>
                                        <form action="{{ route('deposits.add-amount', Crypt::encrypt($deposit->id)) }}" class="d-flex align-items-center gap-2"
                                            method="post">
                                            @csrf
                                            <input type="number" name="add_amount" class="form-control form-control-sm" style="width: 100px;"
                                                placeholder="0" min="0" step="any">
                                            <span class="text-muted" style="font-size: 10px;">press <br> enter</span>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('deposits.withdraw', Crypt::encrypt($deposit->id)) }}" class="d-flex align-items-center gap-2"
                                            method="post">
                                            @csrf
                                            <input type="number" name="withdraw_amount" class="form-control form-control-sm" style="width: 100px;"
                                                placeholder="0" min="0" step="any">
                                            <span class="text-muted" style="font-size: 10px;">press <br> enter</span>
                                        </form>
                                    </td>
                                    <td>{{ $deposit->created_at ?? '-' }}</td>
                                    <td>{{ $deposit->updated_at ?? '-' }}</td>
                                    <td>
                                        <div class="prod-action-links">
                                            <ul class="list-inline mb-0">
                                                @if($deposit->amount > 0)
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" title="Ambil Titipan">
                                                        <form action="{{ route('deposits.payoff', Crypt::encrypt($deposit->id)) }}" method="post"
                                                            onsubmit="return confirm('Yakin ingin mengambil/melunasi titipan ini?');">
                                                            @csrf
                                                            <button type="submit" class="avtar avtar-xs btn-link-success btn-pc-default">
                                                                <i class="ti ti-check f-18"></i>
                                                            </button>
                                                        </form>
                                                    </li>
                                                @endif
                                                <li class="list-inline-item" data-bs-toggle="tooltip" title="Edit">
                                                    <a href="{{ route('deposits.edit', $deposit->id) }}"
                                                        class="avtar avtar-xs btn-link-success btn-pc-default">
                                                        <i class="ti ti-edit-circle f-18"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item" data-bs-toggle="tooltip" title="Delete">
                                                    <form action="{{ route('deposits.destroy', Crypt::encrypt($deposit->id)) }}"
                                                        method="post"
                                                        onsubmit="return confirm('Yakin ingin menghapus titipan ini?');">
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
                                    <td colspan="7" class="text-center">Tidak ada titipan yang ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
