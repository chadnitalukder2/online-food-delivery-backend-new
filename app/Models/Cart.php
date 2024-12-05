<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;
    protected $guarded = [];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
