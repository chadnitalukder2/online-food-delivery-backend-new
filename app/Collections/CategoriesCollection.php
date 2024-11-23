<?php

namespace App\Collections;
use Illuminate\Support\Collection;

class CategoriesCollection extends Collection
{
 /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(): array
    {
       
        return [
            'Categories' => $this->collection,
        ];
    }


}
