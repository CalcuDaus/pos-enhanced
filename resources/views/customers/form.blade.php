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

    <form method="POST" action="{{ $customer ? route('customers.update', $customer->id) : route('customers.store') }}">
        @csrf
        @if ($customer)
            @method('PUT')
        @endif
        <div class="card">
            <div class="card-header">
                <h5>Form Pelanggan</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name', $customer ? $customer->name : '') }}" placeholder="Masukkan Nama Pelanggan">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Telepon</label>
                    <input type="text" name="phone" class="form-control"
                        value="{{ old('phone', $customer ? $customer->phone : '') }}" placeholder="Masukkan Nomor Telepon">
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email', $customer ? $customer->email : '') }}" placeholder="Masukkan Email">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="address" class="form-control" placeholder="Masukkan Alamat">{{ old('address', $customer ? $customer->address : '') }}</textarea>
                    @error('address')
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
