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

    <form method="POST" action="{{ $account ? route('accounts.update', $account->id) : route('accounts.store') }}"
        enctype="multipart/form-data">
        @csrf
        @if ($account)
            @method('PUT')
        @endif
        <div class="card">
            <div class="card-header">
                <h5>Form Rekening</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Nama Rekening</label>
                    <input type="text" name="account_name" class="form-control"
                        value="{{ old('account_name', $account ? $account->account_name : '') }}"
                        placeholder="Masukkan Nama Rekening">
                    @error('account_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Saldo</label>
                    <input type="number" name="balance" step="0.01" class="form-control"
                        value="{{ old('balance', $account ? $account->balance : 0) }}" placeholder="Masukkan Saldo">
                    @error('balance')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Logo / Gambar Rekening</label>
                    <input type="file" name="image" class="form-control">
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    @if ($account && $account->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/accounts/' . $account->image) }}" alt="Logo" height="50">
                        </div>
                    @endif
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
