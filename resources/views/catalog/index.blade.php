@extends('layouts.app')

@section('title', 'Katalog Kopi Nusantara')

@section('content')
{{-- Wrapper Background Kopi Hangat --}}
<div class="main-page-wrapper min-vh-100">
    <div class="container py-5 pt-5">
        {{-- Header Page --}}
        <div class="row mb-5 align-items-end" data-aos="fade-down">
            <div class="col-md-8 text-white">
                <h6 class="text-warning fw-bold text-uppercase tracking-wider">Koleksi Biji Pilihan</h6>
                <h2 class="display-5 fw-bolder mb-0 serif-font">Katalog <span class="text-coffee-gradient">Produk</span>
                </h2>
                <div class="bg-warning mt-2" style="width: 80px; height: 4px; border-radius: 2px;"></div>
            </div>
            <div class="col-md-4 text-md-end text-white-50">
                <p class="mb-0">Menampilkan <strong>{{ $products->total() }}</strong> varian seduhan terbaik</p>
            </div>
        </div>

        <div class="row">
            {{-- SIDEBAR FILTER - Glassmorphism Coffee Style --}}
            <div class="col-lg-3 mb-5">
                <div class="card border-0 shadow-lg rounded-4 sticky-top sidebar-glass"
                    style="top: 100px; z-index: 10;">
                    <div class="card-body p-4">
                        <form action="{{ route('catalog.index') }}" method="GET">
                            @if(request('q')) <input type="hidden" name="q" value="{{ request('q') }}"> @endif

                            {{-- Kategori --}}
                            <div class="mb-4 pb-4 border-bottom border-white border-opacity-10">
                                <h6 class="fw-bold mb-3 d-flex align-items-center text-white">
                                    <i class="bi bi-cup-hot-fill me-2 text-warning"></i> Kategori
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
                                                class="badge bg-white bg-opacity-10 text-warning rounded-pill fw-normal">{{
                                                $cat->products_count }}</span>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Rentang Harga --}}
                            <div class="mb-4">
                                <h6 class="fw-bold mb-3 d-flex align-items-center text-white">
                                    <i class="bi bi-tags-fill me-2 text-warning"></i> Harga
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
                                    class="btn btn-warning rounded-pill fw-bold py-2 shadow-glow-warm">
                                    <i class="bi bi-funnel-fill me-1"></i> Terapkan
                                </button>
                                @if(request()->anyFilled(['category', 'min_price', 'max_price', 'q']))
                                <a href="{{ route('catalog.index') }}"
                                    class="btn btn-outline-light rounded-pill fw-bold py-2 border-opacity-25">
                                    Reset
                                </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- PRODUCT GRID --}}
            <div class="col-lg-9">
                {{-- Toolbar Glass --}}
                <div class="toolbar-glass p-3 rounded-4 shadow-sm mb-4 d-flex justify-content-between align-items-center border border-white border-opacity-10"
                    data-aos="fade-left">
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

                {{-- Grid --}}
                <div class="row g-4">
                    @forelse($products as $product)
                    <div class="col-6 col-md-4" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration * 50 }}">
                        @include('profile.partials.product-card', ['product' => $product])
                    </div>
                    @empty
                    <div class="col-12">
                        <div
                            class="text-center py-5 bg-white bg-opacity-5 rounded-5 border border-dashed border-white border-opacity-20 text-white">
                            <i class="bi bi-cup-hot text-warning mb-3 d-block" style="font-size: 4rem;"></i>
                            <h4 class="fw-bold serif-font">Racikan Belum Tersedia</h4>
                            <p class="text-white-50">Kami belum menemukan kopi yang sesuai dengan kriteria pencarian
                                Anda.</p>
                            <a href="{{ route('catalog.index') }}"
                                class="btn btn-warning rounded-pill px-5 fw-bold shadow-glow-warm">Lihat Semua Menu</a>
                        </div>
                    </div>
                    @endforelse
                </div>

                {{-- Pagination Custom --}}
                <div class="mt-5 d-flex justify-content-center custom-pagination">
                    {{ $products->links() }}
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

    /* Gradient Background Espresso */
    .main-page-wrapper {
        background: linear-gradient(180deg, #1a0f0a 0%, #2c1b12 30%, #3d2b1f 100%);
        padding-top: 80px;
    }

    .text-coffee-gradient {
        background: linear-gradient(45deg, #d4a373, #faedcd);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Sidebar Glassmorphism Warm */
    .sidebar-glass,
    .toolbar-glass {
        background: rgba(255, 255, 255, 0.03) !important;
        backdrop-filter: blur(15px);
        border: 1px solid rgba(212, 163, 115, 0.1) !important;
    }

    /* Input Glass Styling */
    .glass-input {
        background: rgba(255, 255, 255, 0.05) !important;
        border: 1px solid rgba(212, 163, 115, 0.2) !important;
        color: white !important;
        border-radius: 12px !important;
    }

    .glass-input:focus {
        border-color: #d4a373 !important;
        box-shadow: none;
    }

    /* Custom Checkbox Glass Warm */
    .custom-check-glass .form-check-input {
        background-color: rgba(255, 255, 255, 0.1);
        border-color: rgba(212, 163, 115, 0.3);
    }

    .custom-check-glass .form-check-input:checked {
        background-color: #d4a373;
        border-color: #d4a373;
    }

    .custom-check-glass .form-check-label:hover {
        color: #d4a373 !important;
        cursor: pointer;
    }

    /* Button Warm Glow */
    .btn-warning {
        background-color: #d4a373 !important;
        border-color: #d4a373 !important;
        color: #1a0f0a !important;
    }

    .shadow-glow-warm {
        box-shadow: 0 0 20px rgba(212, 163, 115, 0.3);
    }

    .border-dashed {
        border-style: dashed !important;
        border-width: 2px !important;
    }

    /* Pagination Styles Warm */
    .custom-pagination .page-link {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(212, 163, 115, 0.1);
        color: white;
        border-radius: 10px;
        margin: 0 3px;
    }

    .custom-pagination .page-item.active .page-link {
        background: #d4a373;
        border-color: #d4a373;
        color: #1a0f0a;
        font-weight: bold;
    }

    .cursor-pointer {
        cursor: pointer;
    }
</style>
@endsection