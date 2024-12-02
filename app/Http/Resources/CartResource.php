<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id ,
            'restaurant_id' => $this->restaurant_id ,
            'menu_id' => $this->menu_id,
            'quantity' => $this->quantity,
            'line_total' => $this->line_total,
            'status' => $this->status,
            'menu' => $this->menu,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
