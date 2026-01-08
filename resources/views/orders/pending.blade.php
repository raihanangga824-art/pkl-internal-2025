<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 mb-0 text-dark">Status Pembayaran</h2>
    </x-slot>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    {{-- Progress Bar Sederhana --}}
                    <div class="progress rounded-0" style="height: 6px;">
                        <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated"
                            style="width: 50%"></div>
                    </div>

                    <div class="card-body p-5 text-center">
                        {{-- Icon Animasi --}}
                        <div class="mb-4">
                            <div class="display-1 text-warning animate__animated animate__pulse animate__infinite">
                                <i class="bi bi-clock-history"></i>
                            </div>
                        </div>

                        <h3 class="fw-bold mb-2">Menunggu Pembayaran</h3>
                        <p class="text-muted mb-4 px-lg-5">
                            Segera selesaikan pembayaran untuk pesanan <span class="badge bg-light text-dark border">#{{
                                $order->order_number }}</span> agar kami dapat segera memproses produk Anda.
                        </p>

                        {{-- Info Nominal & Deadline --}}
                        <div class="bg-light rounded-4 p-4 mb-4 border-dashed">
                            <div class="row g-3">
                                <div class="col-6 text-start border-end">
                                    <small class="text-muted d-block text-uppercase fw-bold">Total Tagihan</small>
                                    <span class="fs-4 fw-bold text-primary">Rp {{ number_format($order->total_amount, 0,
                                        ',', '.') }}</span>
                                </div>
                                <div class="col-6 text-start ps-4">
                                    <small class="text-muted d-block text-uppercase fw-bold">Batas Waktu</small>
                                    <span class="fs-5 fw-bold text-dark">{{ $order->created_at->addDay()->format('d M Y,
                                        H:i') }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                            <a href="{{ route('orders.show', $order) }}"
                                class="btn btn-primary btn-lg px-4 rounded-pill shadow-sm">
                                <i class="bi bi-receipt me-2"></i> Instruksi Pembayaran
                            </a>
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg px-4 rounded-pill">
                                Belanja Lagi
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Tips Keamanan --}}
                <div class="text-center mt-4 text-muted small">
                    <p><i class="bi bi-shield-check me-1 text-success"></i> Transaksi Anda aman dan terenkripsi.</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        .border-dashed {
            border: 2px dashed #dee2e6;
        }

        .animate__pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>
</x-app-layout>