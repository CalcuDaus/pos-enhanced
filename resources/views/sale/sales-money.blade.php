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
    <form method="POST" action="{{ route('sales.store-money') }}" class="row">
        @csrf
        <!-- [ sample-page ] start -->
        <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h4 style="font-family: poppins;" class="mb-4">Pilih Rekening <span class="text-danger">*</span>
                        </h4>
                        <div class="col-12 d-flex justify-content-between align-items-center flex-wrap">
                            @foreach ($accounts as $account)
                                <label class="card card-money" style="width: 180px;cursor: pointer;"
                                    for="account_{{ $account->id }}">
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <input type="radio" hidden name="account_{{ $account->id }}"
                                            value="{{ $account->id }}"
                                            class="form-check-input account_{{ $account->id }}">
                                        <h5 class="card-title">{{ $account->account_name }}</h5>
                                        <img src="{{ asset('storage/' . $account->image) }}"
                                            alt="{{ $account->account_name }}"
                                            style="width:80%;min-height: 120px; object-fit: contain;">
                                        <p class="card-text">Rp.{{ number_format($account->balance, 2, ',', '.') }}</p>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-5">
            <div class="card">
                <div class="card-body d-flex flex-column gap-2 ">
                    <h4 style="font-family: poppins;" class="mt-1 mb-3">Form Transaksi <span class="text-danger">*</span>
                    </h4>
                    <div class="container">
                        <input type="number" name="amount" class="form-control mb-3"
                            placeholder="(Rp) Masukkan jumlah uang " required>
                        <label for="in" id="in" class="btn btn-outline-primary btn-sm ">Masuk</label>
                        <input type="radio" hidden name="type_transaction" value="in"
                            class="form-check-input input_type_transaction" id="in">
                        <label for="out" id="out" class="btn  btn-outline-danger  btn-sm">Keluar</label>
                        <input type="radio" hidden name="type_transaction" value="out"
                            class="form-check-input   input_type_transaction" id="out">
                        <div class="d-flex gap-1 my-3">
                            <label for="profit" id="profit" class="btn btn-outline-primary btn-sm ">Untung</label>
                            <input type="radio" hidden name="is_profit" value="profit"
                                class="form-check-input input_profit" id="profit">
                            <label for="not_profit" id="is_profit" class="btn  btn-outline-danger  btn-sm">Rugi</label>
                            <input type="radio" hidden name="is_profit" value="not_profit"
                                class="form-check-input input_profit" id="is_profit">
                            <label for="manual" id="manual" class="btn  btn-outline-warning  btn-sm">Atur</label>
                            <input type="radio" hidden name="is_profit" value="manual"
                                class="form-check-input input_profit" id="manual">
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
    </style>
@endpush
@push('scripts')
    <script>
        let cardMoneys = document.querySelectorAll('.card-money');
        cardMoneys.forEach(card => {
            card.addEventListener('click', function() {
                cardMoneys.forEach(c => c.classList.remove('active'));
                cardMoneys.forEach(c => {
                    let input = c.querySelector('input[type="radio"]');
                    if (input) {
                        input.checked = false;
                    }
                });
                this.classList.add('active');
                let input = this.querySelector('input[type="radio"]');
                if (input) {
                    input.checked = true;
                }
            });
        });
        let btns = document.querySelectorAll('.btn-outline-primary, .btn-outline-danger, .btn-outline-warning');
        let inputManual = document.querySelector('#amount_manual');
        let inputTypeTransaction = document.querySelectorAll('.input_type_transaction');
        let inputProfit = document.querySelectorAll('.input_profit');
        btns.forEach(btn => {
            btn.addEventListener('click', function() {
                this.classList.remove('btn-outline-primary', 'btn-outline-danger', 'btn-outline-warning');
                if (this.id === 'in') {
                    inputTypeTransaction.forEach(b => {
                        b.checked = false;
                        if (b.id === 'in') {
                            b.checked = true;
                        }
                    });
                    this.checked = true;
                    this.classList.add('btn-primary');
                    document.querySelector('#out').classList.add('btn-outline-danger');
                    document.querySelector('#out').classList.remove('btn-danger');
                } else if (this.id === 'out') {
                    inputTypeTransaction.forEach(b => {
                        b.checked = false;
                        if (b.id === 'out') {
                            b.checked = true;
                        }
                    });
                    this.checked = true;
                    this.classList.add('btn-danger');
                    document.querySelector('#in').classList.add('btn-outline-primary');
                    document.querySelector('#in').classList.remove('btn-primary');
                }
                if (this.id === 'profit') {
                    inputProfit.forEach(b => {
                        b.checked = false;
                        if (b.id === 'profit') {
                            b.checked = true;
                        }
                    });
                    this.checked = true;
                    this.classList.add('btn-primary');
                    document.querySelector('#is_profit').classList.add('btn-outline-danger');
                    document.querySelector('#is_profit').classList.remove('btn-danger');
                    document.querySelector('#manual').classList.add('btn-outline-warning');
                    document.querySelector('#manual').classList.remove('btn-warning');
                    inputManual.setAttribute('hidden', true);
                } else if (this.id === 'is_profit') {
                    inputProfit.forEach(b => {
                        b.checked = false;
                        if (b.id === 'is_profit') {
                            b.checked = true;
                        }
                    });
                    this.checked = true;
                    this.classList.add('btn-danger');
                    document.querySelector('#profit').classList.add('btn-outline-primary');
                    document.querySelector('#profit').classList.remove('btn-primary');
                    document.querySelector('#manual').classList.add('btn-outline-warning');
                    document.querySelector('#manual').classList.remove('btn-warning');
                    inputManual.setAttribute('hidden', true);
                } else if (this.id === 'manual') {
                    inputProfit.forEach(b => {
                        b.checked = false;
                        if (b.id === 'manual') {
                            b.checked = true;
                        }
                    });
                    this.checked = true;
                    this.classList.add('btn-warning');
                    document.querySelector('#profit').classList.add('btn-outline-primary');
                    document.querySelector('#profit').classList.remove('btn-primary');
                    document.querySelector('#is_profit').classList.add('btn-outline-danger');
                    document.querySelector('#is_profit').classList.remove('btn-danger');
                    inputManual.removeAttribute('hidden');
                }
            });
        });
    </script>
@endpush
