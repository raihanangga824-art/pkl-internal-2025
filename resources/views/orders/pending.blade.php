<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 mb-0">Menunggu Pembayaran</h2>
    </x-slot>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">

                <div class="card shadow-sm">
                    <div class="card-body py-5">
                        <h1 class="text-warning mb-3">⏳</h1>

                        <h4 class="fw-bold mb-2">
                            Pembayaran Belum Selesai
                        </h4>

                        <p class="text-muted mb-4">
                            Pembayaran untuk pesanan
                            <strong>#{{ $order->order_number }}</strong>
                            masih menunggu konfirmasi.
                        </p>

                        <a href="{{ route('orders.show', $order) }}" class="btn btn-primary px-4">
                            Kembali ke Detail Pesanan
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>