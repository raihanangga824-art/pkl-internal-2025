<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') — Admin Elite</title>

    {{-- Fonts: Inter --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Icons: Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --sidebar-bg: #ffffff;
            --sidebar-color: #64748b;
            --sidebar-active-bg: #f1f5f9;
            --sidebar-active-color: #0f172a;
            --main-bg: #f8fafc;
            --accent-color: #2563eb;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--main-bg);
            color: #1e293b;
            letter-spacing: -0.01em;
            margin: 0;
            overflow-x: hidden;
        }

        /* Sidebar Modern */
        .sidebar {
            width: 280px;
            min-height: 100vh;
            background: var(--sidebar-bg);
            border-right: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            height: 100vh;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .sidebar .nav-link {
            color: var(--sidebar-color);
            font-weight: 500;
            font-size: 0.925rem;
            padding: 10px 16px;
            margin: 4px 16px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
        }

        .sidebar .nav-link i {
            font-size: 1.2rem;
            margin-right: 12px;
        }

        .sidebar .nav-link:hover {
            background: var(--sidebar-active-bg);
            color: var(--accent-color);
        }

        .sidebar .nav-link.active {
            background: var(--sidebar-active-bg);
            color: var(--accent-color);
            font-weight: 600;
        }

        .nav-section-title {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #94a3b8;
            padding: 24px 32px 8px;
        }

        /* Top Bar Styling */
        .topbar {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid #e2e8f0;
            padding: 0.75rem 2rem;
            z-index: 1000;
        }

        .btn-premium-logout {
            background: #fff;
            border: 1px solid #e2e8f0;
            color: #ef4444;
            font-weight: 500;
            border-radius: 8px;
            padding: 6px 16px;
            transition: all 0.2s;
        }

        .btn-premium-logout:hover {
            background: #fef2f2;
            border-color: #fecaca;
        }

        /* Content Area */
        .main-content-wrapper {
            padding: 2rem;
        }

        .breadcrumb-custom {
            font-size: 0.85rem;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
    </style>

    @stack('styles')
</head>

<body>
    <div class="d-flex">
        {{-- Sidebar --}}
        <aside class="sidebar">
            {{-- Brand / Logo --}}
            <div class="py-4 px-4 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
                    <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center me-2"
                        style="width: 35px; height: 35px;">
                        <i class="bi bi-lightning-charge-fill text-white"></i>
                    </div>
                    <span class="fs-5 fw-bold tracking-tight text-dark">RaihanCoffeStore<span
                            class="text-primary">.</span></span>
                </a>
            </div>

            {{-- Navigation Items --}}
            <nav class="flex-grow-1">
                <div class="nav-section-title">Menu Utama</div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}"
                            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-grid-1x2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.products.index') }}"
                            class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                            <i class="bi bi-bag-check"></i> Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.categories.index') }}"
                            class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                            <i class="bi bi-layers"></i> Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index') }}"
                            class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                            <i class="bi bi-wallet2"></i> Pesanan
                            @if(!empty($pendingCount) && $pendingCount > 0)
                            <span class="badge rounded-pill bg-primary ms-auto" style="font-size: 0.7rem;">{{
                                $pendingCount }}</span>
                            @endif
                        </a>
                    </li>
                </ul>

                <div class="nav-section-title">Manajemen</div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}"
                            class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i class="bi bi-person-gear"></i> Pengguna
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.reports.sales') }}"
                            class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                            <i class="bi bi-bar-chart-line"></i> Laporan Analitik
                        </a>
                    </li>
                </ul>
            </nav>

            {{-- User Avatar Profile --}}
            <div class="p-4 mt-auto border-top">
                <div class="d-flex align-items-center">
                    <img src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=f1f5f9&color=2563eb' }}"
                        class="rounded-circle me-3" width="40" height="40" alt="Avatar">
                    <div class="overflow-hidden">
                        <div class="small fw-bold text-dark text-truncate">{{ auth()->user()->name }}</div>
                        <div class="text-muted" style="font-size: 0.75rem;">Super Admin</div>
                    </div>
                </div>
            </div>
        </aside>

        {{-- Main Content Section --}}
        <div class="flex-grow-1 overflow-auto" style="height: 100vh;">
            {{-- Top Bar Header --}}
            <header class="topbar sticky-top d-flex justify-content-between align-items-center">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 breadcrumb-custom">
                            <li class="breadcrumb-item text-muted">Admin</li>
                            <li class="breadcrumb-item active fw-medium text-dark">@yield('page-title', 'Overview')</li>
                        </ol>
                    </nav>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('home') }}" class="text-muted text-decoration-none small fw-medium"
                        target="_blank">
                        <i class="bi bi-arrow-up-right-square me-1"></i> Lihat Toko
                    </a>
                    <div class="vr mx-2 text-secondary opacity-25" style="height: 20px;"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-premium-logout btn-sm">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </button>
                    </form>
                </div>
            </header>

            {{-- Alert Flash Messages --}}
            <div class="px-4 pt-4">
                @include('profile.partials.flash-messages')
            </div>

            {{-- Dynamic Page Content --}}
            <main class="main-content-wrapper">
                <div class="mb-4">
                    <h2 class="fw-bold text-dark h4 mb-1">@yield('page-title', 'Dashboard Overview')</h2>
                    <p class="text-muted small">Kelola data dan operasional bisnis Anda dari sini.</p>
                </div>

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>

</html>