<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderService
{
    public function createOrder(User $user, array $shippingData): Order
    {
        $cart = $user->cart;

        if (!$cart || $cart->items->isEmpty()) {
            throw new \Exception("Keranjang belanja kosong.");
        }

        return DB::transaction(function () use ($user, $cart, $shippingData) {

            // A. VALIDASI STOK & HITUNG TOTAL
            $totalAmount = 0;

            foreach ($cart->items as $item) {
                if ($item->quantity > $item->product->stock) {
                    throw new \Exception(
                        "Stok produk {$item->product->name} tidak mencukupi."
                    );
                }

                $totalAmount += $item->price * $item->quantity;
            }

            // B. BUAT ORDER (HEADER)
            $order = Order::create([
                'user_id'           => $user->id,
    'order_number'      => 'ORD-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6)),
    'shipping_name'     => $shippingData['name'],
    'shipping_phone'    => $shippingData['phone'],
    'shipping_address'  => $shippingData['address'],
    'total_amount'      => $totalAmount,
    'status'            => 'pending',
    'payment_status'    => 'unpaid',
            ]);

            // C. PINDAHKAN CART ITEMS → ORDER ITEMS
            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'price'      => $item->price,        // snapshot harga
                    'quantity'   => $item->quantity,
                    'subtotal'   => $item->price * $item->quantity,
                ]);

                // D. KURANGI STOK (AMAN)
                $item->product->decrement('stock', $item->quantity);
            }

            // E. KOSONGKAN KERANJANG
            $cart->items()->delete();

            return $order;
        });
    }
}
