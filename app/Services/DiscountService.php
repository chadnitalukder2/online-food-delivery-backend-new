<?php

namespace App\Services;

use App\Models\Discount;
use GuzzleHttp\Psr7\Request;

class DiscountService
{
    // Get all discounts with optional filtering and pagination
    public function getDiscount()
    {
        $query = Discount::query();
        return $query->get();
    }

    public function getDiscountById($id)
    {
        return Discount::findOrFail($id);
    }

    public function createDiscount(array $data)
    {
        return Discount::create($data);
    }

    public function updatedDiscount(Discount $discount, array $data)
    {
        $discount->update($data);
        return $discount;
    }

    public function deleteDiscount(Discount $discount)
    {
        $discount->delete();
    }
}
