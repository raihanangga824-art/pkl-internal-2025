@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
{{-- Wrapper Background Kopi --}}
<div class="main-page-wrapper min-vh-100 py-5">
    <div class="container pt-4">
        <div class="d-flex justify-content-between align-items-center mb-5" data-aos="fade-down">
            <h2 class="fw-bolder mb-0 text-white serif-font">Keranjang <span class="text-coffee-light">Pesanan</span>
            </h2>
            <span class="badge glass-card text-coffee-light rounded-pill px-3 py-2 border border-coffee-dim">
                {{ $cart && $cart->items ? $cart->items->count() : 0 }} Item Terpilih
            </span>
        </div>

        @if($cart && $cart->items->count())
        <div class="row g-4">
            {{-- List Produk --}}
            <div class="col-lg-8" data-aos="fade-right">
                <div class="d-flex flex-column gap-3">
                    @foreach($cart->items as $item)
                    <div class="card border-0 glass-card rounded-4 overflow-hidden cart-item-card shadow-lg">
                        <div class="card-body p-3">
                            <div class="row align-items-center g-3">
                                {{-- Image --}}
                                <div class="col-3 col-md-2">
                                    <div
                                        class="bg-coffee-dark rounded-3 overflow-hidden border border-white border-opacity-10">
                                        <img src="{{ $item->product->image_url }}" class="img-fluid"
                                            alt="{{ $item->product->name }}"
                                            style="aspect-ratio: 1/1; object-fit: cover;">
                                    </div>
                                </div>

                                {{-- Info --}}
                                <div class="col-9 col-md-4">
                                    <p class="text-coffee-light fw-bold small text-uppercase mb-1"
                                        style="font-size: 0.7rem;">
                                        {{ $item->product->category->name }}
                                    </p>
                                    <h6 class="fw-bold mb-1">
                                        <a href="{{ route('catalog.show', $item->product->slug) }}"
                                            class="text-decoration-none text-white hover-coffee">
                                            {{ Str::limit($item->product->name, 45) }}
                                        </a>
                                    </h6>
                                    <p class="text-white-50 small mb-0">{{ $item->product->formatted_price }} / item</p>
                                </div>

                                {{-- Quantity Control --}}
                                <div class="col-6 col-md-3">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                        id="update-form-{{ $item->id }}">
                                        @csrf
                                        @method('PATCH')
                                        <div
                                            class="input-group input-group-sm shadow-sm rounded-pill border-coffee-dim overflow-hidden bg-coffee-dark">
                                            <button class="btn btn-coffee-dark border-0 px-2 text-white" type="button"
                                                onclick="changeQty('{{ $item->id }}', -1)">
                                                <i class="bi bi-dash"></i>
                                            </button>
                                            <input type="number" name="quantity" id="qty-{{ $item->id }}"
                                                class="form-control border-0 text-center fw-bold bg-transparent text-white"
                                                value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                                onchange="this.form.submit()" readonly>
                                            <button class="btn btn-coffee-dark border-0 px-2 text-white" type="button"
                                                onclick="changeQty('{{ $item->id }}', 1)">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                {{-- Subtotal & Delete --}}
                                <div class="col-6 col-md-3 text-end text-white">
                                    <div class="fw-bolder mb-2 text-coffee-light">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </div>
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-link text-warning-emphasis p-0 text-decoration-none small fw-bold opacity-75 hover-opacity-100"
                                            onclick="return confirm('Hapus item ini?')">
                                            <i class="bi bi-trash3 me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="col-lg-4" data-aos="fade-left">
                <div class="card border-0 glass-card rounded-4 sticky-top shadow-lg" style="top: 100px;">
                    <div class="card-body p-4 text-white">
                        <h5 class="fw-bold mb-4 serif-font">Ringkasan Belanja</h5>

                        <div class="d-flex justify-content-between mb-3 text-white-50">
                            <span>Total Harga ({{ $cart->items->sum('quantity') }} unit)</span>
                            <span>Rp {{ number_format($cart->items->sum('subtotal'), 0, ',', '.') }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-3 text-white-50">
                            <span>Pajak Resto (11%)</span>
                            <span class="text-coffee-light small fw-medium">Termasuk</span>
                        </div>

                        <hr class="my-4 border-white border-opacity-10">

                        <div class="d-flex justify-content-between mb-4 align-items-center">
                            <span class="fw-bold fs-5">Total Bayar</span>
                            <span class="fw-bolder fs-4 text-coffee-light">
                                Rp {{ number_format($cart->items->sum('subtotal'), 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="{{ route('checkout.index') }}"
                                class="btn btn-coffee-light btn-lg rounded-pill fw-bold py-3 shadow-glow-warm">
                                Lanjut Ke Pembayaran <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                            <a href="{{ route('catalog.index') }}"
                                class="btn btn-outline-light rounded-pill fw-bold py-2 border-opacity-25 mt-2">
                                <i class="bi bi-plus-lg me-1"></i> Tambah Menu Lain
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        {{-- Empty State --}}
        <div class="text-center py-5" data-aos="zoom-in">
            <div class="glass-card rounded-circle d-inline-flex align-items-center justify-content-center mb-4 border border-coffee-dim shadow-glow-warm"
                style="width: 150px; height: 150px;">
                <i class="bi bi-cart-x text-coffee-light display-1"></i>
            </div>
            <h3 class="fw-bold text-white serif-font">Yah, Cangkirmu Masih Kosong</h3>
            <p class="text-white-50 mx-auto mb-4" style="max-width: 400px;">Sepertinya kamu belum memilih racikan kopi
                impianmu hari ini. Ayo jelajahi menu spesial kami!</p>
            <a href="{{ route('catalog.index') }}"
                class="btn btn-coffee-light btn-lg rounded-pill px-5 fw-bold shadow-glow-warm">
                Cari Kopi Sekarang
            </a>
        </div>
        @endif
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

    /* Glassmorphism Styles */
    .glass-card {
        background: rgba(255, 255, 255, 0.03) !important;
        backdrop-filter: blur(15px);
        border: 1px solid rgba(212, 163, 115, 0.1) !important;
    }

    .cart-item-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .cart-item-card:hover {
        transform: translateX(10px);
        background: rgba(255, 255, 255, 0.06) !important;
    }

    /* Colors */
    .text-coffee-light {
        color: #d4a373 !important;
    }

    .bg-coffee-dark {
        background-color: rgba(0, 0, 0, 0.3) !important;
    }

    .border-coffee-dim {
        border-color: rgba(212, 163, 115, 0.2) !important;
    }

    .hover-coffee:hover {
        color: #d4a373 !important;
    }

    .btn-coffee-light {
        background-color: #d4a373;
        color: #1a0f0a;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-coffee-light:hover {
        background-color: #faedcd;
        transform: translateY(-2px);
    }

    .shadow-glow-warm {
        box-shadow: 0 10px 20px rgba(212, 163, 115, 0.2);
    }

    /* Remove arrows from number input */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .hover-opacity-100:hover {
        opacity: 1 !important;
    }
</style>

@push('scripts')
<script>
    function changeQty(itemId, amount) {
        const input = document.getElementById('qty-' + itemId);
        let currentVal = parseInt(input.value);
        let newVal = currentVal + amount;
        
        if (newVal >= 1 && newVal <= parseInt(input.max)) {
            input.value = newVal;
            document.getElementById('update-form-' + itemId).submit();
        }
    }
</script>
@endpush
@endsection