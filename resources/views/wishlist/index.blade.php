@extends('layouts.app')

@section('title', 'Wishlist Saya')

@section('content')

{{-- =======================
STYLE (Wishlist Only)
======================= --}}
<style>
    /* =======================
       BASE THEME
    ======================= */
    body {
        background-color: #0f0a07;
        background-image:
            radial-gradient(circle at 10% 20%, rgba(212, 163, 115, .06) 0%, transparent 25%),
            radial-gradient(circle at 90% 80%, rgba(212, 163, 115, .06) 0%, transparent 25%);
        color: #f8f9fa;
        min-height: 100vh;
    }

    /* =======================
       HERO HEADER
    ======================= */
    .wishlist-hero {
        padding: 4rem 0 3rem;
        text-align: center;
    }

    .wishlist-hero h1 {
        font-family: 'Playfair Display', serif;
        font-weight: 800;
        font-size: 3.5rem;
        color: #d4a373;
        letter-spacing: -1px;
        margin-bottom: .5rem;
    }

    .wishlist-hero p {
        color: rgba(255, 255, 255, .6);
        font-size: 1.05rem;
        letter-spacing: .5px;
    }

    .count-pill {
        display: inline-block;
        margin-bottom: 1rem;
        background: rgba(212, 163, 115, .15);
        border: 1px solid rgba(212, 163, 115, .35);
        padding: 6px 18px;
        border-radius: 50px;
        font-size: .85rem;
        color: #d4a373;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    /* =======================
       GRID
    ======================= */
    .wishlist-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .wishlist-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2.5rem;
        padding-bottom: 4rem;
    }

    .wishlist-item {
        transition: transform .35s ease, box-shadow .35s ease;
    }

    .wishlist-item:hover {
        transform: translateY(-8px);
    }

    /* =======================
       EMPTY STATE
    ======================= */
    .empty-state-box {
        margin: 4rem auto;
        padding: 100px 25px;
        max-width: 720px;
        border-radius: 30px;
        background: rgba(255, 255, 255, .03);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(212, 163, 115, .15);
        text-align: center;
    }

    .empty-state-box i {
        font-size: 4rem;
        color: rgba(212, 163, 115, .25);
        margin-bottom: 1.5rem;
    }

    .btn-browse {
        background: #d4a373;
        color: #1a0f0a;
        font-weight: 700;
        padding: 12px 36px;
        border-radius: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
        transition: .3s ease;
    }

    .btn-browse:hover {
        background: #faedcd;
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(212, 163, 115, .25);
        color: #1a0f0a;
    }

    /* =======================
       RESPONSIVE
    ======================= */
    @media (max-width: 768px) {
        .wishlist-hero h1 {
            font-size: 2.4rem;
        }

        .wishlist-grid {
            gap: 1.6rem;
        }
    }
</style>

{{-- =======================
CONTENT
======================= --}}
<div class="container wishlist-container">

    @if ($products->count() > 0)

    {{-- HEADER --}}
    <header class="wishlist-hero">
        <span class="count-pill">
            {{ $products->total() ?? $products->count() }} Items
        </span>

        <h1>Favorit Saya</h1>

        <p class="fst-italic">
            Koleksi pilihan racikan terbaik untuk Anda
        </p>

        <div class="mt-4">
            <a href="{{ route('catalog.index') }}"
                class="text-decoration-none text-white-50 fw-bold text-uppercase small">
                <i class="bi bi-chevron-left me-1"></i> Kembali ke Katalog
            </a>
        </div>
    </header>

    {{-- GRID --}}
    <div class="wishlist-grid">
        @foreach ($products as $product)
        <div class="wishlist-item animate__animated animate__fadeInUp">
            <x-product-card :product="$product" />
        </div>
        @endforeach
    </div>

    {{-- PAGINATION --}}
    @if (method_exists($products, 'links'))
    <div class="d-flex justify-content-center pb-5">
        {{ $products->links() }}
    </div>
    @endif

    @else

    {{-- EMPTY STATE --}}
    <div class="empty-state-box">
        <i class="bi bi-cup-hot"></i>

        <h2 class="serif-font text-white mb-3">
            Belum ada yang disukai?
        </h2>

        <p class="text-white-50 mx-auto mb-5" style="max-width: 480px;">
            Tandai kopi atau snack favoritmu saat menjelajah katalog
            agar muncul di sini dan mudah ditemukan nanti.
        </p>

        <a href="{{ route('catalog.index') }}" class="btn btn-browse">
            Mulai Menjelajah
        </a>
    </div>

    @endif

</div>
@endsection