@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="main-page-wrapper min-vh-100 py-5">
    <div class="container pt-4">
        {{-- Header --}}
        <div class="mb-5" data-aos="fade-down">
            <h2 class="fw-bolder text-white serif-font">Penyelesaian <span class="text-coffee-light">Pesanan</span></h2>
            <p class="text-white-50">Silakan lengkapi data pengiriman untuk menikmati racikan kopi terbaik kami.</p>
        </div>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf

            <div class="row g-4">
                {{-- Bagian Kiri: Form Alamat & Pengiriman --}}
                <div class="col-lg-8" data-aos="fade-right">
                    {{-- Data Penerima --}}
                    <div class="card border-0 glass-card rounded-4 mb-4 shadow-lg">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-coffee-accent p-2 rounded-3 me-3">
                                    <i class="bi bi-geo-alt-fill text-white fs-4"></i>
                                </div>
                                <h5 class="fw-bold mb-0 text-white serif-font">Detail Pengiriman</h5>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label small fw-bold text-coffee-light">NAMA PENERIMA</label>
                                    <input type="text" name="name" value="{{ auth()->user()->name }}"
                                        class="form-control glass-input rounded-3 py-2 text-white border-white border-opacity-10 shadow-none"
                                        placeholder="Nama Lengkap" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label small fw-bold text-coffee-light">NOMOR TELEPON</label>
                                    <div class="input-group">
                                        <span
                                            class="input-group-text bg-coffee-dark border-white border-opacity-10 text-white-50">+62</span>
                                        <input type="text" name="phone"
                                            class="form-control glass-input rounded-end-3 py-2 text-white border-white border-opacity-10 shadow-none"
                                            placeholder="812xxxx" required>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label small fw-bold text-coffee-light">ALAMAT LENGKAP
                                        PENGIRIMAN</label>
                                    <textarea name="address" rows="4"
                                        class="form-control glass-input rounded-3 text-white border-white border-opacity-10 shadow-none"
                                        placeholder="Nama jalan, Nomor rumah, RT/RW, Kecamatan, Kota"
                                        required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Opsi Pembayaran --}}
                    <div class="card border-0 glass-card rounded-4 shadow-lg">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-success-subtle p-2 rounded-3 me-3">
                                    <i class="bi bi-wallet2 text-success fs-4"></i>
                                </div>
                                <h5 class="fw-bold mb-0 text-white serif-font">Metode Pembayaran</h5>
                            </div>

                            <div class="form-check p-0">
                                <label
                                    class="d-flex align-items-center p-3 border rounded-4 cursor-pointer mb-3 border-coffee-light bg-coffee-light bg-opacity-10 transition-all shadow-glow-small">
                                    <input type="radio" name="payment_method" value="transfer" checked
                                        class="me-3 custom-radio">
                                    <div class="text-white">
                                        <span class="fw-bold d-block">Transfer Bank (Verifikasi Manual)</span>
                                        <small class="text-white-50">Instruksi pembayaran akan dikirim via WhatsApp
                                            setelah checkout.</small>
                                    </div>
                                    <i class="bi bi-bank ms-auto fs-3 text-coffee-light"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bagian Kanan: Ringkasan & Submit --}}
                <div class="col-lg-4" data-aos="fade-left">
                    <div class="card border-0 glass-card rounded-4 sticky-top shadow-lg" style="top: 100px;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4 text-white serif-font">Ringkasan Pesanan</h5>

                            <div class="order-items-list pe-2 mb-4" style="max-height: 250px; overflow-y:auto;">
                                @foreach($cart->items as $item)
                                <div class="d-flex align-items-center mb-3">
                                    <div class="position-relative">
                                        <img src="{{ $item->product->image_url }}"
                                            class="rounded-3 me-3 border border-white border-opacity-10" width="55"
                                            height="55" style="object-fit: cover;">
                                        <span
                                            class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-coffee-accent border border-dark">
                                            {{ $item->quantity }}
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h6 class="small fw-bold mb-0 text-white text-truncate">{{ $item->product->name
                                            }}</h6>
                                        <small class="text-white-50">{{ $item->product->formatted_price }}</small>
                                    </div>
                                    <span class="small fw-bold text-coffee-light ms-2">Rp{{
                                        number_format($item->subtotal, 0, ',', '.') }}</span>
                                </div>
                                @endforeach
                            </div>

                            <div class="divider-coffee mb-4"></div>

                            <div class="d-flex justify-content-between mb-2 text-white-50">
                                <span>Subtotal</span>
                                <span>Rp{{ number_format($cart->items->sum('subtotal'), 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-4">
                                <span class="text-white-50">Biaya Pengiriman</span>
                                <span class="text-success fw-bold small">GRATIS</span>
                            </div>

                            <div
                                class="d-flex justify-content-between align-items-center mb-4 p-3 bg-coffee-dark rounded-4 border border-white border-opacity-10">
                                <span class="fw-bold text-white">Total Tagihan</span>
                                <span class="fw-bolder fs-4 text-coffee-light">
                                    Rp{{ number_format($cart->items->sum('subtotal'), 0, ',', '.') }}
                                </span>
                            </div>

                            <button type="submit"
                                class="btn btn-coffee-light btn-lg w-100 rounded-pill fw-bold py-3 shadow-glow-warm transition-all hover-up">
                                Buat Pesanan Sekarang <i class="bi bi-shield-check ms-2"></i>
                            </button>

                            <p class="text-center text-white-50 small mt-3 mb-0">
                                <i class="bi bi-lock-fill me-1 text-coffee-light"></i> Pembayaran Aman & Terenkripsi
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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

    /* Glassmorphism Elements */
    .glass-card {
        background: rgba(255, 255, 255, 0.03) !important;
        backdrop-filter: blur(15px);
        border: 1px solid rgba(212, 163, 115, 0.1) !important;
    }

    .glass-input {
        background: rgba(0, 0, 0, 0.2) !important;
    }

    .glass-input:focus {
        background: rgba(0, 0, 0, 0.3) !important;
        border-color: #d4a373 !important;
        box-shadow: 0 0 0 0.25rem rgba(212, 163, 115, 0.15) !important;
    }

    /* Coffee Theme Colors */
    .text-coffee-light {
        color: #d4a373 !important;
    }

    .bg-coffee-accent {
        background-color: #8b5a2b !important;
    }

    .bg-coffee-dark {
        background-color: rgba(0, 0, 0, 0.25) !important;
    }

    .border-coffee-light {
        border-color: #d4a373 !important;
    }

    .divider-coffee {
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(212, 163, 115, 0.3), transparent);
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .order-items-list::-webkit-scrollbar {
        width: 4px;
    }

    .order-items-list::-webkit-scrollbar-thumb {
        background: rgba(212, 163, 115, 0.3);
        border-radius: 10px;
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
        box-shadow: 0 5px 15px rgba(212, 163, 115, 0.1);
    }

    /* Custom Radio Styling */
    .custom-radio {
        accent-color: #d4a373;
        transform: scale(1.2);
    }

    .transition-all {
        transition: all 0.3s ease;
    }
</style>
@endsection