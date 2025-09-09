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
        <div class="col-12 col-md-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex justify-content-between">
                            <h4 style="font-family: poppins;" class="mb-4">Pilih Rekening <span
                                    class="text-danger">*</span>

                            </h4>
                            <p>
                                Total Saldo : <span style="font-size:20px;font-weight:bold;">
                                    Rp.{{ number_format($accounts_sum, 2, ',', '.') }}
                                </span></p>
                        </div>

                        <div class="col-12 d-flex gap-4 justify-content-center align-items-center flex-wrap">
                            @foreach ($accounts as $account)
                                <label class="card card-money" style="width: 180px;cursor: pointer;"
                                    for="account_{{ $account->id }}">
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <input type="radio" hidden name="account_id" value="{{ $account->id }}"
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
        <div class="col-12 col-md-12 col-lg-6">
            <div class="card">
                <div class="card-body d-flex flex-column gap-2 ">
                    <h4 style="font-family: poppins;" class="mt-1 mb-3">Form Transaksi <span class="text-danger">*</span>
                    </h4>
                    <div class="container">
                        <input type="text" name="amount" class="form-control mb-3"
                            placeholder="(Rp) Masukkan jumlah uang " required inputmode="numeric">
                        <h6>Pilih Tipe Transaksi</h6>
                        <label for="in" id="in" class="btn btn-outline-primary btn-sm ">Masuk</label>
                        <input type="radio" hidden name="type_transaction" value="in"
                            class="form-check-input input_type_transaction" id="in">
                        <label for="out" id="out" class="btn  btn-outline-danger  btn-sm">Keluar</label>
                        <input type="radio" hidden name="type_transaction" value="out"
                            class="form-check-input   input_type_transaction" id="out">
                        <div class="d-flex gap-1 my-3 flex-column">
                            <h6>Atur Keuntungan / Rugi</h6>
                            <div class="d-flex gap-1">
                                <label for="profit" id="profit" class="btn btn-primary  btn-sm">Untung</label>
                                <input type="radio" hidden checked name="is_profit" value="profit"
                                    class="form-check-input input_profit" id="profit">
                                <label for="manual" id="manual" class="btn  btn-outline-warning  btn-sm">TF Rekening
                                    Pribadi</label>
                                <input type="radio" hidden name="is_profit" value="manual"
                                    class="form-check-input input_profit" id="manual">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <button type="submit" class="btn btn-success w-100">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="row justify-content-end riwayat-transaksi">
        <div class="col-12 col-md-12 col-lg-6 ">
            <div class="card">
                <div class="card-body d-flex flex-column gap-2 ">
                    <h4 style="font-family: poppins;" class="mt-1 mb-3">Riwayat Transaksi<span class="text-danger">*</span>
                    </h4>
                    <div class="container" style="font-family: Poppins">
                        <div class="table-responsive">
                            <table class="table table-hover tbl-product" id="dt-riwayat">
                                <thead>
                                    <tr>
                                        <th>Nama Rekening</th>
                                        <th>Tipe Transaksi</th>
                                        <th>Nominal</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($mutations as $mutation)
                                        <tr>
                                            <td>{{ $mutation->account->account_name }}</td>
                                            <td class="text-center">
                                                @if ($mutation->mutation_type == 'in')
                                                    <span style="font-size: 12px;background-color: #1da83b"
                                                        class=" px-3 py-1 rounded text-white">Masuk</span>
                                                @else
                                                    <span style="font-size: 12px"
                                                        class="bg-danger px-3 py-1 rounded text-white">Keluar</span>
                                                @endif
                                            </td>
                                            <td> Rp. {{ number_format($mutation->amount, 0, ',', '.') ?? 0 }}</td>
                                            <td>{{ $mutation->created_at }}
                                                <div class="prod-action-links">
                                                    <ul class="list-inline me-auto mb-0">
                                                        <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                            aria-label="Delete" data-bs-original-title="Delete">
                                                            <form
                                                                action="{{ route('sales.delete-money', $mutation->id) }}"
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
                                            <td colspan="3" class="text-center">Belum ada riwayat hari ini.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        .card-money {
            cursor: pointer;
            transition: transform 0.2s !important;
        }

        .riwayat-transaksi{
            transform: translateY(-780px)
        }

        @media (max-width: 876px) {
            .riwayat-transaksi{
                transform: translateY(0px)
            }
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
        // Function to format number with Indonesian currency format
        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Function to remove formatting and get clean number
        function cleanNumber(formattedNum) {
            return formattedNum.replace(/\./g, '');
        }

        // Get the amount input field
        const amountInput = document.querySelector('input[name="amount"]');

        if (amountInput) {
            // Change input type to text for formatting support
            amountInput.type = 'text';
            amountInput.setAttribute('inputmode', 'numeric');

            // Add event listener for input formatting
            amountInput.addEventListener('input', function(e) {
                // Get current cursor position
                let cursorPosition = e.target.selectionStart;

                // Get the current value and remove any existing formatting
                let value = e.target.value.replace(/\./g, '');

                // Remove any non-digit characters
                value = value.replace(/\D/g, '');

                // Don't format if empty
                if (value === '') {
                    e.target.value = '';
                    return;
                }

                // Store original length
                let originalLength = e.target.value.length;

                // Format the number
                let formattedValue = formatNumber(value);

                // Set the formatted value
                e.target.value = formattedValue;

                // Calculate new cursor position
                let newLength = formattedValue.length;
                let lengthDiff = newLength - originalLength;
                let newCursorPosition = cursorPosition + lengthDiff;

                // Ensure cursor position is within bounds
                if (newCursorPosition < 0) newCursorPosition = 0;
                if (newCursorPosition > formattedValue.length) newCursorPosition = formattedValue.length;

                // Set cursor position after a brief delay
                setTimeout(() => {
                    e.target.setSelectionRange(newCursorPosition, newCursorPosition);
                }, 0);
            });

            // Handle paste events
            amountInput.addEventListener('paste', function(e) {
                setTimeout(() => {
                    let value = e.target.value.replace(/\D/g, '');
                    if (value !== '') {
                        e.target.value = formatNumber(value);
                    }
                }, 0);
            });

            // Add validation to ensure only numbers can be entered
            amountInput.addEventListener('keypress', function(e) {
                // Allow backspace, delete, tab, escape, enter
                if ([8, 9, 27, 13, 46].indexOf(e.keyCode) !== -1 ||
                    // Allow Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                    (e.keyCode === 65 && e.ctrlKey === true) ||
                    (e.keyCode === 67 && e.ctrlKey === true) ||
                    (e.keyCode === 86 && e.ctrlKey === true) ||
                    (e.keyCode === 88 && e.ctrlKey === true)) {
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
        }

        // Update form submission to send clean number
        const form = document.querySelector('form');
        if (form && amountInput) {
            form.addEventListener('submit', function(e) {
                // Clean the amount value before submission
                let cleanValue = cleanNumber(amountInput.value);

                // Validate that we have a number
                if (cleanValue === '' || isNaN(cleanValue)) {
                    e.preventDefault();
                    alert('Mohon masukkan jumlah yang valid');
                    return false;
                }

                // Set the clean value for submission
                amountInput.value = cleanValue;
            });
        }

        // Rest of your existing JavaScript code...
        const datatable = document.querySelector('#dt-riwayat');
        if (datatable) {
            new simpleDatatables.DataTable(datatable);
        }

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

        let btns = document.querySelectorAll(
            '.btn-outline-primary, .btn-outline-danger, .btn-outline-warning,.btn-primary');
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
                    this.classList.add('btn-danger');
                    document.querySelector('#in').classList.add('btn-outline-primary');
                    document.querySelector('#in').classList.remove('btn-primary');
                }
                console.log(this);
                if (this.id === 'profit') {
                    inputProfit.forEach(b => {
                        b.checked = false;
                        if (b.id === 'profit') {
                            b.checked = true;
                        }
                    });
                    console.log(this);
                    this.classList.add('btn-primary');
                    document.querySelector('#manual').classList.add('btn-outline-warning');
                    document.querySelector('#manual').classList.remove('btn-warning');
                } else if (this.id === 'manual') {
                    inputProfit.forEach(b => {
                        b.checked = false;
                        if (b.id === 'manual') {
                            b.checked = true;
                        }
                    });
                    console.log(this);
                    this.classList.add('btn-warning');
                    document.querySelector('#profit').classList.add('btn-outline-primary');
                    document.querySelector('#profit').classList.remove('btn-primary');
                }
            });
        });
    </script>
@endpush
