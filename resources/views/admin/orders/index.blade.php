@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Order</h1>

    @if($orders->isEmpty())
    <div class="alert alert-info">
        Belum ada order.
    </div>
    @else
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Order Number</th>
                <th>Pelanggan</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $index => $order)
            <tr>
                <td>{{ $orders->firstItem() + $index }}</td>
                <td>{{ $order->order_number }}</td>
                <td>{{ $order->shipping_name }}</td>
                <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                <td>{{ ucfirst($order->status) }}</td>
                <td>{{ $order->created_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
    @endif
</div>
@endsection