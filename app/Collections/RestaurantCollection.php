<?php

namespace App\Collections;
use Illuminate\Support\Collection;

class RestaurantCollection extends Collection
{
 /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(): array
    {
        return [
            'Restaurants' => $this->collection,
            'menu_meta' => [
                'count' => $this->count(),
            ]
        ];
    }


}
