<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan untuk admin.
     * Dilengkapi filter by status.
     */
    public function index(Request $request)
    {
        $orders = Order::query()
            ->with('user') // N+1 prevention: Load data user pemilik order
            // Fitur Filter Status (?status=pending)
            ->when($request->status, function ($q, $status) {
                $q->where('status', $status);
            })
            ->latest() // Urutkan terbaru
            ->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Detail order untuk admin.
     */
    public function show(Order $order)
    {
        // Load item produk dan data user
        $order->load(['items.product', 'user']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update status pesanan (misal: kirim barang)
     * Handle otomatis pengembalian stok jika status diubah jadi Cancelled.
     */
    public function updateStatus(Request $request, Order $order)
{
    $request->validate([
        'status' => [
            'required',
            Rule::in(['pending', 'processing', 'completed', 'cancelled']),
        ],
    ]);

    $oldStatus = $order->status;
    $newStatus = $request->status;

    // RESTOCK jika dibatalkan
    if ($newStatus === 'cancelled' && $oldStatus !== 'cancelled') {
        foreach ($order->items as $item) {
            $item->product->increment('stock', $item->quantity);
        }
    }

    $order->update([
        'status' => $newStatus,
    ]);

    return back()->with('success', 'Status pesanan berhasil diperbarui');
}
}