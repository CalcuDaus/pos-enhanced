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
            // ==== 1. DATA & STATE ====
            const checkoutList = document.getElementById('checkout-list');
            const totalPriceEl = document.getElementById('total-price');
            const barcodeInput = document.getElementById('barcode-input');

            const currencyFormatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0
            });

            // products di-pass dari Blade
            const products = {!! json_encode(
                $products->map(function ($p) {
                        return [
                            'id' => $p->id,
                            'barcode' => $p->barcode,
                            'name' => $p->name,
                            'price' => $p->price,
                        ];
                    })->toArray(),
            ) !!};
            const productMap = new Map(products.map(p => [p.barcode, p]));
            const addedItems = new Map(); // key: id, value: { name, price, qty }

            // ==== 2. HELPER ====
            function escapeHtml(unsafe) {
                return unsafe.replace(/[&<>"']/g, m => ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;'
                } [m]));
            }

            function formatRupiah(num) {
                return currencyFormatter.format(num);
            }

            function updateTotal() {
                let total = 0;
                for (const [, item] of addedItems) {
                    total += item.price * item.qty;
                }
                totalPriceEl.textContent = formatRupiah(total);
            }

            // ==== 3. DOM RENDER ====
            function renderItem(id, name, price, qty = 1) {
                const wrapper = document.createElement('div');
                wrapper.id = `item-${id}`;
                wrapper.className = "list-group-item d-flex justify-content-between align-items-center";
                wrapper.innerHTML = `
            <div class="d-flex align-items-center">
                <span class="me-2" style="min-width: 170px;">${escapeHtml(name)}</span>
                <div class="btn-group btn-group-sm mb-0 border" role="group">
                    <button type="button" class="btn btn-link-secondary btn-decrease" data-id="${id}">
                        <i class="ti ti-minus"></i>
                    </button>
                    <input readonly class="wid-45 text-center border-0 m-0 form-control rounded-0 shadow-none"
                           type="text" id="qty-${id}" value="${qty}">
                    <button type="button" class="btn btn-link-secondary btn-increase" data-id="${id}">
                        <i class="ti ti-plus"></i>
                    </button>
                </div>
            </div>
            <span class="badge bg-primary rounded-pill">${formatRupiah(price)}</span>
            <input type="hidden" name="items[${id}][product_id]" value="${id}">
            <input type="hidden" name="items[${id}][quantity]" value="${qty}" id="input-qty-${id}">
        `;
                checkoutList.appendChild(wrapper);
            }

            function removeItem(id) {
                const el = document.getElementById(`item-${id}`);
                if (el) el.remove();
            }

            // ==== 4. LOGIC ====
            function addToCheckout(id, name, price) {
                if (addedItems.has(id)) {
                    incrementQuantity(id);
                    return;
                }
                addedItems.set(id, {
                    name,
                    price,
                    qty: 1
                });
                renderItem(id, name, price);
                updateTotal();
            }

            function incrementQuantity(id) {
                const item = addedItems.get(id);
                if (!item) return;
                item.qty++;
                document.getElementById(`qty-${id}`).value = item.qty;
                document.getElementById(`input-qty-${id}`).value = item.qty;
                updateTotal();
            }

            function decreaseQuantity(id) {
                const item = addedItems.get(id);
                if (!item) return;
                item.qty--;
                if (item.qty <= 0) {
                    addedItems.delete(id);
                    removeItem(id);
                } else {
                    document.getElementById(`qty-${id}`).value = item.qty;
                    document.getElementById(`input-qty-${id}`).value = item.qty;
                }
                updateTotal();
            }

            function resetCheckout() {
                checkoutList.innerHTML = '';
                addedItems.clear();
                updateTotal();
            }

            // ==== 5. EVENT HANDLING ====
            // Delegasi untuk tombol + dan -
            checkoutList.addEventListener("click", function(e) {
                const btnInc = e.target.closest(".btn-increase");
                const btnDec = e.target.closest(".btn-decrease");

                if (btnInc) incrementQuantity(btnInc.dataset.id);
                if (btnDec) decreaseQuantity(btnDec.dataset.id);
            });

            // Tombol reset
            document.getElementById('btn-reset-checkout').addEventListener('click', resetCheckout);

            // Input barcode
            barcodeInput.addEventListener("keydown", function(e) {
                if (e.key === "Enter") {
                    e.preventDefault();
                    const code = barcodeInput.value.trim();
                    if (productMap.has(code)) {
                        const product = productMap.get(code);
                        addToCheckout(product.id, product.name, product.price);
                    } else {
                        Swal.fire({
                            icon: "error",
                            delay: 1000,
                            title: "Oops...",
                            text: "Produk dengan barcode tersebut tidak ditemukan.",
                        });
                    }
                    barcodeInput.value = "";
                }
            });

            // Tombol add manual (class .btn-add-to-checkout)
            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.btn-add-to-checkout');
                if (!btn) return;
                addToCheckout(btn.dataset.id, btn.dataset.name, parseFloat(btn.dataset.price));
            });

            // Fokus awal ke barcode input
            window.addEventListener("load", () => barcodeInput.focus());
        });
    </script>
@endpush
