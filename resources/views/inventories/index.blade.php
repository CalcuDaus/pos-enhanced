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
                <div class="table-responsive">
                    <table class="table table-hover tbl-product" id="dt-products">
                        <thead>
                            <tr>
                                <th style="width: 5.181347150259067%;">#</th>
                                <th style="width: 42.09844559585492%;">DETAIL PRODUK</th>
                                <th style="width: 20.984455958549223%;">PERUBAHAN</th>
                                <th style="width: 5.829015544041451%;">QTY</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($inventories as $inventory)
                                <tr data-index="0">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-auto pe-0"><img
                                                    src="{{ asset('storage/' . $inventory->product->image) }}"
                                                    alt="user-image" class="wid-40 rounded"></div>
                                            <div class="col">
                                                <h6 class="mb-1">{{ $inventory->product->name }}</h6>
                                                <p class="text-muted f-12 mb-0">{{ $inventory->product->description }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($inventory->change_type === 'add')
                                            <span class="text-success">+{{ $inventory->note }}</span>
                                        @elseif ($inventory->change_type === 'sale')
                                            <span class="text-warning">{{ $inventory->note }}</span>
                                        @else
                                            <span class="text-warning">-{{ $inventory->note }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $inventory->product->stock }}
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada log stok</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
