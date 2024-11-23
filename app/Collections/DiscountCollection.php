<?php

namespace App\Collections;
use Illuminate\Support\Collection;

class DiscountCollection extends Collection
{
 /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(): array
    {
       
        return [
            'Discount' => $this->collection,
        ];
    }


}
