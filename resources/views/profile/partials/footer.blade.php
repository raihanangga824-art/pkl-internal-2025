{{-- ================================================
FILE: resources/views/partials/footer.blade.php
FUNGSI: Footer Premium RaihanCoffeeStore
================================================ --}}

<footer class="footer-premium pt-5 pb-3 mt-5">
    {{-- Dekorasi Cahaya Halus di Latar Belakang --}}
    <div class="footer-glow"></div>

    <div class="container position-relative" style="z-index: 2;">
        <div class="row g-4 mb-5">
            {{-- Brand & Deskripsi --}}
            <div class="col-lg-4 col-md-6" data-aos="fade-up">
                <h4 class="serif-font text-white mb-3">
                    Raihan<span class="text-coffee">Coffee</span>Store
                </h4>
                <p class="text-white-50 lh-lg">
                    Menghadirkan biji kopi pilihan dari petani lokal hingga mancanegara.
                    Kami percaya setiap cangkir memiliki cerita unik yang layak dinikmati dengan sempurna.
                </p>
                <div class="social-links d-flex gap-3 mt-4">
                    <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="col-lg-2 col-md-6 ms-lg-auto" data-aos="fade-up" data-aos-delay="100">
                <h6 class="text-white fw-bold mb-4 text-uppercase tracking-widest small">Eksplorasi</h6>
                <ul class="list-unstyled footer-list">
                    <li><a href="{{ route('catalog.index') }}">Katalog Produk</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Menu Spesial</a></li>
                    <li><a href="#">Lokasi Toko</a></li>
                </ul>
            </div>

            {{-- Help --}}
            <div class="col-lg-2 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <h6 class="text-white fw-bold mb-4 text-uppercase tracking-widest small">Bantuan</h6>
                <ul class="list-unstyled footer-list">
                    <li><a href="#">Cara Pemesanan</a></li>
                    <li><a href="#">Pengiriman</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <h6 class="text-white fw-bold mb-4 text-uppercase tracking-widest small">Hubungi Kami</h6>
                <div class="contact-info text-white-50">
                    <div class="d-flex mb-3 align-items-start">
                        <i class="bi bi-geo-alt text-coffee me-3 mt-1"></i>
                        <span>Jl. Premium Brewing No. 45, <br>Kota Bandung, Jawa Barat</span>
                    </div>
                    <div class="d-flex mb-3">
                        <i class="bi bi-telephone text-coffee me-3"></i>
                        <span>(022) 123-4567</span>
                    </div>
                    <div class="d-flex mb-3">
                        <i class="bi bi-envelope text-coffee me-3"></i>
                        <span>hello@raihancoffee.com</span>
                    </div>
                </div>
            </div>
        </div>

        <hr class="border-white border-opacity-10 my-4">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="text-white-50 mb-0 small">
                    &copy; {{ date('Y') }} <span class="text-white fw-bold">RaihanCoffeeStore</span>. Dibuat dengan <i
                        class="bi bi-heart-fill text-danger mx-1"></i> untuk pecinta kopi.
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <div class="payment-badges opacity-75">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" alt="Visa"
                        height="15" class="me-3 filter-white">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard"
                        height="20" class="me-3 filter-white">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/e/eb/Logo_ovo_purple.svg" alt="OVO"
                        height="18" class="me-3 filter-white">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/Logo_dana_blue.svg" alt="DANA"
                        height="18" class="filter-white">
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .footer-premium {
        background: linear-gradient(180deg, #1a0f0a 0%, #0d0805 100%);
        position: relative;
        overflow: hidden;
        border-top: 1px solid rgba(212, 163, 115, 0.1);
    }

    .footer-glow {
        position: absolute;
        top: -150px;
        right: -100px;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(212, 163, 115, 0.05) 0%, rgba(0, 0, 0, 0) 70%);
        border-radius: 50%;
        filter: blur(50px);
        pointer-events: none;
    }

    .text-coffee {
        color: #d4a373 !important;
    }

    .tracking-widest {
        letter-spacing: 0.15rem;
    }

    /* Social Icons */
    .social-icon {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(212, 163, 115, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #d4a373;
        border-radius: 50%;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .social-icon:hover {
        background: #d4a373;
        color: #1a0f0a;
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(212, 163, 115, 0.3);
    }

    /* Footer List Links */
    .footer-list li {
        margin-bottom: 12px;
    }

    .footer-list a {
        color: rgba(255, 255, 255, 0.5);
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .footer-list a:hover {
        color: #d4a373;
        padding-left: 8px;
    }

    /* Payment Logos Filter */
    .filter-white {
        filter: brightness(0) invert(1) opacity(0.6);
        transition: 0.3s;
    }

    .filter-white:hover {
        filter: brightness(0) invert(1) opacity(1);
    }

    .serif-font {
        font-family: 'Playfair Display', serif;
        /* Pastikan font ini di-import */
    }
</style>