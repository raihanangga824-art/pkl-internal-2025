@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        {{-- Sisi Kiri: Profil Singkat & Navigasi Tab --}}
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4 mb-4">
                <div class="position-relative d-inline-block mx-auto mb-3">
                    @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}"
                        class="rounded-circle shadow-sm border border-4 border-white" width="120" height="120"
                        style="object-fit: cover;">
                    @else
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm"
                        style="width: 120px; height: 120px; font-size: 3rem;">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    @endif
                </div>
                <h5 class="fw-bold mb-0">{{ Auth::user()->name }}</h5>
                <p class="text-muted small">{{ Auth::user()->email }}</p>
                <hr class="opacity-10">

                <div class="nav flex-column nav-pills text-start" id="v-pills-tab" role="tablist"
                    aria-orientation="vertical">
                    <button class="nav-link active py-3 rounded-3 mb-2" id="v-pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-profile" type="button">
                        <i class="bi bi-person me-2"></i> Informasi Profil
                    </button>
                    <button class="nav-link py-3 rounded-3 mb-2" id="v-pills-password-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-password" type="button">
                        <i class="bi bi-shield-lock me-2"></i> Keamanan
                        </a>
                        <button class="nav-link py-3 rounded-3 mb-2" id="v-pills-accounts-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-accounts" type="button">
                            <i class="bi bi-link-45deg me-2"></i> Akun Terhubung
                        </button>
                        <button class="nav-link py-3 rounded-3 text-danger" id="v-pills-delete-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-delete" type="button">
                            <i class="bi bi-trash me-2"></i> Hapus Akun
                        </button>
                </div>
            </div>

            <a href="{{ url('/') }}" class="btn btn-light w-100 rounded-pill py-2 shadow-sm">
                <i class="bi bi-house-door me-1"></i> Kembali ke Beranda
            </a>
        </div>

        {{-- Sisi Kanan: Konten Tab --}}
        <div class="col-lg-8">
            @if (session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
            @endif

            <div class="tab-content mt-0" id="v-pills-tabContent">
                {{-- Tab 1: Informasi Profil & Avatar --}}
                <div class="tab-pane fade show active" id="v-pills-profile">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-white border-0 pt-4 px-4">
                            <h5 class="fw-bold mb-0">Informasi Dasar</h5>
                        </div>
                        <div class="card-body p-4">
                            @include('profile.partials.update-avatar-form')
                            <hr class="my-4 opacity-10">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                {{-- Tab 2: Password --}}
                <div class="tab-pane fade" id="v-pills-password">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white border-0 pt-4 px-4">
                            <h5 class="fw-bold mb-0">Perbarui Kata Sandi</h5>
                        </div>
                        <div class="card-body p-4">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                {{-- Tab 3: Connected Accounts --}}
                <div class="tab-pane fade" id="v-pills-accounts">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white border-0 pt-4 px-4">
                            <h5 class="fw-bold mb-0">Media Sosial & Akun</h5>
                        </div>
                        <div class="card-body p-4">
                            @include('profile.partials.connected-accounts')
                        </div>
                    </div>
                </div>

                {{-- Tab 4: Delete Account --}}
                <div class="tab-pane fade" id="v-pills-delete">
                    <div class="card border-0 shadow-sm rounded-4 border-top border-danger border-4">
                        <div class="card-header bg-white border-0 pt-4 px-4">
                            <h5 class="fw-bold text-danger mb-0">Hapus Akun Permanen</h5>
                        </div>
                        <div class="card-body p-4">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f4f7f6;
    }

    /* Styling Tab Navigasi */
    .nav-pills .nav-link {
        color: #6c757d;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .nav-pills .nav-link:hover {
        background-color: #f8f9fa;
        color: #0d6efd;
    }

    .nav-pills .nav-link.active {
        background-color: #0d6efd;
        color: white;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
    }

    .nav-pills .nav-link.text-danger:hover {
        background-color: #fff5f5;
    }

    .nav-pills .nav-link.text-danger.active {
        background-color: #dc3545;
        color: white;
    }

    /* Animasi Tab */
    .tab-pane {
        animation: fadeIn 0.4s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection