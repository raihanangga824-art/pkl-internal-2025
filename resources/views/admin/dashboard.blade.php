@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

{{-- ================= MODERN UI STYLE ================= --}}
<style>
    :root {
        --card-radius: 18px;
    }

    .glass {
        background: rgba(255, 255, 255, .75);
        backdrop-filter: blur(12px);
        border-radius: var(--card-radius);
    }

    .card-modern {
        border: none;
        border-radius: var(--card-radius);
        box-shadow: 0 10px 30px rgba(0, 0, 0, .05);
        transition: all .3s ease;
    }

    .card-modern:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, .08);
    }

    .icon-box {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
    }

    .section-title {
        font-weight: 700;
        letter-spacing: .4px;
    }

    .muted {
        color: #6c757d;
        font-size: .85rem;
    }

    .order-row {
        transition: background .2s;
    }

    .order-row:hover {
        background: #f8f9fa;
    }
</style>

{{-- ================= STATISTICS ================= --}}
<div class="row g-4 mb-4">

    {{-- Revenue --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card-modern glass p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="muted text-uppercase">Pendapatan</div>
                    <h4 class="fw-bold mt-2 text-success">
                        Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}
                    </h4>
                </div>
                <div class="icon-box bg-success bg-opacity-10 text-success">
                    <i class="bi bi-wallet2"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Pending --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card-modern glass p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="muted text-uppercase">Perlu Diproses</div>
                    <h4 class="fw-bold mt-2 text-warning">
                        {{ $stats['pending_orders'] }}
                    </h4>
                </div>
                <div class="icon-box bg-warning bg-opacity-10 text-warning">
                    <i class="bi bi-box-seam"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Low Stock --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card-modern glass p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="muted text-uppercase">Stok Menipis</div>
                    <h4 class="fw-bold mt-2 text-danger">
                        {{ $stats['low_stock'] }}
                    </h4>
                </div>
                <div class="icon-box bg-danger bg-opacity-10 text-danger">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Products --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card-modern glass p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="muted text-uppercase">Total Produk</div>
                    <h4 class="fw-bold mt-2 text-primary">
                        {{ $stats['total_products'] }}
                    </h4>
                </div>
                <div class="icon-box bg-primary bg-opacity-10 text-primary">
                    <i class="bi bi-tags"></i>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ================= MAIN CONTENT ================= --}}
<div class="row g-4">

    {{-- Chart --}}
    <div class="col-lg-8">
        <div class="card-modern glass p-4 h-100">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="section-title">📊 Revenue Overview</h5>
                <span class="muted">7 Hari Terakhir</span>
            </div>
            <div style="height:320px">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Recent Orders --}}
    <div class="col-lg-4">
        <div class="card-modern glass h-100">
            <div class="p-4 border-bottom">
                <h5 class="section-title">🧾 Pesanan Terbaru</h5>
            </div>

            <div class="list-group list-group-flush">
                @foreach($recentOrders as $order)
                <div class="list-group-item px-4 py-3 border-0 order-row">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="fw-semibold text-primary">
                                #{{ $order->order_number }}
                            </div>
                            <small class="muted">{{ $order->user->name }}</small>
                        </div>
                        <div class="text-end">
                            <div class="fw-semibold">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </div>
                            <span class="badge rounded-pill
                                {{ $order->payment_status === 'paid'
                                    ? 'bg-success bg-opacity-10 text-success'
                                    : 'bg-secondary bg-opacity-10 text-secondary' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center py-3 border-top">
                <a href="{{ route('admin.orders.index') }}" class="fw-semibold text-decoration-none">
                    Lihat Semua →
                </a>
            </div>
        </div>
    </div>

</div>

{{-- ================= TOP PRODUCTS ================= --}}
<div class="card-modern glass p-4 mt-4">
    <h5 class="section-title mb-4">🔥 Produk Terlaris</h5>

    <div class="row g-4">
        @foreach($topProducts as $product)
        <div class="col-6 col-md-2">
            <div class="card-modern p-3 text-center h-100">
                <img src="{{ $product->image_url }}" style="height:90px;width:100%;object-fit:cover;border-radius:12px">
                <h6 class="fw-semibold mt-2 text-truncate">
                    {{ $product->name }}
                </h6>
                <small class="muted">{{ $product->sold }} terjual</small>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- ================= CHART JS ================= --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($revenueChart->pluck('date')) !!},
            datasets: [{
                data: {!! json_encode($revenueChart->pluck('total')) !!},
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13,110,253,.15)',
                tension: .4,
                fill: true,
                pointRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: val => 'Rp ' + new Intl.NumberFormat('id-ID').format(val)
                    }
                }
            }
        }
    });
</script>

@endsection