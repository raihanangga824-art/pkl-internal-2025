@extends('layouts.admin')

@section('title', 'Detail Pesanan #' . $order->order_number)

@section('content')
<div class="container-fluid">
    {{-- Header Page --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-link text-decoration-none p-0 mb-2">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pesanan
            </a>
            <h3 class="fw-bold mb-0">Pesanan <span class="text-primary">#{{ $order->order_number }}</span></h3>
            <p class="text-muted small">Dibuat pada {{ $order->created_at->format('d M Y, H:i') }}</p>
        </div>
        <div>
            @php
                $statusBadge = [
                    'pending' => 'bg-warning',
                    'processing' => 'bg-info',
                    'completed' => 'bg-success',
                    'cancelled' => 'bg-danger'
                ];
            @endphp
            <span class="badge {{ $statusBadge[$order->status] ?? 'bg-secondary' }} px-3 py-2 fs-6 rounded-pill">
                {{ ucfirst($order->status) }}
            </span>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            {{-- List Item Card --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-box-seam me-2 text-primary"></i>Rincian Produk</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle">
                            <thead class="text-muted small text-uppercase">
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-end">Harga Satuan</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr class="border-bottom-dashed">
                                    <td style="min-width: 250px;">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $item->product->image_url }}" class="rounded-3 me-3"
                                                style="width: 50px; height: 50px; object-fit: cover; border: 1px solid #eee;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">{{ $item->product->name }}</h6>
                                                <small class="text-muted">SKU: PROD-{{ $item->product->id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center fw-bold">{{ $item->quantity }}</td>
                                    <td class="text-end text-muted">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="text-end fw-bold text-dark">
                                        Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-light border-0 p-4 rounded-bottom-4">
                    <div class="row justify-content-end text-end">
                        <div class="col-md-5">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal Produk</span>
                                <span class="fw-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Biaya Layanan (Pajak)</span>
                                <span class="fw-bold">Rp 0</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 mb-0 fw-bold">Total Pembayaran</span>
                                <span class="h4 mb-0 fw-bold text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            {{-- Info Customer Card --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-person me-2 text-primary"></i>Informasi Pelanggan</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 me-3">
                            <i class="bi bi-person-badge fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">{{ $order->user->name }}</h6>
                            <p class="mb-0 text-muted small">{{ $order->user->email }}</p>
                        </div>
                    </div>
                    
                </div>
            </div>

            {{-- Action Update Status --}}
            <div class="card border-0 shadow-sm rounded-4 border-start border-4 border-primary">
                <div class="card-body">
                    <h6 class="fw-bold mb-3"><i class="bi bi-arrow-repeat me-2"></i>Perbarui Status</h6>
                    <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <select name="status" class="form-select form-select-lg shadow-none border-2">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>🕒 Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>📦 Processing</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>✅ Completed</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>❌ Cancelled</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold rounded-3">
                            Update Order
                        </button>
                    </form>

                    @if($order->status == 'cancelled')
                    <div class="alert alert-danger mt-3 mb-0 small border-0 bg-danger bg-opacity-10 text-danger rounded-3">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Pesanan dibatalkan. Stok otomatis dikembalikan ke sistem.
                    </div>
                    @endif
                </div>
            </div>
            
            <button class="btn btn-outline-secondary w-100 mt-3 rounded-pill" onclick="window.print()">
                <i class="bi bi-printer me-2"></i> Cetak Invoice
            </button>
        </div>
    </div>
</div>

<style>
    .border-bottom-dashed {
        border-bottom: 1px dashed #dee2e6;
    }
    .border-bottom-dashed:last-child {
        border-bottom: none;
    }
    .card {
        transition: transform 0.2s;
    }
    .form-select:focus {
        border-color: #0d6efd;
    }
    @media print {
        .btn, .card-header, select, .alert, .btn-link {
            display: none !important;
        }
        .card {
            box-shadow: none !important;
            border: 1px solid #eee !important;
        }
    }
</style>
@endsection