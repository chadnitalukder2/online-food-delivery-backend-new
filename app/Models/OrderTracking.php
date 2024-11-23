<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTracking extends Model
{
    /** @use HasFactory<\Database\Factories\OrderTrackingFactory> */
    use HasFactory;
    protected $guarded = [];

    public function openssl_private_decrypt()
    {
        return $this->belongsTo(Order::class);
    }
}
