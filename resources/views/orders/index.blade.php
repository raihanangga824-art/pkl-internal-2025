@extends('layouts.app')

@section('content')
<div class="main-page-wrapper min-vh-100 py-5">
    <div class="container pt-4">
        {{-- Header Section --}}
        <div class="d-flex align-items-center justify-content-between mb-5" data-aos="fade-down">
            <div>
                <h2 class="fw-bolder text-white serif-font mb-1">Riwayat <span class="text-coffee-light">Pesanan</span>
                </h2>
                <p class="text-white-50 small mb-0">Daftar kenangan rasa dari setiap seduhan yang Anda pesan.</p>
            </div>
            <div class="d-none d-md-block">
                <i class="bi bi-journal-text text-coffee-light opacity-25" style="font-size: 3rem;"></i>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @forelse($orders as $order)
                <div class="card border-0 glass-card rounded-4 mb-3 overflow-hidden shadow-sm hover-up transition-all"
                    data-aos="fade-up">
                    <div class="card-body p-0">
                        <div class="row g-0 align-items-center">
                            {{-- Status Color Strip --}}
                            @php
                            $statusMap = [
                            'pending' => ['color' => '#ffc107', 'label' => 'Menunggu Bayar', 'icon' => 'clock-history'],
                            'processing' => ['color' => '#0dcaf0', 'label' => 'Sedang Diracik', 'icon' => 'cup-hot'],
                            'shipped' => ['color' => '#0d6efd', 'label' => 'Dalam Perjalanan', 'icon' => 'truck'],
                            'delivered' => ['color' => '#d4a373', 'label' => 'Sudah Dinikmati', 'icon' => 'check2-all'],
                            'cancelled' => ['color' => '#dc3545', 'label' => 'Dibatalkan', 'icon' => 'x-circle'],
                            ];
                            $status = $statusMap[$order->status] ?? ['color' => '#6c757d', 'label' => $order->status,
                            'icon' => 'box'];
                            @endphp

                            <div class="col-md-auto p-4 text-center d-flex flex-column justify-content-center border-end border-white border-opacity-10"
                                style="min-width: 160px;">
                                <div class="small text-white-50 text-uppercase letter-spacing-1 mb-1">ID Pesanan</div>
                                <div class="fw-bold text-coffee-light fs-5">#{{ $order->order_number }}</div>
                            </div>

                            <div class="col-md p-4">
                                <div class="row align-items-center">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-calendar3 text-white-50 me-2 small"></i>
                                            <span class="text-white small">{{ $order->created_at->format('d M Y, H:i')
                                                }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-{{ $status['icon'] }} me-2"
                                                style="color: {{ $status['color'] }}"></i>
                                            <span class="fw-bold" style="color: {{ $status['color'] }}">{{
                                                $status['label'] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 text-sm-end">
                                        <div class="small text-white-50 text-uppercase letter-spacing-1 mb-1">Total
                                            Pembayaran</div>
                                        <div class="fw-bolder text-white fs-4">Rp {{ number_format($order->total_amount,
                                            0, ',', '.') }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-auto p-4 border-start border-white border-opacity-10">
                                <a href="{{ route('orders.show', $order) }}"
                                    class="btn btn-coffee-light rounded-pill px-4 fw-bold w-100 shadow-sm hover-up">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="card border-0 glass-card rounded-4 p-5 text-center shadow-lg" data-aos="zoom-in">
                    <div class="mb-4">
                        <i class="bi bi-cup-hot text-coffee-light opacity-25" style="font-size: 5rem;"></i>
                    </div>
                    <h4 class="text-white serif-font">Belum ada cangkir yang diseduh.</h4>
                    <p class="text-white-50 mb-4">Mari mulai petualangan kopi pertama Anda hari ini.</p>
                    <a href="{{ route('catalog.index') }}" class="btn btn-coffee-light rounded-pill px-5 py-3 fw-bold">
                        Jelajahi Menu
                    </a>
                </div>
                @endforelse
            </div>
        </div>

        <div class="mt-5 d-flex justify-content-center coffee-pagination">
            {{ $orders->links() }}
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap');

    .serif-font {
        font-family: 'Playfair Display', serif;
    }

    .letter-spacing-1 {
        letter-spacing: 1px;
    }

    .main-page-wrapper {
        background: linear-gradient(180deg, #1a0f0a 0%, #2c1b12 100%);
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.03) !important;
        backdrop-filter: blur(15px);
        border: 1px solid rgba(212, 163, 115, 0.1) !important;
    }

    .text-coffee-light {
        color: #d4a373 !important;
    }

    .btn-coffee-light {
        background-color: #d4a373;
        color: #1a0f0a;
        border: none;
    }

    .btn-coffee-light:hover {
        background-color: #faedcd;
        transform: translateY(-3px);
    }

    .transition-all {
        transition: all 0.3s ease;
    }

    .hover-up:hover {
        transform: translateY(-5px);
    }

    /* Custom Pagination Styling */
    .coffee-pagination .pagination {
        --bs-pagination-bg: transparent;
        --bs-pagination-border-color: rgba(212, 163, 115, 0.2);
        --bs-pagination-color: #d4a373;
        --bs-pagination-active-bg: #d4a373;
        --bs-pagination-active-border-color: #d4a373;
        --bs-pagination-hover-color: #faedcd;
    }
</style>
@endsection