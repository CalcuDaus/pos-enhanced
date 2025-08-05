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
    <!-- [ breadcrumb ] end --><!-- [ Main Content ] start -->
    <form class="row" method="POST" action="{{ $product ? route('products.update') : route('products.store') }}"
        enctype="multipart/form-data">
        @if ($product)
            @method('PUT')
            <input type="hidden" name="id" value="{{ Crypt::encrypt($product->id) }}">
        @endif
        @csrf
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5>Deskripsi Produk</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Produk">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select class="form-select" name="category_id">
                            <option selected disabled>Pilih Kategori</option>
                            <option>Category 1</option>
                            <option>Category 2</option>
                            <option>Category 3</option>
                            <option>Category 4</option>
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Deskripsi Produk</label>
                        <textarea class="form-control" name="description" placeholder="Masukkan Deskripsi Produk"></textarea>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>Harga</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label d-flex align-items-center">Harga Modal <i
                                        class="ph-duotone ph-info ms-1" data-bs-toggle="tooltip"
                                        data-bs-title="Harga Modal"></i></label>
                                <div class="input-group mb-3"><span class="input-group-text">$</span>
                                    <input type="text" class="form-control" name="cost_price" placeholder="Harga Modal">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label d-flex align-items-center">Harga Jual <i
                                        class="ph-duotone ph-info ms-1" data-bs-toggle="tooltip"
                                        data-bs-title="Harga Jual"></i></label>
                                <div class="input-group mb-3"><span class="input-group-text">$</span>
                                    <input type="text" class="form-control" name="price" placeholder="Harga Jual">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5>Gambar Produk</h5>
                </div>
                <div class="card-body">
                    <div class="mb-0">
                        <p><span class="text-danger">*</span> Resolusi yang disarankan adalah 640x640 px</p>
                        <label class="btn btn-outline-secondary" for="flupld"><i class="ti ti-upload me-2"></i> Klik Untuk
                            Unggah</label>
                        <input type="file" id="flupld" name="image" class="d-none">
                    </div>
                    <div class="preview-image">
                        @if ($product && $product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" @style(['max-width: 200px', 'max-height: 200px', 'display: block', 'margin-top: 10px', 'object-fit: contain']) class="img-preview">
                        @else
                            <img src="" @style(['max-width: 200px', 'max-height: 200px', 'display: block', 'margin-top: 10px', 'object-fit: contain']) class="img-preview">
                        @endif
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>Gudang</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="text" class="form-control" name="stock" placeholder="Masukkan Stok">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body text-end btn-page"><button class="btn btn-primary mb-0">Simpan Produk</button>
                    <button class="btn btn-outline-secondary mb-0">Reset</button>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script>
        const preview = document.querySelector('.img-preview');
        const imageInput = document.getElementById('flupld');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        });
    </script>
@endpush
