<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'customer_name',
        'order_details',
        'total_amount',
        'status'
    ];

    protected $casts = [
        'order_details' => 'array',
        'total_amount' => 'decimal:2'
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function getFormattedOrderDetailsAttribute()
    {
        return collect($this->order_details)->map(function ($item) {
            return [
                'name' => $item['name'] ?? 'N/A',
                'quantity' => $item['quantity'] ?? 0,
                'price' => number_format($item['price'] ?? 0, 2)
            ];
        })->toArray();
    }

    public function getTotalQuantityAttribute()
    {
        return collect($this->order_details)->sum('quantity');
    }
}
