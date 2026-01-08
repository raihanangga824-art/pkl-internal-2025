@extends('layouts.app')

@section('title', $product->name)

@section('content')
{{-- Wrapper Background Kopi --}}
<div class="main-page-wrapper min-vh-100 py-5">
    <div class="container pt-4">
        {{-- Breadcrumb Modern - Coffee Style --}}
        <nav aria-label="breadcrumb" class="mb-5" data-aos="fade-down">
            <ol
                class="breadcrumb glass-breadcrumb px-4 py-2 rounded-pill shadow-sm d-inline-flex border border-white border-opacity-10">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"
                        class="text-decoration-none text-white-50">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('catalog.index') }}"
                        class="text-decoration-none text-white-50">Katalog</a></li>
                <li class="breadcrumb-item active fw-bold text-coffee-light" aria-current="page">{{
                    Str::limit($product->name, 25) }}</li>
            </ol>
        </nav>

        <div class="row g-5">
            {{-- Area Gambar --}}
            <div class="col-lg-6" data-aos="fade-right">
                <div class="sticky-top" style="top: 100px;">
                    <div class="card border-0 glass-card rounded-5 overflow-hidden mb-3">
                        <div class="position-relative">
                            <img src="{{ $product->image_url }}" id="main-image" class="img-fluid w-100 transition-all"
                                alt="{{ $product->name }}" style="height: 500px; object-fit: contain; padding: 2rem;">

                            @if($product->has_discount)
                            <div class="position-absolute top-0 start-0 m-4">
                                <span class="badge bg-coffee-accent rounded-pill px-3 py-2 fw-bold shadow">
                                    Hemat {{ $product->discount_percentage }}%
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Thumbnail Gallery --}}
                    @if($product->images->count() > 1)
                    <div class="d-flex gap-3 justify-content-center overflow-auto py-2 custom-scrollbar">
                        @foreach($product->images as $image)
                        <div class="thumb-container rounded-4 border-coffee-dim p-1 cursor-pointer transition-all glass-card shadow-sm"
                            onclick="changeMainImage('{{ asset('storage/' . $image->image_path) }}', this)">
                            <img src="{{ asset('storage/' . $image->image_path) }}" class="rounded-3"
                                style="width: 70px; height: 70px; object-fit: cover;">
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            {{-- Area Informasi Produk --}}
            <div class="col-lg-6 text-white" data-aos="fade-left">
                <div class="ps-lg-4">
                    <div class="mb-2">
                        <span
                            class="badge bg-coffee-dim text-coffee-light rounded-pill px-3 py-2 fw-bold text-uppercase small">
                            <i class="bi bi-cup-hot-fill me-1"></i> {{ $product->category->name }}
                        </span>
                    </div>

                    <h1 class="display-5 fw-bolder mb-3 serif-font">{{ $product->name }}</h1>

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="h2 fw-bolder text-coffee-light mb-0">
                            {{ $product->formatted_price }}
                        </div>
                        @if($product->has_discount)
                        <div class="h4 text-white-50 text-decoration-line-through mb-0 opacity-50">
                            {{ $product->formatted_original_price }}
                        </div>
                        @endif
                    </div>

                    <p class="text-white-50 mb-4 lh-lg" style="font-size: 1.1rem;">
                        {{ $product->description_short ?? 'Pilihan biji kopi terbaik yang disangrai dengan presisi untuk
                        menghasilkan aroma dan cita rasa yang tak terlupakan.' }}
                    </p>

                    {{-- Form Transaksi --}}
                    <div class="card border-0 glass-card rounded-4 p-4 mb-4 shadow-lg">
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="row g-3 align-items-center">
                                <div class="col-md-4">
                                    <label
                                        class="form-label small fw-bold text-uppercase text-coffee-light">Jumlah</label>
                                    <div
                                        class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden border-coffee-dim">
                                        <button type="button" class="btn btn-coffee-dark border-0 px-3 text-white"
                                            onclick="decrementQty()">
                                            <i class="bi bi-dash-lg"></i>
                                        </button>
                                        <input type="number" name="quantity" id="quantity" value="1" min="1"
                                            max="{{ $product->stock }}"
                                            class="form-control border-0 text-center fw-bold bg-transparent text-white shadow-none">
                                        <button type="button" class="btn btn-coffee-dark border-0 px-3 text-white"
                                            onclick="incrementQty()">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label d-none d-md-block">&nbsp;</label>
                                    <button type="submit"
                                        class="btn btn-coffee-light btn-lg w-100 rounded-pill fw-bold shadow-glow-warm py-3"
                                        @if($product->stock == 0) disabled @endif>
                                        <i class="bi bi-bag-plus-fill me-2"></i>
                                        @if($product->stock == 0) Stok Habis @else Tambah Ke Keranjang @endif
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- Wishlist & Share --}}
                    <div class="d-flex gap-3 mb-5">
                        @auth
                        <button type="button" onclick="toggleWishlist({{ $product->id }})"
                            class="btn btn-outline-coffee rounded-pill px-4 py-2 fw-bold flex-grow-1 transition-all">
                            <i
                                class="bi {{ auth()->user()->hasInWishlist($product) ? 'bi-heart-fill' : 'bi-heart' }} me-2"></i>
                            Favorit
                        </button>
                        @endauth
                        <button
                            class="btn btn-outline-light border-opacity-25 rounded-pill px-4 py-2 fw-bold flex-grow-1">
                            <i class="bi bi-share me-2"></i> Bagikan
                        </button>
                    </div>

                    {{-- Tabs Info --}}
                    <ul class="nav nav-tabs border-0 gap-4 mb-3" id="productTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active border-0 fw-bold px-0 text-white" id="desc-tab"
                                data-bs-toggle="tab" href="#desc">Deskripsi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link border-0 fw-bold px-0 text-white-50" id="spec-tab" data-bs-toggle="tab"
                                href="#spec">Spesifikasi</a>
                        </li>
                    </ul>
                    <div class="tab-content text-white-50 small lh-lg mb-5" id="productTabContent">
                        <div class="tab-pane fade show active" id="desc">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                        <div class="tab-pane fade" id="spec">
                            <table class="table table-sm table-borderless text-white-50">
                                <tr>
                                    <td class="ps-0 fw-bold text-coffee-light" width="150">SKU</td>
                                    <td>: PROD-COFFEE-{{ $product->id }}</td>
                                </tr>
                                <tr>
                                    <td class="ps-0 fw-bold text-coffee-light">Berat</td>
                                    <td>: {{ $product->weight }} gram</td>
                                </tr>
                                <tr>
                                    <td class="ps-0 fw-bold text-coffee-light">Ketersediaan</td>
                                    <td>: {{ $product->stock > 0 ? 'Ready Stock' : 'Habis' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
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

    /* Glassmorphism Elements */
    .glass-card {
        background: rgba(255, 255, 255, 0.03) !important;
        backdrop-filter: blur(15px);
        border: 1px solid rgba(212, 163, 115, 0.1) !important;
    }

    .glass-breadcrumb {
        background: rgba(212, 163, 115, 0.05) !important;
        backdrop-filter: blur(10px);
    }

    /* Colors */
    .text-coffee-light {
        color: #d4a373 !important;
    }

    .bg-coffee-accent {
        background-color: #8b5a2b !important;
    }

    .bg-coffee-dim {
        background-color: rgba(212, 163, 115, 0.1) !important;
    }

    .border-coffee-dim {
        border: 1px solid rgba(212, 163, 115, 0.2) !important;
    }

    .btn-coffee-dark {
        background-color: rgba(0, 0, 0, 0.2);
    }

    .thumb-container:hover,
    .thumb-container.active {
        border-color: #d4a373 !important;
        transform: scale(1.05);
    }

    .btn-coffee-light {
        background-color: #d4a373;
        color: #1a0f0a;
        border: none;
    }

    .btn-coffee-light:hover {
        background-color: #faedcd;
        transform: translateY(-2px);
    }

    .btn-outline-coffee {
        border-color: #d4a373;
        color: #d4a373;
    }

    .btn-outline-coffee:hover {
        background-color: #d4a373;
        color: #1a0f0a;
    }

    .shadow-glow-warm {
        box-shadow: 0 10px 20px rgba(212, 163, 115, 0.2);
    }

    /* Tabs Styling */
    .nav-tabs .nav-link {
        position: relative;
        transition: all 0.3s;
    }

    .nav-tabs .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 3px;
        background: #d4a373;
        border-radius: 10px;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

@push('scripts')
<script>
    function changeMainImage(src, element) {
        document.getElementById('main-image').src = src;
        document.querySelectorAll('.thumb-container').forEach(el => el.classList.remove('active'));
        element.classList.add('active');
    }

    function incrementQty() {
        const input = document.getElementById('quantity');
        if (parseInt(input.value) < parseInt(input.max)) {
            input.value = parseInt(input.value) + 1;
        }
    }
    function decrementQty() {
        const input = document.getElementById('quantity');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
</script>
@endpush
@endsection