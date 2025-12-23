@extends('layouts.admin')

@section('title', 'Daftar Pesanan')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">
            <i class="bi bi-receipt me-2 text-primary"></i>
            Daftar Pesanan
        </h2>
    </div>

    {{-- Alert --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- Table --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <div class="fw-semibold">{{ $order->user->name }}</div>
                                <small class="text-muted">{{ $order->user->email }}</small>
                            </td>

                            <td class="fw-semibold">
                                Rp {{ number_format($order->total, 0, ',', '.') }}
                            </td>

                            <td>
                                @php
                                switch ($order->status) {
                                case 'pending':
                                $statusColor = 'warning';
                                break;
                                case 'paid':
                                $statusColor = 'info';
                                break;
                                case 'shipped':
                                $statusColor = 'primary';
                                break;
                                case 'completed':
                                $statusColor = 'success';
                                break;
                                case 'cancelled':
                                $statusColor = 'danger';
                                break;
                                default:
                                $statusColor = 'secondary';
                                }
                                @endphp

                                <span class="badge bg-{{ $statusColor }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>

                            <td>
                                {{ $order->created_at->format('d M Y') }}
                            </td>

                            <td class="text-center">
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada pesanan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>

</div>
@endsection