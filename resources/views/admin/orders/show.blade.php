<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Pesanan
        </h2>
    </x-slot>

    <style>
        .card {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .06);
            overflow: hidden;
        }

        .section {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .section:last-child {
            border-bottom: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f9fafb;
        }

        th {
            padding: .75rem 1rem;
            font-size: .75rem;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: .05em;
            border-bottom: 2px solid #e5e7eb;
        }

        td {
            padding: 1rem;
            font-size: .875rem;
            color: #1f2937;
            border-bottom: 1px solid #f3f4f6;
        }

        td.text-right {
            text-align: right
        }

        td.text-center {
            text-align: center
        }

        tfoot td {
            font-weight: 800;
            font-size: 1rem;
            border-bottom: none;
        }

        .status {
            padding: .45rem 1.2rem;
            border-radius: 9999px;
            font-size: .7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .pending {
            background: #fef3c7;
            color: #92400e
        }

        .processing {
            background: #dbeafe;
            color: #1e40af
        }

        .shipped {
            background: #ede9fe;
            color: #5b21b6
        }

        .delivered {
            background: #dcfce7;
            color: #166534
        }

        .cancelled {
            background: #fee2e2;
            color: #991b1b
        }

        .summary {
            background: linear-gradient(135deg, #eef2ff, #f5f3ff);
            border-radius: .75rem;
            padding: 1.25rem;
        }

        #pay-button {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: #fff;
            padding: .85rem 2.5rem;
            border-radius: .75rem;
            font-weight: 800;
            font-size: 1rem;
            transition: .25s;
        }

        #pay-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(79, 70, 229, .3);
        }

        @media(max-width:640px) {
            thead {
                display: none
            }

            tr {
                display: block;
                margin-bottom: 1rem
            }

            td {
                display: flex;
                justify-content: space-between;
                padding: .75rem 0;
            }

            td::before {
                content: attr(data-label);
                font-weight: 600;
                color: #6b7280;
            }
        }
    </style>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4">

            <div class="card">

                {{-- HEADER --}}
                <div class="section flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-extrabold text-gray-900">
                            Order #{{ $order->order_number }}
                        </h1>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ $order->created_at->format('d M Y • H:i') }}
                        </p>
                    </div>

                    <span class="status {{ $order->status }}">
                        {{ $order->status }}
                    </span>
                </div>

                {{-- SUMMARY --}}
                <div class="section">
                    <div class="summary flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600">Total Pembayaran</p>
                            <p class="text-2xl font-extrabold text-indigo-600">
                                Rp {{ number_format($order->total_amount,0,',','.') }}
                            </p>
                        </div>
                        <div class="text-right text-sm text-gray-500">
                            <p>{{ $order->items->count() }} Produk</p>
                        </div>
                    </div>
                </div>

                {{-- ITEMS --}}
                <div class="section">
                    <h3 class="font-bold mb-4">Produk Dipesan</h3>

                    <table>
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th class="text-center">Qty</th>
                                <th class="text-right">Harga</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td data-label="Produk">{{ $item->product_name }}</td>
                                <td data-label="Qty" class="text-center">{{ $item->quantity }}</td>
                                <td data-label="Harga" class="text-right">
                                    Rp {{ number_format($item->price,0,',','.') }}
                                </td>
                                <td data-label="Subtotal" class="text-right font-semibold">
                                    Rp {{ number_format($item->subtotal,0,',','.') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- SHIPPING --}}
                <div class="section bg-gray-50">
                    <h3 class="font-bold mb-2">Alamat Pengiriman</h3>
                    <p class="font-medium">{{ $order->shipping_name }}</p>
                    <p class="text-sm text-gray-600">{{ $order->shipping_phone }}</p>
                    <p class="text-sm text-gray-600">{{ $order->shipping_address }}</p>
                </div>

                {{-- PAY --}}
                @if($order->status === 'pending' && $order->snap_token)
                <div class="section text-center bg-indigo-50">
                    <button id="pay-button">💳 Bayar Sekarang</button>
                </div>
                @endif

            </div>
        </div>
    </div>

    {{-- MIDTRANS --}}
    @if($order->snap_token)
    @push('scripts')
    <script src="{{ config('midtrans.snap_url') }}" data-client-key="{{ config('midtrans.client_key') }}"></script>

    <script>
        document.getElementById('pay-button')?.addEventListener('click', () => {
            snap.pay('{{ $order->snap_token }}');
        });
    </script>
    @endpush
    @endif
</x-app-layout>