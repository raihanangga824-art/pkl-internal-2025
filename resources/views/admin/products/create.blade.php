@extends('layouts.admin')

@section('title', 'Tambah Produk Baru')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0 text-dark">
                <i class="bi bi-plus-circle-dotted me-2 text-primary"></i> Tambah Produk Baru
            </h3>
            <p class="text-muted small">Kelola inventaris toko Anda dengan menambahkan produk berkualitas.</p>
        </div>

        <a href="{{ route('admin.products.index') }}" class="btn btn-light rounded-pill px-3 shadow-sm border">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="row">
        <div class="col-xl-8">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Card Utama --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-4 text-dark border-bottom pb-2">
                            <i class="bi bi-info-square me-2 text-primary"></i> Dasar Informasi
                        </h6>

                        {{-- Nama Produk --}}
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-uppercase text-muted">Nama Produk</label>
                            <input type="text" name="name"
                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" placeholder="Contoh: Coffee Arabica">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            {{-- Kategori --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label small fw-bold text-uppercase text-muted">Kategori</label>
                                <select name="category_id"
                                    class="form-select form-select-lg @error('category_id') is-invalid @enderror">
                                    <option value="" selected disabled>Pilih Kategori Produk</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id')==$category->id ?
                                        'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Berat --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label small fw-bold text-uppercase text-muted">Berat (Gram)</label>
                                <div class="input-group input-group-lg">
                                    <input type="number" name="weight"
                                        class="form-control @error('weight') is-invalid @enderror"
                                        value="{{ old('weight') }}" placeholder="500">
                                    <span class="input-group-text bg-light text-muted small">gr</span>
                                </div>
                                @error('weight')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <h6 class="fw-bold mb-4 mt-2 text-dark border-bottom pb-2">
                            <i class="bi bi-tags me-2 text-primary"></i> Inventaris & Harga
                        </h6>

                        <div class="row">
                            {{-- Harga --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label small fw-bold text-uppercase text-muted">Harga Jual</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light fw-bold text-primary">Rp</span>
                                    <input type="number" name="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price') }}" placeholder="0">
                                </div>
                                @error('price')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Stok --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label small fw-bold text-uppercase text-muted">Jumlah Stok</label>
                                <input type="number" name="stock"
                                    class="form-control form-control-lg @error('stock') is-invalid @enderror"
                                    value="{{ old('stock') }}" placeholder="0">
                                @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <h6 class="fw-bold mb-4 mt-2 text-dark border-bottom pb-2">
                            <i class="bi bi-card-image me-2 text-primary"></i> Media Produk
                        </h6>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase text-muted d-block">Unggah
                                Gambar</label>
                            <div class="image-upload-wrapper border-dashed rounded-4 p-4 text-center bg-light position-relative"
                                id="dropzone">
                                <input type="file" name="images[]" id="imagesInput" multiple
                                    class="position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer"
                                    accept="image/*">
                                <i class="bi bi-cloud-arrow-up fs-1 text-primary"></i>
                                <p class="mb-0 mt-2 fw-bold">Klik atau seret gambar ke sini</p>
                                <small class="text-muted">Mendukung JPG, PNG, WEBP (Maks. 2MB)</small>
                            </div>
                            <div id="imagePreviewContainer" class="row g-2 mt-3"></div>
                            @error('images')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-3 d-flex justify-content-between align-items-center">
                        <div class="form-check form-switch ms-2">
                            <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" {{
                                old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold text-muted small" for="isActive">PUBLIKASIKAN PRODUK
                                SEKARANG</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 shadow">
                            <i class="bi bi-check-circle me-1"></i> Simpan Produk
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Sidebar Tips --}}
        <div class="col-xl-4">
            <div class="card border-0 shadow-sm rounded-4 bg-primary text-white mb-4 overflow-hidden">
                <div class="card-body position-relative" style="z-index: 2;">
                    <h5 class="fw-bold mb-3"><i class="bi bi-lightbulb"></i> Tips Penjualan</h5>
                    <ul class="small ps-3 opacity-75">
                        <li class="mb-2">Gunakan nama produk yang jelas dan spesifik.</li>
                        <li class="mb-2">Pastikan gambar memiliki pencahayaan yang terang.</li>
                        <li class="mb-2">Cek kembali stok dan harga sebelum menyimpan.</li>
                        <li>Update berat produk agar biaya ongkir akurat.</li>
                    </ul>
                </div>
                <div class="position-absolute end-0 bottom-0 opacity-25" style="transform: translate(20%, 20%);">
                    <i class="bi bi-shop display-1"></i>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3 text-dark">Ringkasan Publikasi</h6>
                    <div class="d-flex justify-content-between small mb-2">
                        <span class="text-muted">Visibilitas</span>
                        <span class="fw-bold text-success" id="statusLabel">Publik</span>
                    </div>
                    <div class="d-flex justify-content-between small">
                        <span class="text-muted">Tanggal</span>
                        <span class="fw-bold text-dark">{{ date('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .border-dashed {
        border: 2px dashed #dee2e6;
        transition: all 0.3s;
    }

    .image-upload-wrapper:hover {
        border-color: #2563eb;
        background-color: #f1f5f9 !important;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .preview-img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 12px;
        border: 2px solid #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
</style>

@push('scripts')
<script>
    // Live Image Preview
    document.getElementById('imagesInput').addEventListener('change', function(event) {
        const container = document.getElementById('imagePreviewContainer');
        container.innerHTML = ''; // Clear previous
        
        const files = event.target.files;
        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'col-auto';
                div.innerHTML = `<img src="${e.target.result}" class="preview-img">`;
                container.appendChild(div);
            }
            reader.readAsDataURL(files[i]);
        }
    });

    // Toggle Status Label
    document.getElementById('isActive').addEventListener('change', function() {
        document.getElementById('statusLabel').innerText = this.checked ? 'Publik' : 'Draft';
        document.getElementById('statusLabel').className = this.checked ? 'fw-bold text-success' : 'fw-bold text-danger';
    });
</script>
@endpush

@endsection