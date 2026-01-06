@extends('layouts.admin')

@section('page-title', 'Daftar Produk')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Manajemen Produk</h1>
            <p class="text-muted small mb-0">Kelola katalog dan stok produk Anda dengan mudah.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary shadow-sm px-4">
            <i class="fas fa-plus me-2"></i> Tambah Produk
        </a>
    </div>

    <!-- Table Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase fs-xs fw-bold text-muted">ID</th>
                            <th class="py-3 text-uppercase fs-xs fw-bold text-muted">Informasi Produk</th>
                            <th class="py-3 text-uppercase fs-xs fw-bold text-muted text-center">Harga</th>
                            <th class="py-3 text-uppercase fs-xs fw-bold text-muted text-center">Stok</th>
                            <th class="pe-4 py-3 text-uppercase fs-xs fw-bold text-muted text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <td class="ps-4">
                                <span class="text-muted fw-medium">#{{ $product->id }}</span>
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $product->name }}</div>
                                <div class="text-muted small">Kategori: {{ $product->category->name ?? 'Umum' }}</div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light text-dark fw-semibold border px-3 py-2">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="{{ $product->stock < 10 ? 'text-danger fw-bold' : 'text-dark' }}">
                                    {{ $product->stock }} <small class="text-muted">Unit</small>
                                </span>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                        class="btn btn-outline-primary btn-sm d-inline-flex align-items-center px-3 shadow-sm"
                                        style="border-radius: 8px; transition: all 0.3s;">
                                        <i class="fas fa-edit me-2"></i>
                                        <span>Edit</span>
                                    </a>
                            
                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm d-inline-flex align-items-center px-3 shadow-sm"
                                            style="border-radius: 8px; transition: all 0.3s;"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus produk {{ $product->name }}?')">
                                            <i class="fas fa-trash-alt me-2"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <img src="illustrations.popsy.co" alt="Empty" style="width: 120px;" class="mb-3">
                                <p class="text-muted mb-0">Belum ada produk yang terdaftar.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Styling untuk modernisasi */
    .fs-xs {
        font-size: 0.75rem;
        letter-spacing: 0.05em;
    }

    .btn-white {
        background: #fff;
        border-color: #dee2e6;
    }

    .btn-white:hover {
        background: #f8f9fa;
    }

    .card {
        overflow: hidden;
    }

    .table thead th {
        border-top: none;
    }

    .table tbody tr {
        transition: all 0.2s;
    }

    .table tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.01);
    }
</style>
@endsection