@extends('layouts.app')

@section('title', 'Profil Saya - Artisan Coffee')

@section('content')
<div class="main-page-wrapper py-5 min-vh-100">
    {{-- Animasi Background Glow --}}
    <div class="glow-element glow-1"></div>
    <div class="glow-element glow-2"></div>

    <div class="container position-relative py-5" style="z-index: 2;">
        <div class="row">
            {{-- ================= SISI KIRI: PANEL USER ================= --}}
            <div class="col-lg-4 mb-4" data-aos="fade-right">
                <div class="profile-glass-card text-center p-4 mb-4">
                    <div class="position-relative d-inline-block mx-auto mb-3">
                        @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}"
                            class="rounded-circle shadow-glow-warm border border-4 border-coffee-light" width="130"
                            height="130" style="object-fit: cover;">
                        @else
                        <div class="avatar-placeholder mx-auto shadow-glow-warm">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        @endif
                        <span
                            class="badge bg-coffee-primary text-dark position-absolute bottom-0 end-0 rounded-pill border border-dark border-3 px-3 py-2">
                            <i class="bi bi-patch-check-fill"></i> Member
                        </span>
                    </div>

                    <h4 class="fw-bold text-white mb-1 serif-font">{{ Auth::user()->name }}</h4>
                    <p class="text-white-50 small mb-4">{{ Auth::user()->email }}</p>

                    <div class="nav flex-column nav-pills custom-profile-tabs text-start" id="v-pills-tab"
                        role="tablist">
                        <button class="nav-link active mb-2" id="v-pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-profile" type="button">
                            <i class="bi bi-person-lines-fill me-2"></i> Informasi Profil
                        </button>
                        <button class="nav-link mb-2" id="v-pills-password-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-password" type="button">
                            <i class="bi bi-shield-lock-fill me-2"></i> Keamanan Akun
                        </button>
                        <button class="nav-link mb-2" id="v-pills-accounts-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-accounts" type="button">
                            <i class="bi bi-link-45deg me-2"></i> Akun Terhubung
                        </button>
                        <button class="nav-link text-danger-light" id="v-pills-delete-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-delete" type="button">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> Hapus Akun
                        </button>
                    </div>
                </div>

                <a href="{{ url('/') }}" class="btn btn-outline-white-glass w-100 rounded-pill py-2">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Beranda
                </a>
            </div>

            {{-- ================= SISI KANAN: KONTEN FORM ================= --}}
            <div class="col-lg-8" data-aos="fade-left">
                @if (session('success'))
                <div class="alert alert-coffee-success border-0 rounded-4 mb-4">
                    <i class="bi bi-check2-all me-2"></i> {{ session('success') }}
                </div>
                @endif

                <div class="tab-content" id="v-pills-tabContent">
                    {{-- Tab 1: Update Profil & Avatar --}}
                    <div class="tab-pane fade show active" id="v-pills-profile">
                        <div class="content-glass-card">
                            <div class="card-header-coffee">
                                <h5 class="fw-bold mb-0 text-white serif-font">Detail Profil</h5>
                                <p class="text-white-50 small mb-0">Kelola identitas dan foto profil Anda</p>
                            </div>
                            <div class="card-body p-4 p-lg-5">
                                <div class="mb-5">
                                    @include('profile.partials.update-avatar-form')
                                </div>
                                <hr class="border-white border-opacity-10 my-5">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>
                    </div>

                    {{-- Tab 2: Keamanan (Password) --}}
                    <div class="tab-pane fade" id="v-pills-password">
                        <div class="content-glass-card">
                            <div class="card-header-coffee">
                                <h5 class="fw-bold mb-0 text-white serif-font">Ubah Kata Sandi</h5>
                                <p class="text-white-50 small mb-0">Disarankan untuk memperbarui password secara berkala
                                </p>
                            </div>
                            <div class="card-body p-4 p-lg-5">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>
                    </div>

                    {{-- Tab 3: Connected Accounts --}}
                    <div class="tab-pane fade" id="v-pills-accounts">
                        <div class="content-glass-card">
                            <div class="card-header-coffee">
                                <h5 class="fw-bold mb-0 text-white serif-font">Integrasi Sosial</h5>
                                <p class="text-white-50 small mb-0">Hubungkan akun Anda dengan layanan lain</p>
                            </div>
                            <div class="card-body p-4 p-lg-5">
                                @include('profile.partials.connected-accounts')
                            </div>
                        </div>
                    </div>

                    {{-- Tab 4: Delete Account --}}
                    <div class="tab-pane fade" id="v-pills-delete">
                        <div class="content-glass-card border-danger-glass">
                            <div class="card-header-coffee bg-danger bg-opacity-10">
                                <h5 class="fw-bold mb-0 text-danger serif-font">Hapus Akun</h5>
                                <p class="text-danger-light small mb-0">Data yang sudah dihapus tidak dapat dipulihkan
                                </p>
                            </div>
                            <div class="card-body p-4 p-lg-5">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* CSS DASAR TEMA KOPI */
    .main-page-wrapper {
        background: linear-gradient(180deg, #1a0f0a 0%, #2c1b12 100%) !important;
        position: relative;
        overflow: hidden;
    }

    .serif-font {
        font-family: 'Playfair Display', serif;
    }

    /* CARD STYLE (GLASSMORPHISM) */
    .profile-glass-card,
    .content-glass-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(212, 163, 115, 0.15);
        border-radius: 35px;
        overflow: hidden;
    }

    .card-header-coffee {
        padding: 1.5rem 1.5rem;
        background: rgba(212, 163, 115, 0.07);
        border-bottom: 1px solid rgba(212, 163, 115, 0.1);
    }

    /* TYPOGRAPHY & FORM INPUTS (SOLUSI TEKS TIDAK TERLIHAT) */
    .content-glass-card label {
        color: #d4a373 !important;
        /* Warna Label Emas Kopi */
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }

    .content-glass-card p,
    .content-glass-card span,
    .content-glass-card .text-muted,
    .content-glass-card small {
        color: rgba(255, 255, 255, 0.7) !important;
    }

    .content-glass-card .form-control {
        background: rgba(255, 255, 255, 0.05) !important;
        border: 1px solid rgba(212, 163, 115, 0.2) !important;
        color: #ffffff !important;
        border-radius: 12px;
        padding: 12px 18px;
    }

    .content-glass-card .form-control:focus {
        background: rgba(255, 255, 255, 0.1) !important;
        border-color: #d4a373 !important;
        box-shadow: 0 0 15px rgba(212, 163, 115, 0.2) !important;
    }

    /* BUTTONS */
    .bg-coffee-primary {
        background-color: #d4a373 !important;
    }

    .btn-outline-white-glass {
        border: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(255, 255, 255, 0.02);
        color: white;
        transition: 0.3s;
    }

    .btn-outline-white-glass:hover {
        background: rgba(212, 163, 115, 0.1);
        color: #d4a373;
        border-color: #d4a373;
    }

    /* CUSTOM TABS */
    .custom-profile-tabs .nav-link {
        color: rgba(255, 255, 255, 0.6);
        border-radius: 15px;
        padding: 14px 20px;
        margin-bottom: 5px;
        transition: 0.3s;
    }

    .custom-profile-tabs .nav-link:hover {
        background: rgba(212, 163, 115, 0.1);
        color: #d4a373;
    }

    .custom-profile-tabs .nav-link.active {
        background: #d4a373 !important;
        color: #1a0f0a !important;
        font-weight: 700;
        box-shadow: 0 8px 20px rgba(212, 163, 115, 0.3);
    }

    /* AVATAR PLACEHOLDER */
    .avatar-placeholder {
        width: 130px;
        height: 130px;
        background: linear-gradient(135deg, #634832, #d4a373);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3.5rem;
        color: white;
        font-weight: bold;
        border: 4px solid #ffffff;
    }

    /* GLOW BACKGROUND ELEMENTS */
    .glow-element {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        opacity: 0.15;
        z-index: 1;
    }

    .glow-1 {
        width: 450px;
        height: 450px;
        background: #d4a373;
        top: -100px;
        right: -50px;
    }

    .glow-2 {
        width: 350px;
        height: 350px;
        background: #8b5a2b;
        bottom: 10%;
        left: -50px;
    }

    /* MISC */
    .alert-coffee-success {
        background: rgba(40, 167, 69, 0.15);
        color: #2ecc71;
        border: 1px solid rgba(46, 204, 113, 0.3);
    }

    .text-danger-light {
        color: #ff7675 !important;
    }

    .shadow-glow-warm {
        box-shadow: 0 0 25px rgba(212, 163, 115, 0.3);
    }

    .text-coffee-light {
        color: #d4a373 !important;
    }
</style>
@endsection