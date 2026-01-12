@extends('layouts.app')

@section('title', 'Katalog Kopi Nusantara - Artisan Coffee')

@section('content')
{{-- Load Google Fonts & Animate.css --}}
<link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@300;400;600&display=swap"
    rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

<div class="main-page-wrapper min-vh-100">
    <div class="container py-5 pt-5">

        {{-- 1. HEADER SECTION --}}
        <div class="row mb-5 align-items-end" data-aos="fade-down">
            <div class="col-md-8 text-white">
                <h6 class="text-coffee-accent fw-bold text-uppercase tracking-wider">Koleksi Biji Pilihan</h6>
                <h2 class="display-5 fw-bolder mb-0 serif-font">Katalog <span class="text-coffee-gradient">Produk</span>
                </h2>
                <div class="bg-coffee-accent mt-2" style="width: 80px; height: 4px; border-radius: 2px;"></div>
            </div>
            <div class="col-md-4 text-md-end text-white-50">
                <p class="mb-0">Menampilkan <strong>{{ $products->total() }}</strong> varian seduhan terbaik</p>
            </div>
        </div>

        <div class="row">
            {{-- 2. SIDEBAR FILTER --}}
            <div class="col-lg-3 mb-5">
                <div class="card border-0 shadow-lg rounded-4 sticky-top sidebar-glass animate__animated animate__fadeInLeft"
                    style="top: 100px; z-index: 10;">
                    <div class="card-body p-4">
                        <form action="{{ route('catalog.index') }}" method="GET" id="filterForm">
                            @if(request('q')) <input type="hidden" name="q" value="{{ request('q') }}"> @endif

                            {{-- Kategori --}}
                            <div class="mb-4 pb-4 border-bottom border-white border-opacity-10">
                                <h6 class="fw-bold mb-3 d-flex align-items-center text-white">
                                    <i class="bi bi-cup-hot-fill me-2 text-coffee-accent"></i> Kategori
                                </h6>
                                <div class="d-flex flex-column gap-2 text-white-50">
                                    <div class="form-check custom-check-glass">
                                        <input class="form-check-input" type="radio" name="category" value=""
                                            id="cat-all" {{ !request('category') ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <label class="form-check-label fw-medium" for="cat-all">Semua Menu</label>
                                    </div>
                                    @foreach($categories as $cat)
                                    <div class="form-check custom-check-glass">
                                        <input class="form-check-input" type="radio" name="category"
                                            value="{{ $cat->slug }}" id="cat-{{ $cat->id }}" {{
                                            request('category')==$cat->slug ? 'checked' : '' }}
                                        onchange="this.form.submit()">
                                        <label
                                            class="form-check-label d-flex justify-content-between align-items-center fw-medium"
                                            for="cat-{{ $cat->id }}">
                                            {{ $cat->name }}
                                            <span
                                                class="badge bg-white bg-opacity-10 text-coffee-accent rounded-pill fw-normal">
                                                {{ $cat->products_count }}
                                            </span>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Rentang Harga --}}
                            <div class="mb-4">
                                <h6 class="fw-bold mb-3 d-flex align-items-center text-white">
                                    <i class="bi bi-tags-fill me-2 text-coffee-accent"></i> Harga
                                </h6>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <input type="number" name="min_price" class="form-control glass-input"
                                            placeholder="Min" value="{{ request('min_price') }}">
                                    </div>
                                    <div class="col-6">
                                        <input type="number" name="max_price" class="form-control glass-input"
                                            placeholder="Max" value="{{ request('max_price') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit"
                                    class="btn btn-coffee-accent rounded-pill fw-bold py-2 shadow-glow-coffee">
                                    <i class="bi bi-funnel-fill me-1"></i> Terapkan
                                </button>
                                @if(request()->anyFilled(['category', 'min_price', 'max_price', 'q']))
                                <a href="{{ route('catalog.index') }}"
                                    class="btn btn-outline-light rounded-pill fw-bold py-2 border-opacity-25">
                                    Reset Filter
                                </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- 3. PRODUCT GRID --}}
            <div class="col-lg-9">
                {{-- Toolbar Sorting --}}
                <div
                    class="toolbar-glass p-3 rounded-4 shadow-sm mb-4 d-flex justify-content-between align-items-center border border-white border-opacity-10 animate__animated animate__fadeInRight">
                    <div class="d-none d-md-block">
                        <span class="text-white-50 small">Urutkan Berdasarkan:</span>
                    </div>
                    <form method="GET" class="ms-auto" style="min-width: 200px;">
                        @foreach(request()->except('sort') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <select name="sort"
                            class="form-select border-0 bg-white bg-opacity-10 text-white rounded-pill px-3 cursor-pointer"
                            onchange="this.form.submit()">
                            <option value="newest" class="text-dark" {{ request('sort')=='newest' ? 'selected' : '' }}>
                                Terbaru</option>
                            <option value="price_asc" class="text-dark" {{ request('sort')=='price_asc' ? 'selected'
                                : '' }}>Harga Terendah</option>
                            <option value="price_desc" class="text-dark" {{ request('sort')=='price_desc' ? 'selected'
                                : '' }}>Harga Tertinggi</option>
                        </select>
                    </form>
                </div>

                {{-- Products --}}
                <div class="row g-4">
                    @forelse($products as $product)
                    <div class="col-6 col-md-4" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration * 50 }}">
                        {{-- Menggunakan Product Card Glassmorphism Anda --}}
                        <x-product-card :product="$product" />
                    </div>
                    @empty
                    <div class="col-12 animate__animated animate__zoomIn">
                        <div
                            class="text-center py-5 bg-white bg-opacity-5 rounded-5 border border-dashed border-white border-opacity-20 text-white">
                            <i class="bi bi-cup-hot text-coffee-accent mb-3 d-block" style="font-size: 4rem;"></i>
                            <h4 class="fw-bold serif-font">Racikan Belum Tersedia</h4>
                            <p class="text-white-50">Kami belum menemukan kopi yang sesuai dengan kriteria pencarian
                                Anda.</p>
                            <a href="{{ route('catalog.index') }}"
                                class="btn btn-coffee-accent rounded-pill px-5 fw-bold shadow-glow-coffee">Lihat Semua
                                Menu</a>
                        </div>
                    </div>
                    @endforelse
                </div>

                {{-- 4. PAGINATION CUSTOM GLASS --}}
                @if($products->hasPages())
                <div class="mt-5 d-flex justify-content-center">
                    <div class="custom-pagination-wrapper">
                        <div class="custom-pagination">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    /* MASTER THEME COLORS */
    :root {
        --coffee-dark: #0c0805;
        --coffee-medium: #1a0f0a;
        --coffee-accent: #d4a373;
        --coffee-light: #faedcd;
    }

    body {
        background-color: var(--coffee-dark);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .serif-font {
        font-family: 'Playfair Display', serif;
    }

    /* WRAPPER & BACKGROUND */
    .main-page-wrapper {
        background-color: var(--coffee-dark);
        background-image:
            radial-gradient(circle at 10% 20%, rgba(212, 163, 115, 0.05) 0%, transparent 40%),
            radial-gradient(circle at 90% 80%, rgba(212, 163, 115, 0.03) 0%, transparent 40%);
        background-attachment: fixed;
    }

    .text-coffee-gradient {
        background: linear-gradient(45deg, var(--coffee-accent), var(--coffee-light));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .text-coffee-accent {
        color: var(--coffee-accent) !important;
    }

    /* GLASSMORPHISM COMPONENTS */
    .sidebar-glass,
    .toolbar-glass {
        background: rgba(255, 255, 255, 0.03) !important;
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(212, 163, 115, 0.1) !important;
    }

    .glass-input {
        background: rgba(255, 255, 255, 0.05) !important;
        border: 1px solid rgba(212, 163, 115, 0.2) !important;
        color: white !important;
        border-radius: 12px !important;
    }

    .glass-input:focus {
        border-color: var(--coffee-accent) !important;
        box-shadow: 0 0 10px rgba(212, 163, 115, 0.2);
    }

    /* CUSTOM CHECKBOX */
    .custom-check-glass .form-check-input {
        background-color: rgba(255, 255, 255, 0.1);
        border-color: rgba(212, 163, 115, 0.3);
    }

    .custom-check-glass .form-check-input:checked {
        background-color: var(--coffee-accent);
        border-color: var(--coffee-accent);
    }

    .custom-check-glass .form-check-label:hover {
        color: var(--coffee-accent) !important;
        cursor: pointer;
    }

    /* BUTTONS */
    .btn-coffee-accent {
        background-color: var(--coffee-accent) !important;
        border-color: var(--coffee-accent) !important;
        color: var(--coffee-dark) !important;
        transition: all 0.3s ease;
    }

    .btn-coffee-accent:hover {
        background-color: var(--coffee-light) !important;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(212, 163, 115, 0.3);
    }

    .shadow-glow-coffee {
        box-shadow: 0 0 15px rgba(212, 163, 115, 0.2);
    }

    /* PAGINATION GLASS STYLE */
    .custom-pagination-wrapper {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(212, 163, 115, 0.1);
        padding: 0.8rem 1.5rem;
        border-radius: 50px;
    }

    .custom-pagination .pagination {
        margin-bottom: 0;
        gap: 5px;
        border: none;
    }

    .custom-pagination .page-link {
        background: rgba(255, 255, 255, 0.05) !important;
        border: 1px solid rgba(212, 163, 115, 0.15) !important;
        color: var(--coffee-accent) !important;
        border-radius: 10px !important;
        transition: all 0.3s;
    }

    .custom-pagination .page-item.active .page-link {
        background: var(--coffee-accent) !important;
        color: var(--coffee-dark) !important;
        border-color: var(--coffee-accent) !important;
    }

    .custom-pagination .page-link:hover {
        background: rgba(212, 163, 115, 0.2) !important;
        transform: translateY(-3px);
    }

    .border-dashed {
        border-style: dashed !important;
        border-width: 2px !important;
    }

    .cursor-pointer {
        cursor: pointer;
    }
</style>

{{-- Scripts untuk AOS --}}
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true,
    });
</script>
@endsection