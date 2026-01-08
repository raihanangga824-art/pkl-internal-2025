@extends('layouts.app')

@section('content')
<div class="main-page-wrapper min-vh-100 d-flex align-items-center justify-content-center py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5 text-center">
                {{-- Animasi / Icon Sukses --}}
                <div class="success-animation mb-4" data-aos="zoom-in">
                    <div class="coffee-cup-wrapper shadow-glow-warm mx-auto">
                        <i class="bi bi-check-lg check-icon"></i>
                        <i class="bi bi-cup-hot-fill cup-main"></i>
                    </div>
                </div>

                {{-- Konten Teks --}}
                <div data-aos="fade-up" data-aos-delay="200">
                    <h1 class="serif-font text-white mb-3">Pesanan <span class="text-coffee-light">Diterima!</span></h1>
                    <p class="text-white-50 mb-4 px-md-5">
                        Terima kasih! Pembayaran Anda telah kami validasi. Saat ini barista kami sedang menyiapkan
                        racikan terbaik untuk Anda.
                    </p>
                </div>

                {{-- Detail Singkat & Action --}}
                <div class="glass-card rounded-4 p-4 mb-4 border border-white border-opacity-10 shadow-lg"
                    data-aos="fade-up" data-aos-delay="400">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-white-50 small">Nomor Pesanan:</span>
                        <span class="fw-bold text-white">#{{ $order->order_number }}</span>
                    </div>
                    <div class="divider-coffee mb-3"></div>
                    <div class="d-grid gap-2">
                        <a href="{{ route('orders.show', $order) }}"
                            class="btn btn-coffee-light rounded-pill py-3 fw-bold hover-up shadow-sm">
                            <i class="bi bi-search me-2"></i> Lacak Status Pesanan
                        </a>
                        <a href="{{ route('catalog.index') }}"
                            class="btn btn-outline-light border-opacity-25 rounded-pill py-2 small opacity-75 hover-up">
                            Kembali ke Menu
                        </a>
                    </div>
                </div>

                {{-- Footer Kecil --}}
                <p class="text-white-50 small" data-aos="fade-up" data-aos-delay="600">
                    <i class="bi bi-envelope me-1"></i> Konfirmasi pesanan telah dikirim ke email Anda.
                </p>
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
        background: radial-gradient(circle at center, #2c1b12 0%, #1a0f0a 100%);
    }

    /* Icon Animation */
    .coffee-cup-wrapper {
        width: 120px;
        height: 120px;
        background: #d4a373;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        margin-bottom: 2rem;
    }

    .cup-main {
        font-size: 4rem;
        color: #1a0f0a;
    }

    .check-icon {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #198754;
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        border: 4px solid #1a0f0a;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
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

    .divider-coffee {
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(212, 163, 115, 0.3), transparent);
    }

    .shadow-glow-warm {
        box-shadow: 0 0 30px rgba(212, 163, 115, 0.25);
    }

    .hover-up {
        transition: all 0.3s ease;
    }

    .hover-up:hover {
        transform: translateY(-3px);
    }

    /* Floating Animation for the cup */
    @keyframes float {
        0% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }

        100% {
            transform: translateY(0px);
        }
    }

    .coffee-cup-wrapper {
        animation: float 4s ease-in-out infinite;
    }
</style>
@endsection