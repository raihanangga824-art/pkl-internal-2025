@extends('layouts.admin')

@section('title', 'Laporan Penjualan')
@section('page-title', 'Analisis Penjualan')

@section('content')
<div class="container-fluid px-0">

    {{-- Filter Section: Clean & Integrated --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <form method="GET" class="row align-items-end g-3">
                <div class="col-md-3">
                    <label class="form-label fw-bold small text-muted text-uppercase">Dari Tanggal</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text bg-light border-0"><i class="bi bi-calendar-event"></i></span>
                        <input type="date" name="date_from" value="{{ $dateFrom }}"
                            class="form-control border-0 bg-light">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold small text-muted text-uppercase">Sampai Tanggal</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text bg-light border-0"><i class="bi bi-calendar-check"></i></span>
                        <input type="date" name="date_to" value="{{ $dateTo }}" class="form-control border-0 bg-light">
                    </div>
                </div>
                <div class="col-md-6 d-flex gap-2 justify-content-md-end">
                    <button type="submit" class="btn btn-dark px-4 rounded-3 fw-bold">
                        <i class="bi bi-funnel me-2"></i> Terapkan Filter
                    </button>
                    <a href="{{ route('admin.reports.sales.export', request()->all()) }}"
                        class="btn btn-outline-success px-4 rounded-3 fw-bold">
                        <i class="bi bi-file-earmark-excel me-2"></i> Ekspor Excel
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Summary Cards: Minimalist Stripe Style --}}
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0 p-3 bg-success bg-opacity-10 rounded-3 text-success">
                            <i class="bi bi-currency-dollar fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="text-muted small fw-bold text-uppercase mb-0">Total Pendapatan</h6>
                        </div>
                    </div>
                    <h2 class="fw-bold text-dark mb-1">Rp {{ number_format($summary->total_revenue ?? 0, 0, ',', '.') }}
                    </h2>
                    <span class="text-muted small">Pendapatan kotor dari order selesai</span>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0 p-3 bg-primary bg-opacity-10 rounded-3 text-primary">
                            <i class="bi bi-cart-check fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="text-muted small fw-bold text-uppercase mb-0">Volume Transaksi</h6>
                        </div>
                    </div>
                    <h2 class="fw-bold text-dark mb-1">{{ number_format($summary->total_orders ?? 0) }}</h2>
                    <span class="text-muted small">Jumlah pesanan berhasil diproses</span>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0 p-3 bg-warning bg-opacity-10 rounded-3 text-warning">
                            <i class="bi bi-lightning fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="text-muted small fw-bold text-uppercase mb-0">Rata-rata Order</h6>
                        </div>
                    </div>
                    @php
                    $avg = ($summary->total_orders > 0) ? ($summary->total_revenue / $summary->total_orders) : 0;
                    @endphp
                    <h2 class="fw-bold text-dark mb-1">Rp {{ number_format($avg, 0, ',', '.') }}</h2>
                    <span class="text-muted small">Rata-rata nilai per transaksi</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Sales By Category: Insightful Progress --}}
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-transparent border-0 p-4">
                    <h5 class="fw-bold text-dark mb-0">Kontribusi Kategori</h5>
                </div>
                <div class="card-body px-4 pt-0">
                    <div class="mb-4 text-center">
                        <i class="bi bi-pie-chart-fill text-light display-4"></i>
                    </div>
                    @foreach($byCategory as $cat)
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-end mb-2">
                            <div>
                                <span class="fw-bold d-block text-dark">{{ $cat->name }}</span>
                                <small class="text-muted">{{ number_format(($cat->total / ($summary->total_revenue ?:
                                    1)) * 100, 1) }}% dari total</small>
                            </div>
                            <span class="fw-bold text-dark small">Rp {{ number_format($cat->total, 0, ',', '.')
                                }}</span>
                        </div>
                        <div class="progress rounded-pill" style="height: 8px; background-color: #f1f5f9;">
                            <div class="progress-bar rounded-pill bg-primary" role="progressbar"
                                style="width: {{ ($cat->total / ($summary->total_revenue ?: 1)) * 100 }}%">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Transactions Table: Clean & Scannable --}}
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-transparent border-0 p-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold text-dark mb-0">Log Transaksi Terakhir</h5>
                    <span class="badge bg-light text-dark fw-medium border px-3">Paid Only</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr class="bg-light bg-opacity-50">
                                <th class="ps-4 py-3 text-uppercase fs-xs fw-bold text-muted">Order</th>
                                <th class="py-3 text-uppercase fs-xs fw-bold text-muted">Customer</th>
                                <th class="pe-4 py-3 text-uppercase fs-xs fw-bold text-muted text-end">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td class="ps-4 py-3">
                                    <a href="{{ route('admin.orders.show', $order) }}"
                                        class="fw-bold text-primary text-decoration-none">
                                        #{{ $order->order_number }}
                                    </a>
                                    <div class="text-muted small" style="font-size: 0.7rem;">{{
                                        $order->created_at->format('d M, H:i') }}</div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">{{ $order->user->name }}</div>
                                    <div class="text-muted small" style="font-size: 0.7rem;">{{ $order->user->email }}
                                    </div>
                                </td>
                                <td class="pe-4 text-end">
                                    <span class="fw-bold text-dark">Rp {{ number_format($order->total_amount, 0, ',',
                                        '.') }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-5">
                                    <p class="text-muted mb-0 small">Data tidak ditemukan untuk periode ini.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($orders->hasPages())
                <div class="card-footer bg-transparent border-0 py-3">
                    {{ $orders->appends(request()->all())->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .fs-xs {
        font-size: 0.7rem;
        letter-spacing: 0.05em;
    }

    .input-group-merge .input-group-text {
        border-right: 0;
    }

    .input-group-merge .form-control {
        border-left: 0;
    }

    .input-group-merge .form-control:focus {
        box-shadow: none;
    }

    .table thead th {
        border-bottom: 1px solid #f1f5f9;
    }

    .table tbody tr {
        transition: background 0.2s;
        cursor: pointer;
    }

    .table tbody tr:hover {
        background-color: #f8fafc !important;
    }

    /* Custom Scrollbar for better UX */
    .table-responsive::-webkit-scrollbar {
        height: 5px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 10px;
    }
</style>
@endsection