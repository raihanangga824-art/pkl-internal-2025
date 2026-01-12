@extends('layouts.app')

@section('title', 'RaihanCoffeStore - Seduhan Terbaik Setiap Hari')

@section('content')
{{-- Import Fonts --}}
<link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@300;400;600&display=swap"
    rel="stylesheet">

<div class="main-page-wrapper">

    {{-- ================= HERO SECTION ================= --}}
    <section class="hero-video-section position-relative text-white overflow-hidden">
        {{-- Video Background --}}
        <video autoplay muted loop playsinline class="hero-bg-video">
            <source src="{{ asset('videos/kopi.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        {{-- Overlay --}}
        <div class="hero-overlay"></div>

        {{-- Glow Floating --}}
        <div class="glow-element glow-1 float-animation"></div>
        <div class="glow-element glow-2 float-animation" style="animation-delay: 2s;"></div>

        {{-- Content --}}
        <div class="container position-relative z-2">
            <div class="row min-vh-100 align-items-center">
                <div class="col-lg-7 text-center text-lg-start" data-aos="fade-right">

                    <span class="badge rounded-pill px-3 py-2 glass-badge mb-3">
                        <i class="bi bi-stars me-1 text-coffee"></i> Specialty Coffee 2026
                    </span>

                    <h1 class="display-3 fw-bolder serif-font mb-3">
                        Nikmati <br>
                        <span class="text-coffee-gradient">Sempurnanya Rasa.</span>
                    </h1>

                    <p class="lead text-white-50 mb-5 w-lg-75">
                        Dari biji pilihan petani lokal hingga ke cangkir Anda. Pengalaman kopi autentik dalam setiap
                        tetesan.
                    </p>

                    <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                        <a href="{{ route('catalog.index') }}" class="btn btn-coffee-accent btn-lg rounded-pill px-5">
                            Pesan Sekarang
                        </a>
                        <a href="#koleksi" class="btn btn-outline-light btn-lg rounded-pill px-5">
                            Lihat Menu
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= KATEGORI ================= --}}
    <section class="py-5" id="koleksi">
        <div class="container py-lg-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <h6 class="text-coffee fw-bold text-uppercase tracking-widest">Temukan Mood-mu</h6>
                <h2 class="fw-bold display-5 text-white serif-font">Koleksi Racikan Kami</h2>
                <div class="bg-coffee mx-auto mt-3 shadow-glow-coffee" style="width:80px;height:4px;border-radius:2px;">
                </div>
            </div>

            <div class="row g-4 justify-content-center">
                @foreach($categories as $category)
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <a href="{{ route('catalog.index',['category'=>$category->slug]) }}"
                        class="category-card-glass text-decoration-none d-block text-center">
                        <div class="category-icon-wrapper mx-auto mb-3 float-animation">
                            <i class="bi bi-cup-hot fs-3 text-white"></i>
                        </div>
                        <h6 class="text-white fw-bold mb-1">{{ $category->name }}</h6>
                        <span class="text-coffee-light small">{{ $category->products_count }} Menu</span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= PRODUK UNGGULAN ================= --}}
    <section class="py-5 bg-black bg-opacity-10">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5 text-white"
                data-aos="fade-up">
                <div class="text-center text-md-start mb-4 mb-md-0">
                    <h2 class="fw-bold h1 serif-font">Seduhan <span class="text-coffee">Terlaris</span></h2>
                    <p class="text-white-50">Rekomendasi terbaik dari barista kami hari ini</p>
                </div>
                <a href="{{ route('catalog.index') }}" class="btn btn-outline-coffee rounded-pill px-4 fw-bold">
                    Lihat Semua <i class="bi bi-chevron-right ms-1"></i>
                </a>
            </div>

            <div class="row g-4">
                @foreach($featuredProducts as $product)
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 150 }}">
                    <div class="float-animation">
                        @include('profile.partials.product-card', ['product'=>$product])
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= COFFEE INSIDER (CTA) ================= --}}
    <section class="py-5">
        <div class="container py-lg-5">
            <div class="cta-glass-card rounded-5 p-4 p-lg-5 text-white shadow-lg overflow-hidden position-relative"
                data-aos="zoom-in">
                <div class="row align-items-center gy-4 position-relative" style="z-index: 2;">
                    <div class="col-lg-7 text-center text-lg-start">
                        <span class="badge glass-badge-dark mb-3 px-3 py-2">Exclusive Member Access</span>
                        <h2 class="fw-bold display-6 serif-font mb-3">Join Coffee <span
                                class="text-coffee">Insider</span></h2>
                        <p class="text-white-50 mb-0 fs-5">
                            Dapatkan akses biji kopi <strong>limited edition</strong> dan promo mingguan langsung di
                            email Anda.
                        </p>
                    </div>
                    <div class="col-lg-5">
                        <form id="vipForm" class="vip-form-wrapper p-2">
                            @csrf
                            <input type="email" id="vipEmail" class="vip-input form-control" placeholder="Email Anda..."
                                required>
                            <button type="submit" class="vip-btn btn">
                                <span class="d-none d-sm-inline">Gabung</span>
                                <i class="bi bi-send ms-1"></i>
                            </button>
                        </form>
                    </div>
                </div>
                {{-- Decorative glow --}}
                <div class="position-absolute top-0 end-0 bg-coffee opacity-25 blur-3xl"
                    style="width: 200px; height: 200px; filter: blur(80px);"></div>
            </div>
        </div>
    </section>

</div>

{{-- ================= CSS REFINED ================= --}}
<style>
    :root {
        --coffee-accent: #d4a373;
        --coffee-dark: #0c0805;
        --coffee-medium: #1a0f0a;
        --coffee-light: #faedcd;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--coffee-dark);
    }

    .serif-font {
        font-family: 'Playfair Display', serif;
    }

    .main-page-wrapper {
        background: linear-gradient(180deg, var(--coffee-dark) 0%, #2c1b12 50%, var(--coffee-dark) 100%);
    }

    .text-coffee {
        color: var(--coffee-accent) !important;
    }

    .text-coffee-light {
        color: rgba(212, 163, 115, 0.6) !important;
    }

    .bg-coffee {
        background: var(--coffee-accent) !important;
    }

    .text-coffee-gradient {
        background: linear-gradient(45deg, var(--coffee-accent), var(--coffee-light));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hero-video-section {
        position: relative;
        width: 100%;
        min-height: 100vh;
        overflow: hidden;
    }

    .hero-bg-video {
        position: absolute;
        top: 50%;
        left: 50%;
        min-width: 100%;
        min-height: 100%;
        transform: translate(-50%, -50%);
        object-fit: cover;
        z-index: 0;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.55);
        z-index: 1;
    }

    .hero-video-section .container {
        position: relative;
        z-index: 2;
    }

    .glow-element {
        position: absolute;
        border-radius: 50%;
        filter: blur(120px);
        opacity: 0.15;
        z-index: 1;
    }

    .glow-1 {
        width: 500px;
        height: 500px;
        background: var(--coffee-accent);
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

    @keyframes float {

        0%,
        100% {
            transform: translateY(0) translateX(0);
        }

        50% {
            transform: translateY(-20px) translateX(15px);
        }
    }

    .float-animation {
        animation: float 6s ease-in-out infinite;
    }

    .category-card-glass {
        padding: 30px 20px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(212, 163, 115, 0.1);
        border-radius: 30px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .category-card-glass:hover {
        transform: translateY(-12px);
        background: rgba(212, 163, 115, 0.12);
        border-color: var(--coffee-accent);
    }

    .category-icon-wrapper {
        width: 65px;
        height: 65px;
        background: linear-gradient(135deg, #4b3621, var(--coffee-accent));
        border-radius: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .btn-coffee-accent {
        background: var(--coffee-accent);
        color: var(--coffee-dark);
        border: none;
    }

    .btn-coffee-accent:hover {
        background: var(--coffee-light);
        color: var(--coffee-dark);
        transform: translateY(-3px);
    }

    .btn-outline-coffee {
        border: 2px solid var(--coffee-accent);
        color: var(--coffee-accent);
    }

    .btn-outline-coffee:hover {
        background: var(--coffee-accent);
        color: var(--coffee-dark);
    }

    .cta-glass-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(212, 163, 115, 0.2);
    }

    .glass-badge {
        background: rgba(212, 163, 115, 0.15);
        border: 1px solid rgba(212, 163, 115, 0.3);
        color: var(--coffee-accent);
    }

    .glass-badge-dark {
        background: rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #fff;
    }

    .vip-form-wrapper {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 20px;
        display: flex;
        gap: 10px;
    }

    .vip-input {
        background: transparent !important;
        border: none !important;
        color: #fff !important;
        padding-left: 15px;
    }

    .vip-btn {
        background: var(--coffee-accent);
        color: var(--coffee-dark);
        font-weight: 700;
        border-radius: 15px;
        padding: 10px 25px;
    }

    .shadow-glow-coffee {
        box-shadow: 0 0 25px rgba(212, 163, 115, 0.3);
    }

    @media (max-width:768px) {
        .display-3 {
            font-size: 2.5rem;
        }
    }
</style>

@endsection

@push('scripts')
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1000, once: true, offset: 100 });
</script>
@endpush