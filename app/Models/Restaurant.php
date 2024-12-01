<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    /** @use HasFactory<\Database\Factories\RestaurantFactory> */
    use HasFactory;
    protected $guarded = [];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
   
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
