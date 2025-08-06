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
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus f-18"></i> Tambah Kategori
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover tbl-product" id="dt-categories">
                        <thead>
                            <tr>
                                <th style="width: 10%;">#</th>
                                <th>Nama Kategori</th>
                                {{-- <th style="width: 20%;" class="text-end">Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}
                                        <div class="prod-action-links">
                                            <ul class="list-inline me-auto mb-0">

                                                <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                    aria-label="Edit" data-bs-original-title="Edit"><a
                                                        href="{{ route('categories.edit', $category->id) }}"
                                                        class="avtar avtar-xs btn-link-success btn-pc-default"><i
                                                            class="ti ti-edit-circle f-18"></i></a></li>
                                                <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                    aria-label="Delete" data-bs-original-title="Delete">
                                                    <form
                                                        action="{{ route('categories.destroy', Crypt::encrypt($category->id)) }}"
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
                                    <td colspan="3" class="text-center">Tidak ada kategori yang ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
