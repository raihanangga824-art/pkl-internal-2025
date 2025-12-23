@extends('layouts.admin')

@section('title', 'Tambah Produk')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">
                <i class="bi bi-box-seam me-2 text-primary"></i> Tambah Produk
            </h2>
            <small class="text-muted">Isi data produk dengan lengkap dan benar</small>
        </div>

        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-9">

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square me-2"></i> Form Tambah Produk
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Informasi Produk --}}
                        <h6 class="fw-bold mb-3 text-primary">
                            <i class="bi bi-info-circle me-1"></i> Informasi Produk
                        </h6>

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Produk</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" placeholder="Masukkan nama produk">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Kategori --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Kategori</label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' :
                                    '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Detail Produk --}}
                        <h6 class="fw-bold mb-3 text-primary">
                            <i class="bi bi-cash-stack me-1"></i> Detail Produk
                        </h6>

                        <div class="row">
                            {{-- Harga --}}
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Harga (Rp)</label>
                                <input type="number" name="price"
                                    class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}"
                                    placeholder="Contoh: 50000">
                                @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Stok --}}
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Stok</label>
                                <input type="number" name="stock"
                                    class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}"
                                    placeholder="Jumlah stok">
                                @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Berat --}}
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Berat (gram)</label>
                                <input type="number" name="weight"
                                    class="form-control @error('weight') is-invalid @enderror"
                                    value="{{ old('weight') }}" placeholder="Contoh: 500">
                                @error('weight')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- STATUS PRODUK (INI YANG PENTING!) --}}
                        <h6 class="fw-bold mt-4 mb-3 text-primary">
                            <i class="bi bi-toggle-on me-1"></i> Status Produk
                        </h6>

                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" {{
                                old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold">
                                Aktifkan Produk (Tampil di Toko)
                            </label>
                        </div>

                        {{-- Gambar --}}
                        <h6 class="fw-bold mt-4 mb-3 text-primary">
                            <i class="bi bi-image me-1"></i> Gambar Produk
                        </h6>

                        <div class="mb-4">
                            <input type="file" name="images[]" multiple
                                class="form-control @error('images') is-invalid @enderror">
                            <small class="text-muted">
                                Bisa upload lebih dari satu gambar (jpg, png, webp)
                            </small>
                            @error('images')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Action --}}
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-light">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-save me-1"></i> Simpan Produk
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection