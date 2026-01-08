@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->order_number)

@section('content')
<div class="main-page-wrapper min-vh-100 py-5">
    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                {{-- Navigasi Kembali --}}
                <div class="mb-4" data-aos="fade-right">
                    <a href="{{ route('orders.index') }}"
                        class="text-decoration-none text-coffee-light small fw-bold text-uppercase hover-translate">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Riwayat Pesanan
                    </a>
                </div>

                <div class="card border-0 glass-card rounded-4 overflow-hidden shadow-lg">
                    {{-- Header Order --}}
                    <div class="card-header bg-transparent border-bottom border-white border-opacity-10 p-4">
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <h5 class="text-coffee-light small fw-bold text-uppercase mb-1">Nota Pesanan</h5>
                                <h2 class="h3 mb-0 fw-bolder text-white serif-font">#{{ $order->order_number }}</h2>
                                <p class="text-white-50 small mb-0">Dipesan pada {{ $order->created_at->format('d M Y,
                                    H:i') }}</p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                @php
                                $statusClasses = [
                                'pending' => 'bg-warning text-dark',
                                'processing' => 'bg-info text-dark',
                                'shipped' => 'bg-primary text-white',
                                'delivered' => 'bg-coffee-light text-dark',
                                'cancelled' => 'bg-danger text-white',
                                ];
                                $currentStatusClass = $statusClasses[$order->status] ?? 'bg-secondary text-white';
                                @endphp
                                <span
                                    class="badge rounded-pill px-4 py-2 fs-6 {{ $currentStatusClass }} shadow-glow-small">
                                    <i class="bi bi-dot fs-4 align-middle"></i>{{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Order Progress Tracker (Coffee Theme) --}}
                    <div
                        class="card-body bg-coffee-dark border-bottom border-white border-opacity-10 px-4 py-5 d-none d-md-block">
                        <div class="order-tracker d-flex justify-content-between position-relative">
                            <div class="tracker-line"></div>
                            @foreach(['pending', 'processing', 'shipped', 'delivered'] as $step)
                            @php
                            $isCompleted = in_array($order->status, ['processing','shipped','delivered']) && $step ==
                            'pending' ||
                            in_array($order->status, ['shipped','delivered']) && $step == 'processing' ||
                            ($order->status == 'delivered' && $step == 'shipped');
                            $isActive = $order->status === $step;
                            @endphp
                            <div
                                class="tracker-step text-center {{ $isActive ? 'active' : '' }} {{ $isCompleted ? 'completed' : '' }}">
                                <div class="step-icon shadow-sm mx-auto mb-2">
                                    <i
                                        class="bi bi-{{ $step == 'pending' ? 'receipt' : ($step == 'processing' ? 'cup-hot' : ($step == 'shipped' ? 'truck' : 'check2-all')) }}"></i>
                                </div>
                                <span
                                    class="small fw-bold text-uppercase {{ $isActive ? 'text-coffee-light' : 'text-white-50' }}">{{
                                    ucfirst($step) }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="card-body p-4 bg-transparent">
                        <div class="row g-4">
                            {{-- Detail Item --}}
                            <div class="col-md-7">
                                <h6 class="fw-bold mb-4 text-uppercase small text-coffee-light serif-font">Rincian Menu
                                </h6>
                                <div class="list-group list-group-flush bg-transparent">
                                    @foreach($order->items as $item)
                                    <div
                                        class="list-group-item px-0 py-3 bg-transparent border-white border-opacity-10">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-coffee-accent rounded-3 p-2 me-3">
                                                <i class="bi bi-cup-straw text-white fs-4"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1 fw-bold text-white">{{ $item->product_name }}</h6>
                                                <small class="text-white-50">{{ $item->quantity }} x Rp {{
                                                    number_format($item->discount_price ?? $item->price, 0, ',', '.')
                                                    }}</small>
                                            </div>
                                            <div class="text-end fw-bold text-coffee-light">
                                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Ringkasan Biaya & Alamat --}}
                            <div class="col-md-5">
                                <div class="glass-card-inner rounded-4 p-4 border border-white border-opacity-10">
                                    <h6 class="fw-bold mb-3 text-uppercase small text-coffee-light serif-font">Alamat
                                        Pengiriman</h6>
                                    <address class="small text-white-50 mb-4 lh-lg">
                                        <strong class="fs-6 text-white">{{ $order->shipping_name }}</strong><br>
                                        <i class="bi bi-telephone text-coffee-light me-2"></i>{{ $order->shipping_phone
                                        }}<br>
                                        <i class="bi bi-geo-alt text-coffee-light me-2"></i>{{ $order->shipping_address
                                        }}
                                    </address>

                                    <div class="divider-coffee mb-4"></div>

                                    <div class="d-flex justify-content-between mb-2 small text-white-50">
                                        <span>Subtotal</span>
                                        <span>Rp {{ number_format($order->total_amount - $order->shipping_cost, 0, ',',
                                            '.') }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3 small">
                                        <span class="text-white-50">Ongkos Kirim</span>
                                        <span class="text-success fw-bold">{{ $order->shipping_cost > 0 ? 'Rp ' .
                                            number_format($order->shipping_cost, 0, ',', '.') : 'GRATIS' }}</span>
                                    </div>
                                    <div
                                        class="d-flex justify-content-between align-items-center p-3 bg-coffee-dark rounded-3 border border-coffee-light border-opacity-20 shadow-glow-small">
                                        <span class="fw-bold text-white">Total Bayar</span>
                                        <span class="h4 mb-0 fw-bolder text-coffee-light">Rp {{
                                            number_format($order->total_amount, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Action Area --}}
                    @if($order->status === 'pending' && $order->snap_token)
                    <div class="card-footer bg-transparent p-4 border-top border-white border-opacity-10 text-center">
                        <div
                            class="alert bg-coffee-light bg-opacity-10 border-0 text-white rounded-4 p-3 mb-4 small shadow-sm">
                            <i class="bi bi-info-circle-fill text-coffee-light me-2"></i> Racikan Anda hampir siap.
                            Segera selesaikan pembayaran.
                        </div>
                        <button id="pay-button"
                            class="btn btn-coffee-light btn-lg px-5 rounded-pill fw-bold shadow-glow-warm py-3 hover-up">
                            <i class="bi bi-credit-card-2-back me-2"></i> Bayar Sekarang via Midtrans
                        </button>
                    </div>
                    @endif
                </div>

                <div class="text-center mt-4 text-white-50 small">
                    <p>Butuh bantuan dengan pesanan Anda? <a href="#"
                            class="text-coffee-light fw-bold text-decoration-none border-bottom border-coffee-light">Hubungi
                            Barista Kami</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap');

    .serif-font {
        font-family: 'Playfair Display', serif;
    }

    .main-page-wrapper {
        background: linear-gradient(180deg, #1a0f0a 0%, #2c1b12 100%);
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.03) !important;
        backdrop-filter: blur(20px);
        border: 1px solid rgba(212, 163, 115, 0.1) !important;
    }

    .glass-card-inner {
        background: rgba(0, 0, 0, 0.2);
    }

    .bg-coffee-dark {
        background-color: rgba(0, 0, 0, 0.15) !important;
    }

    .bg-coffee-accent {
        background-color: #8b5a2b !important;
    }

    .text-coffee-light {
        color: #d4a373 !important;
    }

    .divider-coffee {
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(212, 163, 115, 0.3), transparent);
    }

    /* Order Tracker Styles */
    .order-tracker {
        z-index: 1;
    }

    .tracker-line {
        position: absolute;
        top: 22px;
        left: 10%;
        right: 10%;
        height: 2px;
        background: rgba(212, 163, 115, 0.2);
        z-index: -1;
    }

    .tracker-step .step-icon {
        width: 48px;
        height: 48px;
        background: #2c1b12;
        border: 2px solid rgba(212, 163, 115, 0.3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.3);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .tracker-step.active .step-icon {
        border-color: #d4a373;
        background: #d4a373;
        color: #1a0f0a;
        transform: scale(1.2);
        box-shadow: 0 0 20px rgba(212, 163, 115, 0.4);
    }

    .tracker-step.completed .step-icon {
        border-color: #d4a373;
        color: #d4a373;
        background: rgba(212, 163, 115, 0.1);
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

    .shadow-glow-warm {
        box-shadow: 0 10px 25px rgba(212, 163, 115, 0.2);
    }

    .shadow-glow-small {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .hover-translate:hover {
        color: #faedcd !important;
        padding-left: 5px;
    }

    .hover-up:hover {
        transform: translateY(-3px);
    }
</style>

{{-- Snap.js Integration --}}
@if($order->snap_token)
@push('scripts')
<script src="{{ config('midtrans.snap_url') }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        const payButton = document.getElementById('pay-button');
        if (payButton) {
            payButton.addEventListener('click', function () {
                payButton.disabled = true;
                payButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Brewing Payment...';
                
                window.snap.pay('{{ $order->snap_token }}', {
                    onSuccess: (result) => window.location.href = '{{ route("orders.success", $order) }}',
                    onPending: (result) => window.location.href = '{{ route("orders.pending", $order) }}',
                    onError: (result) => {
                        alert('Pembayaran gagal!');
                        payButton.disabled = false;
                        payButton.innerHTML = '<i class="bi bi-credit-card me-2"></i> Bayar Sekarang';
                    },
                    onClose: () => {
                        payButton.disabled = false;
                        payButton.innerHTML = '<i class="bi bi-credit-card me-2"></i> Bayar Sekarang';
                    }
                });
            });
        }
    });
</script>
@endpush
@endif
@endsection