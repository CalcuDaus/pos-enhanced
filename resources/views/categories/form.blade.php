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

    <form method="POST" action="{{ $category ? route('categories.update', $category->id) : route('categories.store') }}">
        @csrf
        @if ($category)
            @method('PUT')
        @endif
        <div class="card">
            <div class="card-header">
                <h5>Form Kategori</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name', $category ? $category->name : '') }}" placeholder="Masukkan Nama Kategori">
                    @error('name')
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
