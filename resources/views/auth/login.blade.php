@extends('layouts.app')

@section('title', 'Login - Artisan Coffee')

@section('content')
<div class="main-page-wrapper d-flex align-items-center justify-content-center min-vh-100 py-5">
    {{-- Glow Background --}}
    <div class="glow-element glow-1"></div>
    <div class="glow-element glow-2"></div>

    <div class="container position-relative" style="z-index: 2;">
        <div class="row justify-content-center">
            <div class="col-md-5" data-aos="fade-up" data-aos-duration="1000">

                {{-- Logo/Brand Header --}}
                <div class="text-center mb-4">
                    <h2 class="serif-font text-white mb-0">Artisan <span class="text-info">Coffee</span></h2>
                    <p class="text-white-50 small text-uppercase tracking-widest">Premium Brewing Experience</p>
                </div>

                {{-- Glassmorphism Card --}}
                <div class="login-card p-4 p-lg-5">
                    <h3 class="text-white fw-bold mb-4 serif-font">Selamat Datang <span
                            class="text-info">Kembali.</span></h3>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Input Email --}}
                        <div class="mb-4">
                            <label for="email" class="form-label text-white-50">Email Address</label>
                            <div class="input-group login-input-group">
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
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="password" class="form-label text-white-50">Password</label>
                                @if (Route::has('password.request'))
                                <a class="small text-info text-decoration-none" href="{{ route('password.request') }}">
                                    Lupa?
                                </a>
                                @endif
                            </div>
                            <div class="input-group login-input-group">
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
                        <div class="mb-4 form-check">
                            <input class="form-check-input custom-check" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-white-50 small" for="remember">
                                Ingat saya di perangkat ini
                            </label>
                        </div>

                        {{-- Login Button --}}
                        <div class="d-grid mb-4">
                            <button type="submit"
                                class="btn btn-info-gradient py-3 fw-bold rounded-pill text-dark transition-up">
                                MASUK SEKARANG <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </div>

                        <div class="position-relative mb-4">
                            <hr class="border-white border-opacity-25">
                            <span class="or-text px-3 text-white-50 small">atau masuk dengan</span>
                        </div>

                        {{-- Google Login --}}
                        <div class="d-grid mb-4">
                            <a href="{{ route('auth.google') }}"
                                class="btn btn-outline-white-glass py-2 rounded-pill text-white small">
                                <img src="https://www.svgrepo.com/show/475656/google-color.svg" width="18"
                                    class="me-2" />
                                Google Account
                            </a>
                        </div>

                        {{-- Register Link --}}
                        <p class="text-center text-white-50 small mb-0">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="text-info fw-bold text-decoration-none ms-1">Daftar
                                Gratis</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling Dasar Mengikuti Home */
    .main-page-wrapper {
        background: linear-gradient(180deg, #1a0f0a 0%, #2c1b12 100%);
        overflow: hidden;
        position: relative;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(212, 163, 115, 0.15);
        border-radius: 40px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    }

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
        color: white;
    }

    .btn-info-gradient {
        background: linear-gradient(45deg, #d4a373, #faedcd);
        border: none;
        letter-spacing: 1px;
    }

    .btn-info-gradient:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(212, 163, 115, 0.3);
        background: linear-gradient(45deg, #faedcd, #d4a373);
    }

    .btn-outline-white-glass {
        border: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(255, 255, 255, 0.02);
        transition: 0.3s;
    }

    .btn-outline-white-glass:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.3);
    }

    .or-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #241711;
        /* Sesuai warna bg di titik tsb */
    }

    .custom-check:checked {
        background-color: #d4a373;
        border-color: #d4a373;
    }

    .text-info {
        color: #d4a373 !important;
    }
</style>
@endsection