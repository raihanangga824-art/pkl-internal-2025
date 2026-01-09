{{-- Navbar Modern dengan Efek Transisi Coffee Theme --}}
<nav class="navbar navbar-expand-lg fixed-top navbar-custom transition-all" id="mainNavbar">
    <div class="container">
        {{-- Logo & Brand --}}
        <a class="navbar-brand fw-bolder d-flex align-items-center" href="{{ route('home') }}">
            <div class="brand-icon-wrapper me-2 shadow-glow-warm">
                <i class="bi bi-cup-hot-fill"></i>
            </div>
            <span class="brand-text serif-font">RAIHAN<span class="text-coffee-light">COFFEE</span>STORE</span>
        </a>

        {{-- Mobile Toggle --}}
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarMain">
            <i class="bi bi-list fs-1 text-coffee-light"></i>
        </button>

        {{-- Navbar Content --}}
        <div class="collapse navbar-collapse" id="navbarMain">
            {{-- Search Form - Center (Glass Style) --}}
            <form class="d-flex mx-auto nav-search-box mt-3 mt-lg-0" action="{{ route('catalog.index') }}" method="GET">
                <div class="input-group glass-input rounded-pill overflow-hidden border border-white border-opacity-10">
                    <span class="input-group-text bg-transparent border-0"><i
                            class="bi bi-search text-coffee-light"></i></span>
                    <input type="text" name="q" class="form-control bg-transparent border-0 shadow-none text-white"
                        placeholder="Cari rasa favoritmu..." value="{{ request('q') }}">
                </div>
            </form>

            {{-- Right Menu --}}
            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="{{ route('catalog.index') }}">Menu</a>
                </li>

                @auth
                {{-- Wishlist --}}
                <li class="nav-item">
                    <a class="nav-link nav-icon-link" href="{{ route('wishlist.index') }}">
                        <i class="bi bi-heart"></i>
                        @if(auth()->user()->wishlists()->count() > 0)
                        <span class="nav-badge bg-coffee-accent">{{ auth()->user()->wishlists()->count() }}</span>
                        @endif
                    </a>
                </li>

                {{-- Cart --}}
                <li class="nav-item">
                    <a class="nav-link nav-icon-link" href="{{ route('cart.index') }}">
                        <i class="bi bi-bag-check"></i>
                        @php $cartCount = auth()->user()->cart?->items()->count() ?? 0; @endphp
                        @if($cartCount > 0)
                        <span class="nav-badge bg-coffee-light text-dark fw-bold">{{ $cartCount }}</span>
                        @endif
                    </a>
                </li>

                {{-- User Dropdown --}}
                <li class="nav-item dropdown ms-lg-2">
                    <a class="nav-link dropdown-toggle user-pill" href="#" id="userDropdown" data-bs-toggle="dropdown">
                        <img src="{{ auth()->user()->avatar_url }}"
                            class="rounded-circle me-2 border border-2 border-coffee-light" width="30" height="30">
                        <span class="d-none d-sm-inline text-white">{{ explode(' ', auth()->user()->name)[0] }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-coffee-dim glass-card shadow-lg rounded-4 mt-3">
                        <li class="px-3 py-2 border-bottom border-white border-opacity-10 mb-2">
                            <small class="text-white-50 d-block">Selamat datang,</small>
                            <span class="fw-bold text-coffee-light">{{ auth()->user()->name }}</span>
                        </li>
                        <li><a class="dropdown-item py-2 text-white" href="{{ route('profile.edit') }}"><i
                                    class="bi bi-person me-2"></i> Profil</a></li>
                        <li><a class="dropdown-item py-2 text-white" href="{{ route('orders.index') }}"><i
                                    class="bi bi-clock-history me-2"></i> Riwayat Pesanan</a></li>

                        @if(auth()->user()->isAdmin())
                        <li>
                            <hr class="dropdown-divider border-white border-opacity-10">
                        </li>
                        <li><a class="dropdown-item py-2 text-coffee-light fw-bold"
                                href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Panel
                                Admin</a></li>
                        @endif

                        <li>
                            <hr class="dropdown-divider border-white border-opacity-10">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 text-danger"><i
                                        class="bi bi-box-arrow-right me-2"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link px-3" href="{{ route('login') }}">Masuk</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-coffee-light rounded-pill px-4 shadow-sm fw-bold"
                        href="{{ route('register') }}">Join Member</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap');

    .serif-font {
        font-family: 'Playfair Display', serif;
    }

    /* Dasar Navbar */
    .navbar-custom {
        padding: 1.2rem 0;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 1030;
    }

    /* Efek Saat Di Atas (Transparent) */
    .navbar-custom.scrolled-none {
        background: transparent;
    }

    .navbar-custom.scrolled-none .nav-link,
    .navbar-custom.scrolled-none .brand-text {
        color: #ffffff !important;
    }

    /* Efek Saat Scroll (Glassmorphism Dark) */
    .navbar-custom.scrolled {
        background: rgba(26, 15, 10, 0.85);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        padding: 0.8rem 0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2) !important;
        border-bottom: 1px solid rgba(212, 163, 115, 0.1);
    }

    .navbar-custom.scrolled .nav-link,
    .navbar-custom.scrolled .brand-text {
        color: #ffffff !important;
    }

    /* Brand & Icons */
    .brand-icon-wrapper {
        background: #d4a373;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: #1a0f0a;
        font-size: 1.2rem;
    }

    .text-coffee-light {
        color: #d4a373 !important;
    }

    .bg-coffee-accent {
        background-color: #8b5a2b !important;
    }

    .border-coffee-dim {
        border: 1px solid rgba(212, 163, 115, 0.2) !important;
    }

    /* Search Box Glass Style */
    .glass-input {
        background: rgba(255, 255, 255, 0.05);
        transition: all 0.3s;
    }

    .glass-input:focus-within {
        background: rgba(255, 255, 255, 0.1);
        border-color: #d4a373 !important;
        box-shadow: 0 0 15px rgba(212, 163, 115, 0.1);
    }

    .nav-search-box {
        max-width: 350px;
        width: 100%;
    }

    .nav-icon-link {
        font-size: 1.3rem;
        position: relative;
        padding: 0.5rem 0.8rem !important;
        color: #ffffff !important;
    }

    .nav-badge {
        position: absolute;
        top: 5px;
        right: 0;
        font-size: 0.65rem;
        padding: 0.25em 0.5em;
        border-radius: 50%;
        border: 2px solid #1a0f0a;
    }

    /* User Pill */
    .user-pill {
        background: rgba(212, 163, 115, 0.15);
        padding: 5px 15px 5px 5px !important;
        border-radius: 50px;
        border: 1px solid rgba(212, 163, 115, 0.2);
    }

    .btn-coffee-light {
        background-color: #d4a373;
        color: #1a0f0a;
        transition: all 0.3s;
    }

    .btn-coffee-light:hover {
        background-color: #faedcd;
        transform: translateY(-2px);
    }

    /* Dropdown Glass Style */
    .glass-card {
        background: rgba(44, 27, 18, 0.95) !important;
        backdrop-filter: blur(10px);
    }

    .dropdown-item {
        transition: all 0.3s;
    }

    .dropdown-item:hover {
        background-color: rgba(212, 163, 115, 0.1);
        color: #d4a373 !important;
        transform: translateX(5px);
    }

    .shadow-glow-warm {
        box-shadow: 0 0 15px rgba(212, 163, 115, 0.3);
    }

    @media (max-width: 991.98px) {
        .navbar-custom {
            background: #1a0f0a !important;
        }

        .nav-search-box {
            max-width: 100%;
            margin-bottom: 1rem;
        }

        .user-pill {
            margin-top: 10px;
            width: 100%;
            justify-content: center;
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const nav = document.getElementById('mainNavbar');
        
        function handleScroll() {
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
                nav.classList.remove('scrolled-none');
            } else {
                nav.classList.remove('scrolled');
                nav.classList.add('scrolled-none');
            }
        }

        window.addEventListener('scroll', handleScroll);
        handleScroll();
    });
</script>