@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Market Overview')

@section('content')

<style>
    :root {
        --admin-bg: #f8fafc;
        --accent-primary: #2563eb;
        --accent-glow: rgba(37, 99, 235, 0.15);
    }

    /* ===== STAT CARDS (MODERN GLASS) ===== */
    .stat-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 1.5rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        border-color: var(--accent-primary);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.05);
    }

    .stat-card .icon-box {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1.25rem;
        transition: all 0.3s;
    }

    .stat-card:hover .icon-box {
        transform: scale(1.1) rotate(-5deg);
    }

    /* ===== PANEL PREMIUM (WHITE GLASS) ===== */
    .panel-premium {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        padding: 1.75rem;
        height: 100%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
    }

    /* ===== ACTIVITY FEED ===== */
    .activity-item {
        padding-left: 28px;
        border-left: 2px dashed #e2e8f0;
        position: relative;
        padding-bottom: 1.5rem;
    }

    .activity-item::before {
        content: '';
        position: absolute;
        left: -6px;
        top: 0;
        width: 10px;
        height: 10px;
        background: var(--accent-primary);
        box-shadow: 0 0 0 4px white, 0 0 0 7px var(--accent-glow);
        border-radius: 50%;
    }

    /* ===== PRODUCT ITEM ===== */
    .product-row-item {
        display: flex;
        align-items: center;
        padding: 14px;
        border-radius: 16px;
        background: #f8fafc;
        border: 1px solid transparent;
        transition: all 0.2s;
        margin-bottom: 10px;
    }

    .product-row-item:hover {
        background: white;
        border-color: #e2e8f0;
        transform: scale(1.02);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .product-row-item img {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        object-fit: cover;
        margin-right: 16px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .chart-container {
        position: relative;
        height: 350px;
        width: 100%;
    }

    .btn-action-sm {
        padding: 0.4rem 1rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.8rem;
    }
</style>

{{-- ===== STATS ROW ===== --}}
<div class="row g-4 mb-4">
    <div class="col-md-3" data-aos="fade-up">
        <div class="stat-card">
            <div class="icon-box bg-primary bg-opacity-10 text-primary">
                <i class="bi bi-currency-dollar"></i>
            </div>
            <div class="text-muted small fw-bold text-uppercase mb-1" style="letter-spacing: 0.5px;">Revenue</div>
            <h3 class="fw-bolder mb-0">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h3>
            <div class="mt-3">
                <span class="badge bg-success-subtle text-success rounded-pill">
                    <i class="bi bi-arrow-up-short"></i> 12.5%
                </span>
                <span class="text-muted small ms-1">vs last month</span>
            </div>
        </div>
    </div>

    <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
        <div class="stat-card">
            <div class="icon-box bg-warning bg-opacity-10 text-warning">
                <i class="bi bi-lightning-charge"></i>
            </div>
            <div class="text-muted small fw-bold text-uppercase mb-1" style="letter-spacing: 0.5px;">Pending</div>
            <h3 class="fw-bolder mb-0">{{ $stats['pending_orders'] }} <span
                    class="fs-6 text-muted fw-normal">Orders</span></h3>
            <div class="mt-3 text-warning small fw-medium">
                <i class="bi bi-info-circle me-1"></i> Need processing
            </div>
        </div>
    </div>

    <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
        <div class="stat-card">
            <div class="icon-box bg-danger bg-opacity-10 text-danger">
                <i class="bi bi-archive"></i>
            </div>
            <div class="text-muted small fw-bold text-uppercase mb-1" style="letter-spacing: 0.5px;">Low Stock</div>
            <h3 class="fw-bolder mb-0">{{ $stats['low_stock'] }} <span class="fs-6 text-muted fw-normal">Items</span>
            </h3>
            <div class="mt-3 text-danger small fw-medium">
                <i class="bi bi-exclamation-triangle me-1"></i> Restock required
            </div>
        </div>
    </div>

    <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
        <div class="stat-card">
            <div class="icon-box bg-info bg-opacity-10 text-info">
                <i class="bi bi-layers"></i>
            </div>
            <div class="text-muted small fw-bold text-uppercase mb-1" style="letter-spacing: 0.5px;">Catalog</div>
            <h3 class="fw-bolder mb-0">{{ $stats['total_products'] }}</h3>
            <div class="mt-3 text-muted small fw-medium">
                <i class="bi bi-check2-all me-1"></i> Active products
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    {{-- CHART PANEL --}}
    <div class="col-lg-8" data-aos="fade-right">
        <div class="panel-premium shadow-sm">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h5 class="fw-bold mb-1">Sales Analytics</h5>
                    <p class="text-muted small mb-0">Track your daily performance</p>
                </div>
                <div class="dropdown">
                    <button class="btn btn-light btn-action-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        This Month
                    </button>
                    <ul class="dropdown-menu border-0 shadow-lg">
                        <li><a class="dropdown-item" href="#">Last 7 Days</a></li>
                        <li><a class="dropdown-item" href="#">Last 30 Days</a></li>
                    </ul>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>

    {{-- ACTIVITY PANEL --}}
    <div class="col-lg-4" data-aos="fade-left">
        <div class="panel-premium shadow-sm">
            <h5 class="fw-bold mb-4">Recent Transactions</h5>
            <div class="activity-feed">
                @foreach($recentOrders as $order)
                <div class="activity-item">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="fw-bold text-dark">#{{ $order->order_number }}</span>
                        <span class="text-muted x-small">Today</span>
                    </div>
                    <div class="text-muted small mb-2">{{ $order->user->name }}</div>
                    <div class="badge bg-primary-subtle text-primary fw-bold">
                        Rp {{ number_format($order->total_amount,0,',','.') }}
                    </div>
                </div>
                @endforeach
            </div>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-primary w-100 rounded-pill fw-bold py-2 mt-2">
                View All Orders
            </a>
        </div>
    </div>
</div>

{{-- TOP PRODUCTS PANEL --}}
<div class="panel-premium mt-4 shadow-sm" data-aos="fade-up">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Best Selling Products</h5>
        {{-- <button class="btn btn-outline-primary btn-action-sm border-2">Export CSV</button> --}}
    </div>

    <div class="row g-3">
        @foreach($topProducts as $product)
        <div class="col-md-4">
            <div class="product-row-item">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                <div class="overflow-hidden">
                    <div class="fw-bold text-dark text-truncate small">{{ $product->name }}</div>
                    <div class="text-primary fw-bold" style="font-size: 0.85rem;">{{ $product->sold }} <span
                            class="text-muted fw-normal">Units Sold</span></div>
                </div>
                <div class="ms-auto">
                    <div class="icon-box bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 32px; height: 32px;">
                        <i class="bi bi-arrow-up-right text-primary small"></i>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    
    const chartGradient = ctx.createLinearGradient(0, 0, 0, 350);
    chartGradient.addColorStop(0, 'rgba(37, 99, 235, 0.2)');
    chartGradient.addColorStop(1, 'rgba(37, 99, 235, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($revenueChart->pluck('date')) !!},
            datasets: [{
                label: 'Revenue',
                data: {!! json_encode($revenueChart->pluck('total')) !!},
                borderColor: '#2563eb',
                borderWidth: 4,
                backgroundColor: chartGradient,
                fill: true,
                tension: 0.45,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#2563eb',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e293b',
                    padding: 12,
                    titleFont: { size: 14 },
                    callbacks: {
                        label: function(context) {
                            return ' Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                        }
                    }
                }
            },
            scales: {
                x: { 
                    grid: { display: false },
                    ticks: { color: '#94a3b8', font: { weight: '600' } }
                },
                y: { 
                    border: { display: false },
                    grid: { color: '#f1f5f9' },
                    ticks: { 
                        color: '#94a3b8',
                        callback: v => 'Rp ' + (v >= 1000000 ? (v/1000000).toFixed(1) + 'M' : (v/1000).toFixed(0) + 'k')
                    } 
                }
            }
        }
    });
</script>

@endsection