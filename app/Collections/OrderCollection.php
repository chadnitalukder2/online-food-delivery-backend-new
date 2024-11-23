<?php

namespace App\Collections;
use Illuminate\Support\Collection;

class OrderCollection extends Collection
{
 /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(): array
    {
       
        return [
            'Orders' => $this->collection,
            'order_meta' => [
                // 'total' => $this->total(),
                'count' => $this->count(),
                // 'current_page' => $this->currentPage(),
                // 'last_page' => $this->lastPage(),
            ]
        ];

    }


}
