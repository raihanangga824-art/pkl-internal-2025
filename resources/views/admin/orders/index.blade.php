@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Pesanan</li>
                </ol>
            </nav>
            <h2 class="h3 mb-0 fw-bold text-gray-800">Manajemen Pesanan</h2>
        </div>
        <div class="text-muted small">Total: {{ $orders->total() }} Pesanan</div>
    </div>

    {{-- Filter Bar Modern --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="bg-white p-2 rounded-3 shadow-sm d-flex overflow-auto">
                <a class="btn btn-sm me-2 {{ !request('status') ? 'btn-primary' : 'btn-light' }}"
                    href="{{ route('admin.orders.index') }}">Semua</a>

                @foreach(['pending' => 'Pending', 'processing' => 'Diproses', 'completed' => 'Selesai', 'cancelled' =>
                'Batal'] as $key => $label)
                <a class="btn btn-sm me-2 {{ request('status') == $key ? 'btn-primary' : 'btn-light text-muted' }}"
                    href="{{ route('admin.orders.index', ['status' => $key]) }}">
                    {{ $label }}
                </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Grid Layout --}}
    <div class="row">
        @forelse($orders as $order)
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 order-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="text-primary fw-bold">#{{ $order->order_number }}</span>
                            <div class="text-muted small mt-1">
                                <i class="bi bi-clock me-1"></i> {{ $order->created_at->diffForHumans() }}
                            </div>
                        </div>
                        @php
                        $statusClass = [
                        'pending' => 'bg-warning-subtle text-warning',
                        'processing' => 'bg-info-subtle text-info',
                        'completed' => 'bg-success-subtle text-success',
                        'cancelled' => 'bg-danger-subtle text-danger'
                        ][$order->status] ?? 'bg-secondary-subtle';
                        @endphp
                        <span class="badge {{ $statusClass }} px-3 py-2 rounded-pill shadow-none">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-3">
                        <div class="avatar-circle me-3">
                            {{ strtoupper(substr($order->user->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="fw-bold text-dark">{{ $order->user->name }}</div>
                            <div class="small text-muted">{{ $order->user->email }}</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small">Total Pembayaran</div>
                            <div class="h5 mb-0 fw-bold text-dark">Rp {{ number_format($order->total_amount, 0, ',',
                                '.') }}</div>
                        </div>
                        <a href="{{ route('admin.orders.show', $order) }}"
                            class="btn btn-outline-primary btn-sm px-4 rounded-pill">
                            Detail <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <img src="https://illustrations.popsy.co/gray/box.svg" alt="empty" style="width: 150px;" class="mb-3">
            <h5 class="text-muted">Tidak ada pesanan ditemukan.</h5>
        </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection