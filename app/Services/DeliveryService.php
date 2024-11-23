<?php

namespace App\Services;

use App\Models\Delivery;
use GuzzleHttp\Psr7\Request;

class DeliveryService
{
    // Get all menus with optional filtering and pagination
    public function getFilteredDelivery(array $filters, $perPage = 10)
    {
        $query = Delivery::query();

        if (isset($filters['estimated_time'])) {
            $query->where('estimated_time', $filters['estimated_time']);
        }

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->get();
    }

    public function getDeliveryById($id)
    {
        return Delivery::findOrFail($id);
    }

    public function createDelivery(array $data)
    {
        return Delivery::create($data);
    }

    public function updateDelivery(Delivery $delivery, array $data)
    {
        $delivery->update($data);
        return $delivery;
    }

    public function deleteDelivery(Delivery $delivery)
    {
        $delivery->delete();
    }
}
