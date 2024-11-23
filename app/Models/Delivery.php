<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    /** @use HasFactory<\Database\Factories\DeliveryFactory> */
    use HasFactory;
    protected $guarded = [];

    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function DeliveryPersonnel(){
        return $this->belongsTo(DeliveryPersonnel::class);
    }
}
