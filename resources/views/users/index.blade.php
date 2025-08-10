@extends('layouts.app')
@section('title', $title)
@section('content')

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ $breadcrumbs[0]['url'] }}">{{ $breadcrumbs[0]['name'] }}</a>
                        </li>
                        <li class="breadcrumb-item">{{ $breadcrumbs[1]['name'] }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card table-card">
            <div class="card-body">
                <div class="p-sm-4 pb-sm-2 d-flex justify-content-between align-items-center">
                    <h4>{{ $title }}</h4>
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus f-18"></i> Tambah Pengguna
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover tbl-product" id="dt-users">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ ucfirst($user->role) }}
                                        <div class="prod-action-links">
                                            <ul class="list-inline me-auto mb-0">
                                                <li class="list-inline-item">
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="avtar avtar-xs btn-link-success btn-pc-default">
                                                        <i class="ti ti-edit-circle f-18"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="avtar avtar-xs btn-link-danger btn-pc-default"
                                                            onclick="return confirm('Yakin hapus pengguna ini?')">
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
                                    <td colspan="5" class="text-center">Tidak ada pengguna yang ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
