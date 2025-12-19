@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    {{-- Total Pendapatan --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Total Pendapatan</p>
                    <h4>Rp {{ number_format($stats['total_revenue'] ?? 0, 0, ',', '.') }}</h4>
                </div>
                <div class="bg-success bg-opacity-10 rounded p-3">
                    <i class="bi bi-currency-dollar text-success fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Total Pesanan --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Total Pesanan</p>
                    <h4>{{ $stats['total_orders'] ?? 0 }}</h4>
                </div>
                <div class="bg-primary bg-opacity-10 rounded p-3">
                    <i class="bi bi-bag text-primary fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Pesanan Pending --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Perlu Diproses</p>
                    <h4>{{ $stats['pending_orders'] ?? 0 }}</h4>
                </div>
                <div class="bg-warning bg-opacity-10 rounded p-3">
                    <i class="bi bi-clock text-warning fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Stok Menipis --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Stok Menipis</p>
                    <h4>{{ $stats['low_stock'] ?? 0 }}</h4>
                </div>
                <div class="bg-danger bg-opacity-10 rounded p-3">
                    <i class="bi bi-exclamation-triangle text-danger fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Recent Orders --}}
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Pesanan Terbaru</h5>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No. Order</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                            <tr>
                                <td><a href="{{ route('admin.orders.show', $order) }}">#{{ $order->order_number }}</a></td>
                                <td>{{ $order->user->name ?? 'Guest' }}</td>
                                <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td><span class="badge bg-{{ $order->status_color ?? 'secondary' }}">{{ ucfirst($order->status) }}</span></td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada pesanan terbaru.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white"><h5 class="mb-0">Aksi Cepat</h5></div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i> Tambah Produk</a>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-primary"><i class="bi bi-folder-plus me-2"></i> Kelola Kategori</a>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-primary"><i class="bi bi-bag me-2"></i> Kelola Pesanan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
