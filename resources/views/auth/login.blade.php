@extends('layouts.app')

@section('title', 'Login - Artisan Coffee')

@section('content')
<div class="main-page-wrapper d-flex align-items-center justify-content-center min-vh-100 py-5">
    {{-- Elemen Dekoratif Glow Background --}}
    <div class="glow-element glow-1"></div>
    <div class="glow-element glow-2"></div>

    <div class="container position-relative" style="z-index: 2;">
        <div class="row justify-content-center">
            <div class="col-md-5">

                {{-- Header Logo & Brand --}}
                <div class="text-center mb-4" data-aos="fade-down" data-aos-duration="1200">
                    <h2 class="serif-font text-white mb-0">Raihan<span class="text-info">Coffee</span>Store</h2>
                    <p class="text-white-50 small text-uppercase tracking-widest floating-text">Premium Brewing
                        Experience</p>
                </div>

                {{-- Card Login Glassmorphism --}}
                <div class="login-card p-4 p-lg-5" data-aos="zoom-in-up" data-aos-duration="1000">
                    <h3 class="text-white fw-bold mb-4 serif-font">
                        Selamat Datang <span class="text-info d-inline-block">Kembali.</span>
                    </h3>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Input Email --}}
                        <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
                            <label for="email" class="form-label text-white-50">Email Address</label>
                            <div class="input-group login-input-group transition-focus">
                                <span class="input-group-text bg-transparent border-end-0 text-white-50">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input id="email" type="email"
                                    class="form-control bg-transparent text-white border-start-0 @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autofocus
                                    placeholder="nama@email.com">
                            </div>
                            @error('email')
                            <small class="text-danger mt-1 d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Input Password --}}
                        <div class="mb-3" data-aos="fade-up" data-aos-delay="400">
                            <div class="d-flex justify-content-between">
                                <label for="password" class="form-label text-white-50">Password</label>
                                @if (Route::has('password.request'))
                                <a class="small text-info text-decoration-none hover-underline"
                                    href="{{ route('password.request') }}">
                                    Lupa?
                                </a>
                                @endif
                            </div>
                            <div class="input-group login-input-group transition-focus">
                                <span class="input-group-text bg-transparent border-end-0 text-white-50">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input id="password" type="password"
                                    class="form-control bg-transparent text-white border-start-0 @error('password') is-invalid @enderror"
                                    name="password" required placeholder="••••••••">
                            </div>
                            @error('password')
                            <small class="text-danger mt-1 d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Remember Me --}}
                        <div class="mb-4 form-check" data-aos="fade-in" data-aos-delay="600">
                            <input class="form-check-input custom-check" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-white-50 small" for="remember">
                                Ingat saya di perangkat ini
                            </label>
                        </div>

                        {{-- Tombol Login (Perbaikan Teks Terlihat) --}}
                        <div class="d-grid mb-4" data-aos="fade-up" data-aos-delay="800">
                            <button type="submit"
                                class="btn btn-info-gradient py-3 fw-bolder rounded-pill shadow-lg border-0">
                                <span class="btn-text">MASUK SEKARANG</span>
                                <i class="bi bi-arrow-right ms-2 pulse-icon"></i>
                            </button>
                        </div>

                        <div class="position-relative mb-4 text-center">
                            <hr class="border-white border-opacity-25">
                            <span class="or-text px-3 text-white-50 small">atau</span>
                        </div>

                        {{-- Google Login --}}
                        <div class="d-grid mb-4" data-aos="fade-up" data-aos-delay="900">
                            <a href="{{ route('auth.google') }}"
                                class="btn btn-outline-white-glass py-2 rounded-pill text-white small btn-google-hover">
                                <img src="https://www.svgrepo.com/show/475656/google-color.svg" width="18"
                                    class="me-2" />
                                Google Account
                            </a>
                        </div>

                        {{-- Link Daftar --}}
                        <p class="text-center text-white-50 small mb-0" data-aos="fade-in" data-aos-delay="1000">
                            Belum punya akun?
                            <a href="{{ route('register') }}"
                                class="text-info fw-bold text-decoration-none ms-1 link-glow">Daftar Gratis</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Reset & Base */
    .main-page-wrapper {
        background: linear-gradient(180deg, #1a0f0a 0%, #2c1b12 100%);
        overflow: hidden;
        position: relative;
    }

    /* Glassmorphism Card */
    .login-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(212, 163, 115, 0.15);
        border-radius: 40px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
    }

    /* Input Styling */
    .login-input-group .form-control,
    .login-input-group .input-group-text {
        border-color: rgba(212, 163, 115, 0.2);
        padding-top: 12px;
        padding-bottom: 12px;
    }

    .login-input-group .form-control:focus {
        background: rgba(255, 255, 255, 0.05);
        border-color: #d4a373;
        box-shadow: none;
        color: white !important;
    }

    /* TOMBOL: Masuk Sekarang (High Contrast) */
    .btn-info-gradient {
        background: linear-gradient(45deg, #d4a373, #faedcd);
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
    }

    .btn-text {
        color: #1a0f0a !important;
        /* Warna cokelat tua pekat agar terbaca */
        font-weight: 800;
        letter-spacing: 1px;
        z-index: 5;
        position: relative;
    }

    .btn-info-gradient:hover {
        transform: translateY(-3px);
        background: linear-gradient(45deg, #faedcd, #d4a373);
        box-shadow: 0 10px 20px rgba(212, 163, 115, 0.3);
    }

    /* Glow Elements Animasi */
    .glow-element {
        position: absolute;
        width: 450px;
        height: 450px;
        background: radial-gradient(circle, rgba(212, 163, 115, 0.12) 0%, rgba(0, 0, 0, 0) 70%);
        border-radius: 50%;
        filter: blur(60px);
        z-index: 1;
    }

    .glow-1 {
        top: -150px;
        left: -150px;
        animation: pulseGlow 10s infinite alternate;
    }

    .glow-2 {
        bottom: -150px;
        right: -150px;
        animation: pulseGlow 10s infinite alternate-reverse;
    }

    @keyframes pulseGlow {
        from {
            transform: scale(1);
            opacity: 0.4;
        }

        to {
            transform: scale(1.3);
            opacity: 0.7;
        }
    }

    /* Floating & Other Animations */
    .floating-text {
        animation: floatAnim 4s infinite ease-in-out;
    }

    @keyframes floatAnim {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-8px);
        }
    }

    .pulse-icon {
        display: inline-block;
        animation: pulseIcon 1.5s infinite;
        color: #1a0f0a;
    }

    @keyframes pulseIcon {

        0%,
        100% {
            transform: translateX(0);
        }

        50% {
            transform: translateX(5px);
        }
    }

    /* Utility */
    .text-info {
        color: #d4a373 !important;
    }

    .or-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #241711;
        /* Match background gradien */
        z-index: 3;
    }

    .btn-outline-white-glass {
        border: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(255, 255, 255, 0.02);
        transition: 0.3s;
    }

    .btn-outline-white-glass:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
    }

    .custom-check:checked {
        background-color: #d4a373;
        border-color: #d4a373;
    }
</style>
@endsection