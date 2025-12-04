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
                </div>

                <div class="table-responsive">
                    <table class="table table-hover tbl-product" id="dt-sales-history">
                        <thead>
                            <tr>
                                <th style="width: 6%">#</th>
                                <th>Invoice</th>
                                <th>Barang</th>
                                <th>Kasir</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                                <th style="width: 15%" class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sales as $sale)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ $sale->invoice }}</strong>
                                    </td>
                                    <td><span class="badge bg-danger bg-gradient">{{ $sale->saleItems->count() }}</span>
                                        <button id="detailProducts" data-id="{{ $sale->id }}"
                                            class="badge bg-primary bg-gradient border-0">Detail Barang</button>
                                    </td>
                                    <td>{{ $sale->user->name ?? '-' }}</td>
                                    <td>Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                                    <td>{{ $sale->created_at ? $sale->created_at->format('d M Y - H:i') : '-' }}</td>

                                    <td class="text-end">
                                        <div class="prod-action-links">
                                            <ul class="list-inline me-auto mb-0">

                                                <!-- Detail -->
                                                <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                    aria-label="Detail" data-bs-original-title="Detail">
                                                    <a href="#"
                                                        class="avtar avtar-xs btn-link-primary btn-pc-default">
                                                        <i class="ti ti-eye f-18"></i>
                                                    </a>
                                                </li>

                                                <!-- Delete -->
                                                <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                    aria-label="Hapus" data-bs-original-title="Hapus">
                                                    <form action="#" method="post"
                                                        onsubmit="return confirm('Hapus penjualan ini?')">
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
                                    <td colspan="7" class="text-center text-muted py-4">
                                        Tidak ada riwayat penjualan ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const btnDetailProducts = document.querySelectorAll('#detailProducts');
        btnDetailProducts.forEach(btn => {
            btn.addEventListener('click', function() {
                fetch(`/sales-history-product-details/${this.dataset.id}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }).then(response => response.json()).then(data => {
                    if (data.status == 'success') {
                        let dataProductList = data['data'];
                        let htmlProductList = dataProductList.map(item => {
                            return `
                                <div style="border-bottom:1px solid #ccc; padding:10px 0;text-align:left;">
                                    <strong>${item.product_name}</strong><br/>
                                    Qty: ${item.quantity} x Rp ${item.price.toLocaleString('id-ID')}<br/>
                                    Subtotal: Rp ${item.subtotal.toLocaleString('id-ID')}
                                </div>
                            `;
                        }).join('');
                        swal.fire({
                            title: 'Detail List Barang',
                            html: htmlProductList,
                            confirmButtonText: 'Tutup',
                        });
                    }else{
                        alert('Gagal mengambil detail produk.');
                    }
                });
            });
        });
    </script>
@endpush
