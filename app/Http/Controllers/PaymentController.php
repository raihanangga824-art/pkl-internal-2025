<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\MidtransService;

class PaymentController extends Controller
{
    /**
     * API: Ambil Snap Token
     */
    public function getSnapToken(Order $order, MidtransService $midtransService)
    {
        // Pastikan order milik user
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Cek sudah dibayar
        if ($order->payment_status === 'paid') {
            return response()->json([
                'error' => 'Pesanan sudah dibayar.'
            ], 400);
        }

        try {
            $snapToken = $midtransService->createSnapToken($order);

            $order->update([
                'snap_token' => $snapToken
            ]);

            return response()->json([
                'token' => $snapToken
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Halaman redirect ketika pembayaran SUCCESS
     */
    public function success(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('orders.success', compact('order'));
    }

    /**
     * Halaman redirect ketika pembayaran PENDING
     */
    public function pending(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('orders.pending', compact('order'));
    }
}
