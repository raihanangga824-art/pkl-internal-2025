{{-- resources/views/wishlist/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Wishlist Saya - Artisan Coffee')

@section('content')
<div class="wishlist-section min-vh-100 py-5">
    {{-- Decorative Orbs --}}
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="container position-relative" style="z-index: 10;">
        {{-- Header Section: Mirroring Home Title Style --}}
        <div class="row mb-5" data-aos="fade-up">
            <div class="col-md-8">
                <h6 class="text-gold text-uppercase ls-2 fw-bold small mb-2">Koleksi Anda</h6>
                <h2 class="display-5 text-white serif-font fw-bold mb-0">Wishlist <span class="text-gold">Saya</span>
                </h2>
                <div class="divider-gold mt-3"></div>
            </div>
            @if($products->count())
            <div class="col-md-4 text-md-end d-flex align-items-end justify-content-md-end mt-3 mt-md-0">
                <p class="text-white-50 mb-0">Menampilkan <span class="text-white fw-bold">{{ $products->total()
                        }}</span> produk favorit</p>
            </div>
            @endif
        </div>

        @if($products->count())
        {{-- Grid: Menyamakan Row-Cols dengan Home --}}
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 g-md-4" data-aos="fade-up" data-aos-delay="100">
            @foreach($products as $product)
            <div class="col">
                <div class="home-style-card-wrapper h-100">
                    <x-product-card :product="$product" />
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
            <div class="gold-pagination">
                {{ $products->links() }}
            </div>
        </div>
        @else
        {{-- Empty State: Elegant Glass --}}
        <div class="text-center py-5 glass-box rounded-5 border border-white-10 shadow-lg" data-aos="zoom-in">
            <div class="icon-circle-lg mb-4">
                <i class="bi bi-heart text-gold"></i>
            </div>
            <h3 class="text-white serif-font fw-bold">Wishlist Kosong</h3>
            <p class="text-white-50 mb-4 px-4">Anda belum menyimpan produk apapun. Temukan racikan kopi terbaik kami
                sekarang.</p>
            <a href="{{ route('catalog.index') }}" class="btn btn-outline-gold px-5 py-3 rounded-pill fw-bold">
                <i class="bi bi-arrow-left me-2"></i>Mulai Belanja
            </a>
        </div>
        @endif
    </div>
</div>

<style>
    /* 1. LAYOUT BASE */
    .wishlist-section {
        background-color: #0f0a07;
        position: relative;
        overflow: hidden;
    }

    .serif-font {
        font-family: 'Playfair Display', serif;
    }

    .text-gold {
        color: #d4a373 !important;
    }

    .ls-2 {
        letter-spacing: 2px;
    }

    .divider-gold {
        width: 60px;
        height: 3px;
        background: #d4a373;
    }

    /* 2. CARD OVERRIDE (FORCE TO MATCH HOME STYLE) */
    .home-style-card-wrapper .card {
        background: #1a120e !important;
        /* Warna gelap solid agar serasi dengan home */
        border: 1px solid rgba(255, 255, 255, 0.05) !important;
        border-radius: 15px !important;
        transition: all 0.4s ease;
        overflow: hidden;
        height: 100%;
    }

    .home-style-card-wrapper .card:hover {
        transform: translateY(-10px);
        border-color: #d4a373 !important;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
    }

    .home-style-card-wrapper .card-img-top {
        border-radius: 15px 15px 0 0 !important;
        transition: transform 0.6s ease;
    }

    .home-style-card-wrapper .card:hover .card-img-top {
        transform: scale(1.08);
    }

    /* Sinkronisasi warna teks di dalam card */
    .home-style-card-wrapper .card-body {
        color: white !important;
        padding: 1.25rem;
    }

    .home-style-card-wrapper .card-title {
        color: #ffffff !important;
        font-size: 1.1rem;
        font-weight: 600;
    }

    .home-style-card-wrapper .text-muted {
        color: #a1a1a1 !important;
        font-size: 0.85rem;
    }

    .home-style-card-wrapper .price,
    .home-style-card-wrapper .text-primary {
        color: #d4a373 !important;
        font-weight: 700;
    }

    /* 3. EMPTY STATE UI */
    .glass-box {
        background: rgba(255, 255, 255, 0.02);
        backdrop-filter: blur(15px);
    }

    .border-white-10 {
        border-color: rgba(255, 255, 255, 0.1) !important;
    }

    .icon-circle-lg {
        width: 90px;
        height: 90px;
        background: rgba(212, 163, 115, 0.1);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
    }

    .btn-outline-gold {
        border: 2px solid #d4a373;
        color: #d4a373;
        transition: all 0.3s;
    }

    .btn-outline-gold:hover {
        background: #d4a373;
        color: #0f0a07;
    }

    /* 4. DECORATIVE BACKGROUNDS */
    .orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        z-index: 1;
        opacity: 0.1;
    }

    .orb-1 {
        width: 400px;
        height: 400px;
        background: #d4a373;
        top: -100px;
        right: -50px;
    }

    .orb-2 {
        width: 300px;
        height: 300px;
        background: #634832;
        bottom: 50px;
        left: -50px;
    }

    /* 5. PAGINATION */
    .gold-pagination .page-link {
        background: transparent;
        border-color: rgba(212, 163, 115, 0.3);
        color: white;
    }

    .gold-pagination .page-item.active .page-link {
        background: #d4a373;
        border-color: #d4a373;
        color: #0f0a07;
    }
</style>
@endsection