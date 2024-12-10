<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'state',
        'city',
        'street_address',
        'postal_code',
        'phone',
        'email',
        'amount',
        'stripe_charge_id',
    ];
    public function viewMenu()
    {
        return $this->belongsTo(ViewMenu::class, 'view_menu_id');
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}