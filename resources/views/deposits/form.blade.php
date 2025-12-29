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

    <form method="POST" action="{{ $deposit ? route('deposits.update', $deposit->id) : route('deposits.store') }}">
        @csrf
        @if ($deposit)
            @method('PUT')
        @endif
        <div class="card">
            <div class="card-header">
                <h5>Form Titipan</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Pelanggan <span>(Opsional Jika Nama Pelanggan Tidak Ada)</span></label>
                    <select name="customer_id" class="form-control">
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}"
                                {{ old('customer_id', $deposit?->customer_id) == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('customer_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Masukkan Nama Pelanggan</label>
                    <input type="text"  name="customer_name" class="form-control"
                        value="{{ old('customer_name', $deposit ? $deposit->customer->name : '') }}" placeholder="Masukkan Nama Pelanggan">
                    @error('customer_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah Titipan</label>
                    <input type="number" step="0.01" name="amount" class="form-control"
                        value="{{ old('amount', $deposit ? $deposit->amount : '') }}" placeholder="Masukkan Jumlah Titipan">
                    @error('amount')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body text-end">
                <button type="submit" class="btn btn-primary mb-0">Simpan</button>
                <button type="reset" class="btn btn-outline-secondary mb-0">Reset</button>
            </div>
        </div>
    </form>
@endsection
