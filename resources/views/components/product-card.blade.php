@props(['product'])

<div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card-coffee transition-all">

    {{-- 1. Image Area --}}
    <div class="position-relative overflow-hidden bg-black bg-opacity-20">
        {{-- Badges --}}
        <div class="position-absolute top-0 start-0 m-3 d-flex flex-column gap-2" style="z-index: 5;">
            @if($product->has_discount)
            <span
                class="badge bg-coffee-accent rounded-pill px-3 shadow-glow-coffee fw-bold text-dark animate__animated animate__fadeInDown">
                -{{ $product->discount_percentage }}%
            </span>
            @endif
        </div>

        {{-- Wishlist Button (Glass Style) --}}
        <button type="button" onclick="toggleWishlist({{ $product->id }})"
            class="wishlist-btn-{{ $product->id }} btn-wishlist-coffee position-absolute top-0 end-0 m-3 rounded-circle d-flex align-items-center justify-content-center"
            style="z-index: 5;">
            <i
                class="bi {{ Auth::check() && Auth::user()->hasInWishlist($product) ? 'bi-heart-fill text-danger' : 'bi-heart text-white' }} fs-5"></i>
        </button>

        {{-- Product Image --}}
        <a href="{{ route('catalog.show', $product->slug) }}" class="d-block">
            <div class="img-overlay"></div>
            <img src="{{ $product->image_url }}" class="card-img-top transition-transform duration-500 scale-hover"
                alt="{{ $product->name }}" style="height: 260px; object-fit: cover;">
        </a>
    </div>

    {{-- 2. Card Body (Glassmorphism Content) --}}
    <div class="card-body p-4 d-flex flex-column bg-glass-content">
        {{-- Category --}}
        <div class="mb-2">
            <small class="text-coffee-light fw-bold text-uppercase tracking-widest" style="font-size: 0.65rem;">
                <i class="bi bi-tag-fill me-1"></i> {{ $product->category->name }}
            </small>
        </div>

        {{-- Product Name --}}
        <h5 class="card-title mb-3">
            <a href="{{ route('catalog.show', $product->slug) }}"
                class="text-white text-decoration-none fw-bold lh-base opacity-hover serif-font">
                {{ Str::limit($product->name, 35) }}
            </a>
        </h5>

        {{-- Price & Action --}}
        <div
            class="mt-auto pt-3 border-top border-white border-opacity-10 d-flex align-items-center justify-content-between">
            <div class="price-section">
                @if($product->has_discount)
                <small class="text-white-50 text-decoration-line-through d-block mb-0" style="font-size: 0.75rem;">
                    {{ $product->formatted_original_price }}
                </small>
                <span class="fs-5 fw-bolder text-coffee-accent d-block">{{ $product->formatted_price }}</span>
                @else
                <span class="fs-5 fw-bolder text-white d-block">{{ $product->formatted_price }}</span>
                @endif
            </div>

            <div class="action-section">
                <a href="{{ route('catalog.show', $product->slug) }}"
                    class="btn-detail-coffee rounded-pill shadow-glow-coffee">
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Artisan Coffee Card Core */
    .product-card-coffee {
        background: rgba(255, 255, 255, 0.03) !important;
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(212, 163, 115, 0.15) !important;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .product-card-coffee:hover {
        transform: translateY(-10px);
        border-color: rgba(212, 163, 115, 0.4) !important;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6) !important;
    }

    /* Image Effects */
    .scale-hover {
        transition: transform 0.8s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .product-card-coffee:hover .scale-hover {
        transform: scale(1.1);
    }

    .img-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, transparent 60%, rgba(12, 8, 5, 0.8));
        z-index: 2;
    }

    /* Buttons & Accents */
    .btn-wishlist-coffee {
        background: rgba(12, 8, 5, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(8px);
        width: 40px;
        height: 40px;
        transition: all 0.3s ease;
    }

    .btn-wishlist-coffee:hover {
        background: rgba(212, 163, 115, 0.3);
        transform: scale(1.1);
        border-color: #d4a373;
    }

    .btn-detail-coffee {
        background: #d4a373;
        color: #0c0805;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-detail-coffee:hover {
        background: #faedcd;
        transform: translateX(3px) rotate(-10deg);
        color: #0c0805;
    }

    /* Colors & Typography */
    .text-coffee-light {
        color: rgba(212, 163, 115, 0.7) !important;
    }

    .text-coffee-accent {
        color: #d4a373 !important;
    }

    .bg-coffee-accent {
        background-color: #d4a373 !important;
    }

    .shadow-glow-coffee {
        box-shadow: 0 0 15px rgba(212, 163, 115, 0.3);
    }

    .serif-font {
        font-family: 'Playfair Display', serif;
    }
</style>