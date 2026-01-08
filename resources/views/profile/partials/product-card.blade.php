{{-- Product Card: Artisan Coffee Glassmorphism --}}
<div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card-coffee transition-all">

    {{-- 1. Image Area --}}
    <div class="position-relative overflow-hidden bg-black bg-opacity-20">
        {{-- Badges --}}
        <div class="position-absolute top-0 start-0 m-3 d-flex flex-column gap-2" style="z-index: 5;">
            @if($product->has_discount)
            <span class="badge bg-coffee-accent rounded-pill px-3 shadow-glow-coffee fw-bold text-dark">
                -{{ $product->discount_percentage }}%
            </span>
            @endif
        </div>

        {{-- Wishlist --}}
        @auth
        <button type="button" onclick="toggleWishlist({{ $product->id }})"
            class="btn-wishlist-coffee position-absolute top-0 end-0 m-3 rounded-circle d-flex align-items-center justify-content-center"
            style="z-index: 5;">
            <i
                class="bi {{ auth()->user()->hasInWishlist($product) ? 'bi-heart-fill text-danger' : 'bi-heart text-white' }}"></i>
        </button>
        @endauth

        <a href="{{ route('catalog.show', $product->slug) }}" class="d-block">
            <img src="{{ $product->image_url }}" class="card-img-top transition-transform duration-500 scale-hover"
                alt="{{ $product->name }}" style="height: 240px; object-fit: cover;">
        </a>
    </div>

    {{-- 2. Card Body --}}
    <div class="card-body p-3 d-flex flex-column">
        {{-- Category --}}
        <small class="text-coffee-light fw-bold text-uppercase mb-1 tracking-wider" style="font-size: 0.65rem;">
            <i class="bi bi-tag-fill me-1"></i> {{ $product->category->name }}
        </small>

        {{-- Product Name --}}
        <h6 class="card-title mb-3">
            <a href="{{ route('catalog.show', $product->slug) }}"
                class="text-white text-decoration-none fw-bold lh-base stretched-link opacity-hover serif-font">
                {{ Str::limit($product->name, 40) }}
            </a>
        </h6>

        {{-- Stok Tipis Indicator --}}
        @if($product->stock <= 5 && $product->stock > 0)
            <div class="mb-3">
                <div class="progress bg-white bg-opacity-10" style="height: 4px;">
                    <div class="progress-bar bg-coffee-accent shadow-glow-coffee" role="progressbar" style="width: 45%">
                    </div>
                </div>
                <small class="text-coffee-accent mt-1 d-block fw-semibold" style="font-size: 0.7rem;">Sisa {{
                    $product->stock }} cup terakhir</small>
            </div>
            @endif

            {{-- 3. Bottom Row: Price and Action --}}
            <div class="mt-auto pt-3 border-top border-white border-opacity-10 d-flex align-items-center justify-content-between"
                style="position: relative; z-index: 10;">
                <div class="price-section">
                    @if($product->has_discount)
                    <small class="text-white-50 text-decoration-line-through d-block" style="font-size: 0.75rem;">
                        {{ $product->formatted_original_price }}
                    </small>
                    @endif
                    <span class="fs-5 fw-bolder text-coffee-light d-block">{{ $product->formatted_price }}</span>
                </div>

                <div class="action-section">
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">

                        @if($product->stock > 0)
                        <button type="submit"
                            class="btn btn-coffee-accent rounded-circle shadow-glow-coffee d-flex align-items-center justify-content-center transition-up"
                            style="width: 42px; height: 42px;" title="Tambah ke Keranjang">
                            <i class="bi bi-plus-lg text-dark fs-5"></i>
                        </button>
                        @else
                        <button type="button" class="btn btn-outline-light rounded-circle disabled border-opacity-25"
                            style="width: 42px; height: 42px;">
                            <i class="bi bi-dash-circle text-white-50"></i>
                        </button>
                        @endif
                    </form>
                </div>
            </div>
    </div>
</div>

<style>
    /* Artisan Coffee Card Styling */
    .product-card-coffee {
        background: rgba(255, 255, 255, 0.03) !important;
        backdrop-filter: blur(15px);
        border: 1px solid rgba(212, 163, 115, 0.1) !important;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .product-card-coffee:hover {
        background: rgba(212, 163, 115, 0.08) !important;
        transform: translateY(-8px);
        border-color: rgba(212, 163, 115, 0.3) !important;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4) !important;
    }

    /* Wishlist Button */
    .btn-wishlist-coffee {
        background: rgba(26, 15, 10, 0.4);
        border: 1px solid rgba(212, 163, 115, 0.2);
        backdrop-filter: blur(8px);
        width: 38px;
        height: 38px;
        transition: all 0.3s;
    }

    .btn-wishlist-coffee:hover {
        background: rgba(212, 163, 115, 0.3);
        transform: scale(1.15);
    }

    /* Coffee Colors & Glows */
    .text-coffee-light {
        color: #d4a373 !important;
    }

    .bg-coffee-accent {
        background-color: #d4a373 !important;
    }

    .text-coffee-accent {
        color: #d4a373 !important;
    }

    .shadow-glow-coffee {
        box-shadow: 0 0 15px rgba(212, 163, 115, 0.3);
    }

    /* Visual Effects */
    .scale-hover {
        transition: transform 0.7s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .product-card-coffee:hover .scale-hover {
        transform: scale(1.08);
    }

    /* Cart Button Animation */
    .btn-coffee-accent {
        border: none;
        transition: all 0.3s ease;
    }

    .btn-coffee-accent:hover {
        background-color: #faedcd !important;
        transform: rotate(90deg);
    }

    .serif-font {
        font-family: 'Playfair Display', serif;
    }
</style>