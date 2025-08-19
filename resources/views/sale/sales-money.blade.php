@extends('layouts.app')

@section('title', 'Sale Items')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">Penjualan</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Barang
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- [ Main Content ] start -->
    <form method="POST" action="{{ route('sales.store-money') }}" class="row">
        @csrf

        <!-- Pilih Rekening -->
        <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4 title-section">Pilih Rekening <span class="text-danger">*</span></h4>
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        @foreach ($accounts as $account)
                            <label class="card card-money" style="width: 180px; cursor: pointer;"
                                for="account_{{ $account->id }}">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <input type="radio" hidden name="account_id" value="{{ $account->id }}"
                                        class="form-check-input account_{{ $account->id }}">
                                    <h5 class="card-title">{{ $account->account_name }}</h5>
                                    <img src="{{ asset('storage/' . $account->image) }}" alt="{{ $account->account_name }}"
                                        class="account-image">
                                    <p class="card-text">
                                        Rp.{{ number_format($account->balance, 2, ',', '.') }}
                                    </p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Transaksi -->
        <div class="col-12 col-md-12 col-lg-5">
            <div class="card">
                <div class="card-body d-flex flex-column gap-2">
                    <h4 class="mt-1 mb-3 title-section">Form Transaksi <span class="text-danger">*</span></h4>

                    <div class="container">
                        <input type="number" name="amount" class="form-control mb-3"
                            placeholder="(Rp) Masukkan jumlah uang" required>

                        <!-- Jenis Transaksi -->
                        <label for="in" class="btn btn-outline-primary btn-sm">Masuk</label>
                        <input type="radio" hidden name="type_transaction" value="in"
                            class="form-check-input input_type_transaction" id="in">

                        <label for="out" class="btn btn-outline-danger btn-sm">Keluar</label>
                        <input type="radio" hidden name="type_transaction" value="out"
                            class="form-check-input input_type_transaction" id="out">

                        <!-- Profit / Rugi / Manual -->
                        <div class="d-flex gap-1 my-3">
                            <label for="profit" class="btn btn-outline-primary btn-sm">Untung</label>
                            <input type="radio" hidden name="is_profit" value="profit"
                                class="form-check-input input_profit" id="profit">

                            <label for="not_profit" class="btn btn-outline-danger btn-sm">Rugi</label>
                            <input type="radio" hidden name="is_profit" value="not_profit"
                                class="form-check-input input_profit" id="is_profit">

                            <label for="manual" class="btn btn-outline-warning btn-sm">Atur</label>
                            <input type="radio" hidden name="is_profit" value="manual"
                                class="form-check-input manual_input" id="manual">
                        </div>

                        <input type="number" hidden id="amount_manual" name="amount_manual" class="form-control mb-3"
                            placeholder="(Rp) Masukkan jumlah uang">
                    </div>

                    <div class="container">
                        <button type="submit" class="btn btn-success w-100">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('styles')
    <style>
        .title-section {
            font-family: poppins;
        }

        .card-money {
            cursor: pointer;
            transition: transform 0.2s !important;
        }

        .card-money:hover {
            transform: scale(1.05);
            background-color: rgba(49, 147, 228, 0.5) !important;
        }

        .card-money.active {
            background-color: rgba(49, 147, 228, 0.5) !important;
            border: 2px solid #3193e4;
        }

        .account-image {
            width: 80%;
            min-height: 120px;
            object-fit: contain;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Handle pilih rekening
            const cardMoneys = document.querySelectorAll('.card-money');
            cardMoneys.forEach(card => {
                card.addEventListener('click', () => {
                    cardMoneys.forEach(c => {
                        c.classList.remove('active');
                        const input = c.querySelector('input[type="radio"]');
                        if (input) input.checked = false;
                    });

                    card.classList.add('active');
                    const input = card.querySelector('input[type="radio"]');
                    if (input) input.checked = true;
                });
            });

            // Handle tombol transaksi & profit
            const btns = document.querySelectorAll(
                '.btn-outline-primary, .btn-outline-danger, .btn-outline-warning');
            const inputManual = document.querySelector('#amount_manual');
            const inputTypeTransaction = document.querySelectorAll('.input_type_transaction');
            const inputProfit = document.querySelectorAll('.input_profit');

            btns.forEach(btn => {
                btn.addEventListener('click', () => {
                    if (btn.id === 'in' || btn.id === 'out') {
                        inputTypeTransaction.forEach(b => b.checked = (b.id === btn.id));
                        toggleBtnClass(btn, 'primary', 'danger', '#in', '#out');
                    }

                    if (btn.id === 'profit' || btn.id === 'is_profit') {
                        inputProfit.forEach(b => b.checked = (b.id === btn.id));
                        toggleBtnClass(btn, 'primary', 'danger', '#profit', '#is_profit');
                    }

                    if (btn.id === 'manual') {
                        document.querySelector('.manual_input').checked = true;
                        btn.classList.add('btn-warning');
                        inputManual.removeAttribute('hidden');
                    }
                });
            });

            function toggleBtnClass(btn, activeClass, otherClass, selector1, selector2) {
                if (btn.id === selector1.replace('#', '')) {
                    btn.classList.add(`btn-${activeClass}`);
                    document.querySelector(selector2).classList.add(`btn-outline-${otherClass}`);
                    document.querySelector(selector2).classList.remove(`btn-${otherClass}`);
                } else {
                    btn.classList.add(`btn-${otherClass}`);
                    document.querySelector(selector1).classList.add(`btn-outline-${activeClass}`);
                    document.querySelector(selector1).classList.remove(`btn-${activeClass}`);
                }
            }
        });
    </script>
@endpush
