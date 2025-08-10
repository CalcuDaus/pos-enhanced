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
                    <a href="{{ route('accounts.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus f-18"></i> Tambah Rekening
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover tbl-product" id="dt-accounts">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Logo</th>
                                <th>Nama Rekening</th>
                                <th>Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($accounts as $account)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $account->image) }}" alt="{{ $account->image }}"
                                            class="wid-40 rounded">
                                    </td>
                                    <td>{{ $account->account_name }}</td>
                                    <td>Rp {{ number_format($account->balance, 2, ',', '.') }}
                                        <div class="prod-action-links">
                                            <ul class="list-inline me-auto mb-0">
                                                <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                    aria-label="Edit" data-bs-original-title="Edit"><a
                                                        href="{{ route('accounts.edit', $account->id) }}"
                                                        class="avtar avtar-xs btn-link-success btn-pc-default"><i
                                                            class="ti ti-edit-circle f-18"></i></a></li>
                                                <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                    aria-label="Delete" data-bs-original-title="Delete">
                                                    <form action="{{ route('accounts.destroy', $account->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="avtar avtar-xs btn-link-danger btn-pc-default"><i
                                                                class="ti ti-trash f-18"></i></button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada rekening yang ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
