@extends('layouts.app')

@section('title', 'Artisan Coffee - Seduhan Terbaik Setiap Hari')

@section('content')

<div class="main-page-wrapper">

    {{-- ================= HERO ================= --}}
    <section class="hero-section position-relative overflow-hidden text-white py-5">
        <div class="glow-element glow-1"></div>
        <div class="glow-element glow-2"></div>

        <div class="container position-relative" style="z-index:2;">
            <div class="row align-items-center min-vh-75">

                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="200">

                    <span class="badge bg-info bg-opacity-25 text-info px-3 py-2 rounded-pill mb-3 fw-bold">
                        <i class="bi bi-cup-hot me-1"></i> Freshly Roasted 2026
                    </span>

                    <h1 class="display-3 fw-bolder mb-3 lh-1 serif-font">
                        Nikmati <br>
                        <span class="text-info-gradient">Sempurnanya Rasa.</span>
                    </h1>

                    <p class="lead text-white-50 mb-4 fs-5 w-75">
                        Dari biji pilihan petani lokal hingga ke cangkir Anda.
                    </p>

                    <a href="{{ route('catalog.index') }}"
                        class="btn btn-light btn-lg px-5 py-3 rounded-pill fw-bold shadow-lg text-primary">
                        Pesan Sekarang <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>

                <div class="col-lg-6" data-aos="zoom-in-left" data-aos-duration="1200" data-aos-delay="400">

                    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner rounded-5 shadow-2xl float-animation">
                            <div class="carousel-item active">
                                <img src="{{ asset('images/kopi2.jpg') }}" class="d-block w-100 object-fit-cover"
                                    style="height:500px;">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/kopi3.jpg') }}" class="d-block w-100 object-fit-cover"
                                    style="height:500px;">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- ================= KATEGORI ================= --}}
    <section class="py-5">
        <div class="container">

            <div class="text-center mb-5 text-white" data-aos="fade-up">
                <h6 class="text-info fw-bold text-uppercase">Temukan Mood-mu</h6>
                <h2 class="fw-bold display-6 serif-font">Koleksi Racikan Kami</h2>
                <div class="bg-info mx-auto mt-2 shadow-glow" style="width:60px;height:4px;border-radius:2px;"></div>
            </div>

            <div class="row g-4 justify-content-center text-center">
                @foreach($categories as $category)
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">

                    <a href="{{ route('catalog.index',['category'=>$category->slug]) }}"
                        class="category-card-blue text-decoration-none d-block">

                        <div class="category-icon-wrapper mx-auto mb-3 float-animation">
                            <i class="bi bi-patch-check fs-3 text-white"></i>
                        </div>

                        <h6 class="text-white fw-bold">{{ $category->name }}</h6>
                        <span class="text-white-50 small">{{ $category->products_count }} Menu</span>
                    </a>
                </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- ================= PRODUK UNGGULAN ================= --}}
    <section class="py-5">
        <div class="container">

            <div class="d-flex justify-content-between align-items-end mb-5 text-white" data-aos="fade-up">
                <div>
                    <h2 class="fw-bold h1 serif-font">
                        Seduhan <span class="text-info">Terlaris</span>
                    </h2>
                    <p class="text-white-50">Rekomendasi barista</p>
                </div>
                <a href="{{ route('catalog.index') }}" class="btn btn-outline-info rounded-pill px-4 fw-bold">
                    Semua Menu
                </a>
            </div>

            <div class="row g-4">
                @foreach($featuredProducts as $product)
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 150 }}">
                    @include('profile.partials.product-card', ['product'=>$product])
                </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- ================= COFFEE INSIDER ================= --}}
    <section class="py-5">
        <div class="container">
            <div class="cta-blue-card rounded-5 p-5 text-white shadow-lg" data-aos="zoom-in" data-aos-duration="1200">

                <div class="row align-items-center gy-4">

                    <div class="col-lg-7">
                        <span class="badge vip-badge mb-3">
                            Exclusive Member
                        </span>

                        <h2 class="fw-bold serif-font mb-2">
                            Coffee <span class="text-info">Insider</span>
                        </h2>

                        <p class="text-white-50 mb-0">
                            Akses biji kopi <strong>limited run</strong>,
                            diskon spesial, dan rekomendasi racikan barista
                            setiap minggu langsung ke email kamu.
                        </p>
                    </div>

                    <div class="col-lg-5">
                        <form id="vipForm">
                            @csrf
                            <div class="vip-form-wrapper">
                                <input type="email" id="vipEmail" class="vip-input" placeholder="Masukkan email kamu"
                                    required>

                                <button type="submit" class="vip-btn">
                                    Gabung Sekarang
                                    <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </section>

</div>

{{-- ================= STYLE ================= --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap');

    .serif-font {
        font-family: 'Playfair Display', serif;
    }

    .main-page-wrapper {
        background: linear-gradient(180deg, #1a0f0a, #3d2b1f, #1a0f0a);
    }

    .text-info {
        color: #d4a373 !important;
    }

    .bg-info {
        background: #d4a373 !important;
    }

    .glow-element {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        opacity: .15;
    }

    .glow-1 {
        width: 500px;
        height: 500px;
        background: #d4a373;
        top: -100px;
        right: -50px;
    }

    .glow-2 {
        width: 400px;
        height: 400px;
        background: #8b5a2b;
        bottom: 10%;
        left: -50px;
    }

    .category-card-blue {
        padding: 25px;
        background: rgba(255, 255, 255, .03);
        border-radius: 30px;
        transition: .4s;
    }

    .category-card-blue:hover {
        transform: translateY(-10px);
        background: rgba(212, 163, 115, .15);
    }

    .category-icon-wrapper {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #634832, #d4a373);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cta-blue-card {
        background: linear-gradient(135deg, #2c1b12, #1a0f0a);
        border: 1px solid rgba(212, 163, 115, .3);
    }

    /* ===== VIP ===== */
    .vip-badge {
        background: rgba(212, 163, 115, .15);
        color: #d4a373;
        border: 1px solid rgba(212, 163, 115, .3);
        padding: 6px 14px;
        border-radius: 20px;
        font-size: .75rem;
    }

    .vip-form-wrapper {
        display: flex;
        background: rgba(255, 255, 255, .05);
        border-radius: 18px;
        padding: 6px;
        gap: 6px;
    }

    .vip-input {
        flex: 1;
        background: transparent;
        border: none;
        color: #fff;
        padding: 14px 18px;
    }

    .vip-input::placeholder {
        color: rgba(255, 255, 255, .6);
    }

    .vip-input:focus {
        outline: none;
    }

    .vip-btn {
        background: linear-gradient(135deg, #d4a373, #faedcd);
        color: #1a0f0a;
        border: none;
        padding: 0 26px;
        border-radius: 14px;
        font-weight: 700;
        transition: .3s;
    }

    .vip-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(212, 163, 115, .35);
    }

    /* Float animation */
    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .float-animation {
        animation: float 6s ease-in-out infinite;
    }
</style>

@endsection

@push('scripts')
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
    AOS.init({
    duration: 1000,
    easing: 'ease-out-cubic',
    once: false,
    mirror: true,
    offset: 80
});
</script>
@endpush