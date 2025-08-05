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
    <!-- [ breadcrumb ] end --><!-- [ Main Content ] start -->
    <div class="row">
        <div class="card table-card">
            <div class="card-body">
                <div class=" p-sm-4 pb-sm-2 d-flex justify-content-between align-items-center">
                    <h4>{{ $title }}</h4>
                    <a href="{{ route('products.create', ['param' => Crypt::encrypt('add')]) }}" class="btn btn-primary">
                        <i class="ti ti-plus f-18"></i> Add Product</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover tbl-product " id="dt-products">
                        <thead>
                            <tr>
                                <th class="text-end" style="width: 5.181347150259067%;">#</th>
                                <th style="width: 42.09844559585492%;">DETAIL PRODUK</th>
                                <th style="width: 20.984455958549223%;">KATEGORI</th>
                                <th class="text-end" style="width: 7.772020725388601%;">HARGA</th>
                                <th class="text-end" style="width: 5.829015544041451%;">STOK</th>
                                <th class="text-end" style="width: 5.829015544041451%;">BARCODE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr data-index="0">
                                    <td class="text-end">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-auto pe-0"><img src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->image }}" class="wid-40 rounded"></div>
                                            <div class="col">
                                                <h6 class="mb-1">{{ $product->name }}</h6>
                                                <p class="text-muted f-12 mb-0">{{ $product->description }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $product->category->name }}</td>
                                    <td class="text-end">Rp.{{ number_format($product->price, 2) }}</td>
                                    <td class="text-end">{{ $product->stock }}</td>
                                    <td class="text-end">{!! DNS1D::getBarcodeHTML($product->barcode, 'C128') !!}
                                        <div class="prod-action-links">
                                            <ul class="list-inline me-auto mb-0">
                                                <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                    aria-label="View" data-bs-original-title="View"><a href="#"
                                                        class="avtar avtar-xs btn-link-secondary btn-pc-default"
                                                        data-bs-toggle="offcanvas" data-bs-target="#productOffcanvas"><i
                                                            class="ti ti-eye f-18"></i></a></li>
                                                <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                    aria-label="Edit" data-bs-original-title="Edit"><a
                                                        href="{{ route('products.create', ['id' => Crypt::encrypt($product->id), 'param' => Crypt::encrypt('edit')]) }}"
                                                        class="avtar avtar-xs btn-link-success btn-pc-default"><i
                                                            class="ti ti-edit-circle f-18"></i></a></li>
                                                <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                    aria-label="Delete" data-bs-original-title="Delete">
                                                    <form
                                                        action="{{ route('products.destroy', Crypt::encrypt($product->id)) }}"
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
                                    <td colspan="7" class="text-center">Tidak ada produk yang ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
