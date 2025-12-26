<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi via mass assignment
     */
    protected $fillable = [
        'name',
        'user_id',
        'order_number',
        'shipping_name',
        'shipping_phone',
        'shipping_address',
        'total_amount',
        'status',
        'payment_status',
    ];

    /**
     * Default value saat create()
     */
    protected $attributes = [
        'status' => 'pending',
    ];

    /**
     * Relasi: Order dimiliki oleh satu User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Order memiliki banyak OrderItem
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Helper: Hitung total dari item (opsional)
     */
    public function getCalculatedTotalAttribute()
    {
        return $this->items->sum('subtotal');
    }
}
