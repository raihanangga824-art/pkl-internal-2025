@extends('layouts.admin')

@section('title', 'Edit Produk - Elite Admin')

@section('content')
<div class="container-fluid py-4">

    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}"
                            class="text-decoration-none">Produk</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
            <h2 class="fw-bold mb-0 text-dark">
                Update <span class="text-primary">Katalog</span>
            </h2>
        </div>
        <a href="{{ route('admin.products.index') }}" class="btn btn-white border-0 shadow-sm rounded-pill px-4">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            {{-- Kolom Kiri: Form Utama --}}
            <div class="col-xl-8 col-lg-7" data-aos="fade-right">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                    <div class="card-header bg-white py-3 border-0 mt-2 px-4">
                        <h5 class="fw-bold mb-0">Informasi Dasar</h5>
                    </div>
                    <div class="card-body p-4 pt-0">
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Nama Produk</label>
                            <input type="text" name="name"
                                class="form-control form-control-lg bg-light border-0 rounded-3 @error('name') is-invalid @enderror"
                                value="{{ old('name', $product->name) }}" placeholder="Contoh: Sneakers Pro 2026">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Kategori</label>
                                <select name="category_id"
                                    class="form-select form-control-lg bg-light border-0 rounded-3 @error('category_id') is-invalid @enderror">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) ==
                                        $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Stok Barang</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="bi bi-box"></i></span>
                                    <input type="number" name="stock"
                                        class="form-control form-control-lg bg-light border-0 rounded-end-3 @error('stock') is-invalid @enderror"
                                        value="{{ old('stock', $product->stock) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Harga (IDR)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0">Rp</span>
                                    <input type="number" name="price"
                                        class="form-control form-control-lg bg-light border-0 rounded-end-3 @error('price') is-invalid @enderror"
                                        value="{{ old('price', $product->price) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Berat (gram)</label>
                                <div class="input-group">
                                    <input type="number" name="weight"
                                        class="form-control form-control-lg bg-light border-0 rounded-start-3 @error('weight') is-invalid @enderror"
                                        value="{{ old('weight', $product->weight) }}">
                                    <span class="input-group-text bg-light border-0">gr</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Deskripsi Produk (Opsi Tambahan) --}}
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <label class="form-label fw-bold small text-muted text-uppercase">Deskripsi Produk</label>
                        <textarea name="description" class="form-control bg-light border-0 rounded-3"
                            rows="5">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Media & Actions --}}
            <div class="col-xl-4 col-lg-5" data-aos="fade-left">
                {{-- Preview Media --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                    <div
                        class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">Media Gallery</h5>
                        <span class="badge bg-primary-subtle text-primary rounded-pill">{{ $product->images->count() }}
                            Foto</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="image-preview-grid d-flex flex-wrap gap-2 mb-3">
                            @forelse($product->images as $image)
                            <div class="position-relative group overflow-hidden rounded-3 border"
                                style="width: 100px; height: 100px;">
                                <img src="{{ asset('storage/' . $image->image_path) }}"
                                    class="w-100 h-100 object-fit-cover transition-all">
                                <div
                                    class="overlay-action position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50 opacity-0 group-hover-opacity-100 transition-all">
                                    <i class="bi bi-eye text-white fs-4 cursor-pointer"></i>
                                </div>
                            </div>
                            @empty
                            <div class="text-center w-100 py-4 border border-dashed rounded-3">
                                <i class="bi bi-image text-muted fs-1"></i>
                                <p class="text-muted small">Tidak ada gambar</p>
                            </div>
                            @endforelse
                        </div>

                        <div
                            class="upload-zone p-3 bg-light rounded-4 text-center border-2 border-dashed border-primary-subtle">
                            <input type="file" name="images[]" multiple class="form-control d-none" id="imageInput">
                            <label for="imageInput" class="cursor-pointer">
                                <i class="bi bi-cloud-arrow-up fs-2 text-primary"></i>
                                <p class="mb-0 small fw-bold mt-2 text-dark">Upload Gambar Baru</p>
                                <span class="text-muted x-small">Format: JPG, PNG, WEBP</span>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Card Simpan --}}
                <div class="card border-0 shadow-sm rounded-4 bg-primary-gradient p-2">
                    <div class="card-body">
                        <button type="submit" class="btn btn-white w-100 rounded-pill py-3 fw-bold shadow-sm mb-2">
                            <i class="bi bi-check2-circle me-2"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.products.index') }}"
                            class="btn btn-link text-white w-100 text-decoration-none small opacity-75">
                            Batalkan Pengeditan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    .bg-primary-gradient {
        background: linear-gradient(135deg, #2563eb, #0d6efd);
    }

    .form-control-lg:focus {
        background-color: #fff !important;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        border: 1px solid #2563eb !important;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .group-hover-opacity-100 {
        transition: 0.3s;
    }

    .position-relative:hover .group-hover-opacity-100 {
        opacity: 1 !important;
    }

    .object-fit-cover {
        object-fit: cover;
    }

    .x-small {
        font-size: 0.75rem;
    }

    .border-dashed {
        border-style: dashed !important;
    }
</style>
@endsection