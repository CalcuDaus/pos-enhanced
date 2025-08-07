@extends('layouts.app')
@section('title', 'Sale Items')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../dashboard/index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0)">Penjualan</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Barang
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end --><!-- [ Main Content ] start -->
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-12 col-md-12 col-lg-8">
            <div class="card table-card">
                <div class="card-body pt-3">
                    <div class="table-responsive">
                        <table class="table table-hover tbl-product " id="dt-products">
                            <thead>
                                <tr>
                                    <th class="text-end" style="width: 5.181347150259067%;">#</th>
                                    <th style="width: 42.09844559585492%;">DETAIL PRODUK</th>
                                    <th style="width: 20.984455958549223%;">KATEGORI</th>
                                    <th class="text-end" style="width: 7.772020725388601%;">HARGA</th>
                                    <th class="text-end" style="width: 5.829015544041451%;">STOK</th>
                                    <th class="text-end" style="width: 5.829015544041451%;">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr data-index="0">
                                        <td class="text-end">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-auto pe-0"><img
                                                        src="{{ asset('storage/' . $product->image) }}" alt="no-image"
                                                        class="wid-40 rounded"></div>
                                                <div class="col">
                                                    <h6 class="mb-1">{{ $product->name }}</h6>
                                                    <p class="text-muted f-12 mb-0">{{ $product->description }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $product->category->name }}</td>
                                        <td class="text-end">Rp.{{ number_format($product->price, 2) }}</td>
                                        <td class="text-end">{{ $product->stock }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary btn-add-to-checkout"
                                                data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                                data-price="{{ $product->price }}">
                                                <i class="ph-duotone ph-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada produk yang tersedia.</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4">Checkout Form</h5>
                    <div class="mb-3">
                        <input type="text" id="barcode-input" class="form-control form-control-lg"
                            placeholder="Scan barcode..." autofocus>
                    </div>
                    <form method="POST" action="{{ route('sales.store') }}" id="checkout-form">
                        @csrf
                        <div id="checkout-list" class="list-group list-group-flush mb-3">

                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3 mb-2">
                            <strong>Total:</strong>
                            <span id="total-price" class="badge border text-secondary border-secondary fs-6">Rp.0</span>
                        </div>
                        <div class="d-flex justify-content-end gap-2 align-items-center mt-3 mb-2">
                            <button type="button" class="btn btn-danger btn-block  " id="btn-reset-checkout">Reset</button>
                            <button type="submit" class="btn btn-primary btn-block ">Checkout</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const datatable = document.querySelector('#dt-products');
            if (datatable) {
                new simpleDatatables.DataTable(datatable);
            }
            const checkoutList = document.getElementById('checkout-list');
            const totalPriceEl = document.getElementById('total-price');
            const addedItems = {};

            const productMap = new Map();
            @foreach ($products as $product)
                productMap.set("{{ $product->barcode }}", {
                    id: "{{ $product->id }}",
                    name: "{{ $product->name }}",
                    price: {{ $product->price }}
                });
            @endforeach

            function formatRupiah(num) {
                return "Rp." + num.toLocaleString();
            }

            function updateTotal() {
                let total = 0;
                Object.keys(addedItems).forEach(function(id) {
                    const qty = parseInt(document.getElementById(`qty-${id}`).value);
                    const price = parseFloat(addedItems[id].price);
                    total += qty * price;
                });
                totalPriceEl.textContent = formatRupiah(total);
            }

            document.querySelectorAll('.btn-add-to-checkout').forEach(function(button) {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const name = this.dataset.name;
                    const price = parseFloat(this.dataset.price);
                    addToCheckout(id, name, price);
                });
            });

            const barcodeInput = document.getElementById("barcode-input");
            barcodeInput.addEventListener("keypress", function(e) {
                if (e.key === "Enter") {
                    e.preventDefault();
                    const code = barcodeInput.value.trim();
                    if (productMap.has(code)) {
                        const product = productMap.get(code);
                        addToCheckout(product.id, product.name, product.price);
                    } else {
                        alert("Produk dengan barcode tersebut tidak ditemukan.");
                    }
                    barcodeInput.value = "";
                }
            });

            function addToCheckout(id, name, price) {
                if (addedItems[id]) {
                    incrementQuantity(id);
                } else {
                    const wrapper = document.createElement('div');
                    wrapper.className = "list-group-item d-flex justify-content-between align-items-center";
                    wrapper.id = `item-${id}`;
                    wrapper.innerHTML = `
                <div class="d-flex align-items-center">
                    <span class="me-2" style="min-width: 170px;">${name}</span>
                    <div class="btn-group btn-group-sm mb-0 border" role="group">
                        <button type="button" class="btn btn-link-secondary btn-decrease" data-id="${id}">
                            <i class="ti ti-minus"></i>
                        </button>
                        <input readonly class="wid-45 text-center border-0 m-0 form-control rounded-0 shadow-none" 
                               type="text" id="qty-${id}" value="1">
                        <button type="button" class="btn btn-link-secondary btn-increase" data-id="${id}">
                            <i class="ti ti-plus"></i>
                        </button>
                    </div>
                </div>
                <span class="badge bg-primary rounded-pill">${formatRupiah(price)}</span>

                <input type="hidden" name="items[${id}][product_id]" value="${id}">
                <input type="hidden" name="items[${id}][quantity]" value="1" id="input-qty-${id}">
            `;
                    checkoutList.appendChild(wrapper);
                    addedItems[id] = {
                        price: price
                    };
                    updateTotal();
                }
            }

            function incrementQuantity(id) {
                const qtyInput = document.getElementById(`qty-${id}`);
                const hiddenInput = document.getElementById(`input-qty-${id}`);
                const qty = parseInt(qtyInput.value) + 1;
                qtyInput.value = qty;
                hiddenInput.value = qty;
                updateTotal();
            }

            function decreaseQuantity(id) {
                const qtyInput = document.getElementById(`qty-${id}`);
                const hiddenInput = document.getElementById(`input-qty-${id}`);
                const qty = parseInt(qtyInput.value) - 1;

                if (qty <= 0) {
                    const item = document.getElementById(`item-${id}`);
                    checkoutList.removeChild(item);
                    delete addedItems[id];
                } else {
                    qtyInput.value = qty;
                    hiddenInput.value = qty;
                }
                updateTotal();
            }

            checkoutList.addEventListener("click", function(e) {
                if (e.target.closest(".btn-increase")) {
                    const id = e.target.closest(".btn-increase").dataset.id;
                    incrementQuantity(id);
                } else if (e.target.closest(".btn-decrease")) {
                    const id = e.target.closest(".btn-decrease").dataset.id;
                    decreaseQuantity(id);
                }
            });

            document.getElementById('btn-reset-checkout').addEventListener('click', function() {
                checkoutList.innerHTML = '';
                for (let key in addedItems) {
                    delete addedItems[key];
                }
                updateTotal();
            });

            window.addEventListener("load", () => barcodeInput.focus());
            // document.addEventListener("click", () => barcodeInput.focus());
        });
    </script>
@endpush
