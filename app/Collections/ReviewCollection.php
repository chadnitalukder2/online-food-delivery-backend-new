<?php

namespace App\Collections;
use Illuminate\Support\Collection;

class ReviewCollection extends Collection
{
 /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(): array
    {
       
        return [
            'Reviews' => $this->collection,
            'review_meta' => [
                // 'total' => $this->total(),
                'count' => $this->count(),
                // 'current_page' => $this->currentPage(),
                // 'last_page' => $this->lastPage(),
            ]
        ];

    }


}
