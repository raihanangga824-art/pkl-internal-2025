@extends('layouts.app')

@section('content')
<link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@300;400;600&display=swap"
    rel="stylesheet">

<style>
    /* 1. Background Wrapper */
    .auth-wrapper {
        min-height: 100vh;
        background-color: #0c0805;
        background-image:
            radial-gradient(circle at 10% 20%, rgba(212, 163, 115, 0.1) 0%, transparent 40%),
            radial-gradient(circle at 90% 80%, rgba(212, 163, 115, 0.05) 0%, transparent 40%);
        display: flex;
        align-items: center;
        padding: 80px 0;
    }

    /* 2. Glassmorphism Card */
    .glass-auth-card {
        background: rgba(255, 255, 255, 0.03) !important;
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(212, 163, 115, 0.15) !important;
        border-radius: 30px !important;
        overflow: hidden;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
    }

    .card-header-artisan {
        background: rgba(212, 163, 115, 0.1);
        border-bottom: 1px solid rgba(212, 163, 115, 0.1);
        padding: 2rem;
        text-align: center;
    }

    .serif-font {
        font-family: 'Playfair Display', serif;
    }

    .text-coffee {
        color: #d4a373;
    }

    /* 3. Form Styling */
    .glass-input {
        background: rgba(255, 255, 255, 0.05) !important;
        border: 1px solid rgba(212, 163, 115, 0.2) !important;
        color: white !important;
        border-radius: 12px !important;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }

    .glass-input:focus {
        border-color: #d4a373 !important;
        box-shadow: 0 0 15px rgba(212, 163, 115, 0.2) !important;
        background: rgba(255, 255, 255, 0.08) !important;
    }

    .form-label-artisan {
        color: rgba(255, 255, 255, 0.7);
        font-weight: 500;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    /* 4. Button Styling */
    .btn-artisan {
        background: #d4a373;
        color: #0c0805;
        font-weight: 700;
        border-radius: 12px;
        padding: 12px;
        border: none;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }

    .btn-artisan:hover {
        background: #faedcd;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(212, 163, 115, 0.3);
    }

    /* 5. Validation Style */
    .invalid-feedback {
        color: #ff6b6b;
        font-size: 0.8rem;
    }
</style>

<div class="auth-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card glass-auth-card animate__animated animate__fadeInUp">
                    <div class="card-header-artisan">
                        <h2 class="serif-font text-coffee mb-0">{{ __('Register') }}</h2>
                        <p class="text-white-50 small mb-0">Bergabung dengan komunitas penikmat kopi</p>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label-artisan">{{ __('Name') }}</label>
                                <input id="name" type="text"
                                    class="form-control glass-input @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus
                                    placeholder="Masukkan nama lengkap">
                                @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label-artisan">{{ __('Email Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control glass-input @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="email@contoh.com">
                                @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label-artisan">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control glass-input @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password"
                                    placeholder="Minimal 8 karakter">
                                @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password-confirm" class="form-label-artisan">{{ __('Confirm Password')
                                    }}</label>
                                <input id="password-confirm" type="password" class="form-control glass-input"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Ulangi password">
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-artisan">
                                    {{ __('Daftar Sekarang') }}
                                </button>
                            </div>

                            <div class="text-center">
                                <span class="text-white-50 small">Sudah punya akun? </span>
                                <a href="{{ route('login') }}"
                                    class="text-coffee small text-decoration-none fw-bold">Masuk di sini</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection