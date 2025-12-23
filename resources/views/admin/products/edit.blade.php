@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">
                <i class="bi bi-pencil-square text-primary me-2"></i>Edit Produk
            </h2>
            <small class="text-muted">Perbarui informasi produk</small>
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
                        <i class="bi bi-box-seam me-2"></i> Form Edit Produk
                    </h5>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Informasi Produk --}}
                        <h6 class="fw-bold text-primary mb-3">
                            <i class="bi bi-info-circle me-1"></i> Informasi Produk
                        </h6>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Produk</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $product->name) }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Kategori</label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) ==
                                    $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Detail Produk --}}
                        <h6 class="fw-bold text-primary mb-3">
                            <i class="bi bi-cash-stack me-1"></i> Detail Produk
                        </h6>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Harga (Rp)</label>
                                <input type="number" name="price"
                                    class="form-control @error('price') is-invalid @enderror"
                                    value="{{ old('price', $product->price) }}">
                                @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Stok</label>
                                <input type="number" name="stock"
                                    class="form-control @error('stock') is-invalid @enderror"
                                    value="{{ old('stock', $product->stock) }}">
                                @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Berat (gram)</label>
                                <input type="number" name="weight"
                                    class="form-control @error('weight') is-invalid @enderror"
                                    value="{{ old('weight', $product->weight) }}">
                                @error('weight')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Gambar Produk --}}
                        <h6 class="fw-bold text-primary mt-4 mb-3">
                            <i class="bi bi-image me-1"></i> Gambar Produk
                        </h6>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Gambar Saat Ini</label>
                            <div class="d-flex flex-wrap gap-3">
                                @forelse($product->images as $image)
                                <div class="border rounded p-2 shadow-sm">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" class="rounded" width="120">
                                </div>
                                @empty
                                <span class="text-muted">Belum ada gambar</span>
                                @endforelse
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Upload Gambar Baru (opsional)</label>
                            <input type="file" name="images[]" multiple class="form-control">
                            <small class="text-muted">Bisa upload lebih dari satu gambar</small>
                        </div>

                        {{-- Action --}}
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-light">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-save me-1"></i> Update Produk
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection