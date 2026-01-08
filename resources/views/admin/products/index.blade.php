@extends('layouts.admin')

@section('title', 'Daftar Produk')
@section('page-title', 'Manajemen Produk')

@section('content')
<div class="container-fluid">
    
    {{-- BARIS STATISTIK: Memberikan ringkasan instan --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3 me-3">
                        <i class="bi bi-box-seam fs-4"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-bold text-uppercase">Total</div>
                        <div class="h5 mb-0 fw-bold text-dark">{{ $products->total() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-3 me-3">
                        <i class="bi bi-check-circle fs-4"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-bold text-uppercase">Aktif</div>
                        <div class="h5 mb-0 fw-bold text-dark">{{ $products->where('is_active', 1)->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3 me-3">
                        <i class="bi bi- exclamation-triangle fs-4"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-bold text-uppercase">Stok Tipis</div>
                        <div class="h5 mb-0 fw-bold text-dark">{{ $products->where('stock', '<=', 5)->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white border-start border-primary border-4">
                <a href="{{ route('admin.products.create') }}" class="text-decoration-none">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="fw-bold text-primary">Tambah Produk</div>
                        <i class="bi bi-arrow-right-circle fs-4 text-primary"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>

    {{-- CARD FILTER: Pencarian & Penyaringan Data --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <form action="{{ route('admin.products.index') }}" method="GET" class="row g-2">
                {{-- Search --}}
                <div class="col-lg-4">
                    <div class="input-group input-group-merge h-100">
                        <span class="input-group-text bg-light border-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control bg-light border-0" 
                               placeholder="Cari nama produk..." value="{{ request('search') }}">
                    </div>
                </div>
                
                {{-- Category Filter --}}
                <div class="col-lg-3">
                    <select name="category" class="form-select bg-light border-0 h-100" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Status Filter --}}
                <div class="col-lg-2">
                    <select name="status" class="form-select bg-light border-0 h-100" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>

                {{-- Action Buttons --}}
                <div class="col-lg-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1 rounded-3">
                        <i class="bi bi-funnel me-1"></i> Filter
                    </button>
                    @if(request()->anyFilled(['search', 'category', 'status']))
                        <a href="{{ route('admin.products.index') }}" class="btn btn-light rounded-3 px-3">
                            <i class="bi bi-arrow-clockwise"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- TABEL DATA --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 border-0 text-uppercase small fw-bold text-muted" style="width: 40%">Produk</th>
                        <th class="py-3 border-0 text-uppercase small fw-bold text-muted">Harga</th>
                        <th class="py-3 border-0 text-uppercase small fw-bold text-muted">Stok</th>
                        <th class="py-3 border-0 text-uppercase small fw-bold text-muted">Status</th>
                        <th class="py-3 border-0 text-uppercase small fw-bold text-muted text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($products as $product)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                @if($product->primaryImage)
                                    <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}" 
                                         class="rounded-3 me-3 shadow-sm border" width="48" height="48" style="object-fit: cover;">
                                @else
                                    <div class="bg-light rounded-3 me-3 d-flex align-items-center justify-content-center text-muted border" 
                                         style="width: 48px; height: 48px;">
                                        <i class="bi bi-image small"></i>
                                    </div>
                                @endif
                                <div class="overflow-hidden">
                                    <h6 class="mb-0 fw-bold text-dark text-truncate">{{ $product->name }}</h6>
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary small fw-normal">
                                        {{ $product->category->name ?? 'Tanpa Kategori' }}
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
                        </td>
                        <td>
                            @if($product->stock <= 5)
                                <div class="text-danger fw-bold small">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i>{{ $product->stock }} (Menipis)
                                </div>
                            @else
                                <div class="text-dark">{{ $product->stock }} <small class="text-muted">unit</small></div>
                            @endif
                        </td>
                        <td>
                            @if($product->is_active)
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                                    <i class="bi bi-dot"></i> Aktif
                                </span>
                            @else
                                <span class="badge bg-light text-muted rounded-pill px-3 py-2 border">
                                    <i class="bi bi-dot"></i> Draft
                                </span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group shadow-sm rounded-pill overflow-hidden border">
                                <a href="{{ route('admin.products.show', $product) }}" class="btn btn-white btn-sm px-3" title="Detail">
                                    <i class="bi bi-eye text-primary"></i>
                                </a>
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-white btn-sm px-3" title="Edit">
                                    <i class="bi bi-pencil text-info"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" 
                                      class="d-inline" onsubmit="return confirm('Hapus produk ini secara permanen?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-white btn-sm px-3" title="Hapus">
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="py-4">
                                <i class="bi bi-search display-4 text-muted opacity-25"></i>
                                <p class="mt-3 text-muted">Tidak ada produk yang sesuai dengan kriteria filter.</p>
                                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4">Reset Filter</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($products->hasPages())
        <div class="card-footer bg-white py-3 border-top-0 d-flex justify-content-between align-items-center">
            <p class="small text-muted mb-0">
                Menampilkan <b>{{ $products->firstItem() }}</b> - <b>{{ $products->lastItem() }}</b> dari <b>{{ $products->total() }}</b> produk
            </p>
            <div>
                {{ $products->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<style>
    .btn-white { background-color: #fff; }
    .btn-white:hover { background-color: #f8fafc; }
    .table-hover tbody tr:hover { background-color: #f9fafb !important; }
    .input-group-merge .input-group-text { border-right: none; }
    .input-group-merge .form-control { border-left: none; }
    .input-group-merge .form-control:focus { box-shadow: none; border-color: #dee2e6; }
</style>
@endsection