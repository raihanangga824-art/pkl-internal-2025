{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

{{-- ================================================
FILE: resources/views/home.blade.php
FUNGSI: Halaman utama website
================================================ --}}

{{-- =====================================================
FILE: resources/views/home.blade.php
FUNGSI: Halaman utama website
===================================================== --}}

@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- ================= HERO SECTION ================= --}}
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-3">
                    <i class="bi bi-shop me-2"></i>
                    Belanja Online Mudah & Terpercaya
                </h1>
                <p class="lead mb-4">
                    Temukan berbagai produk berkualitas dengan harga terbaik.
                    Gratis ongkir untuk pembelian pertama!
                </p>
                <a href="{{ route('catalog.index') }}" class="btn btn-light btn-lg">
                    <i class="bi bi-cart3 me-2"></i>
                    Mulai Belanja
                </a>
            </div>
            <div class="col-lg-6 d-none d-lg-block text-center">
                <img src="{{ asset('images/hero-shopping.svg') }}"
                     alt="Shopping"
                     class="img-fluid"
                     style="max-height: 400px;">
            </div>
        </div>
    </div>
</section>

{{-- ================= KATEGORI ================= --}}
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">
            <i class="bi bi-grid-fill me-2"></i>
            Kategori Populer
        </h2>

        <div class="row g-4">
            @foreach($categories as $category)
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('catalog.index', ['category' => $category->slug]) }}"
                       class="text-decoration-none">
                        <div class="card border-0 shadow-sm text-center h-100">
                            <div class="card-body">
                                <img src="{{ $category->image_url }}"
                                     alt="{{ $category->name }}"
                                     class="rounded-circle mb-3"
                                     width="80"
                                     height="80"
                                     style="object-fit: cover;">

                                <h6 class="card-title mb-1">
                                    {{ $category->name }}
                                </h6>
                                <small class="text-muted">
                                    <i class="bi bi-box-seam me-1"></i>
                                    {{ $category->products_count }} produk
                                </small>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= PRODUK UNGGULAN ================= --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">
                <i class="bi bi-star-fill text-warning me-2"></i>
                Produk Unggulan
            </h2>
            <a href="{{ route('catalog.index') }}" class="btn btn-outline-primary">
                Lihat Semua
                <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            @foreach($featuredProducts as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    @include('profile.partials.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= PROMO ================= --}}
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card bg-warning text-dark border-0 h-100">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h3>
                            <i class="bi bi-lightning-fill me-2"></i>
                            Flash Sale!
                        </h3>
                        <p>Diskon hingga 50% untuk produk pilihan</p>
                        <a href="#" class="btn btn-dark w-fit">
                            <i class="bi bi-tags me-1"></i>
                            Lihat Promo
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card bg-info text-white border-0 h-100">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h3>
                            <i class="bi bi-person-plus-fill me-2"></i>
                            Member Baru?
                        </h3>
                        <p>Dapatkan voucher Rp 50.000 untuk pembelian pertama</p>
                        <a href="{{ route('register') }}" class="btn btn-light w-fit">
                            <i class="bi bi-person-check-fill me-1"></i>
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ================= PRODUK TERBARU ================= --}}
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">
            <i class="bi bi-clock-history me-2"></i>
            Produk Terbaru
        </h2>

        <div class="row g-4">
            @foreach($latestProducts as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    @include('profile.partials.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
