<?php

namespace App\Services;

use App\Models\OrderTracking;
use GuzzleHttp\Psr7\Request;

class OrderTrackingsService
{
    // Get all orders with optional filtering and pagination
    public function getFilteredOrderTracking(array $filters, $perPage = 10)
    {
        $query = OrderTracking::query();

        if (isset($filters['current_status'])) {
            $query->where('current_status', $filters['current_status']);
        }

        if (isset($filters['estimated_delivery_time'])) {
            $query->where('estimated_delivery_time', $filters['estimated_delivery_time']);
        }
       

        return $query->get();
    }

    public function getOrderTrackingById($id)
    {
        return OrderTracking::findOrFail($id);
    }

    public function createOrderTracking(array $data)
    {
        return OrderTracking::create($data);
    }

    public function updateOrderTracking(OrderTracking $orderTracking, array $data)
    {
        $orderTracking->update($data);
        return $orderTracking;
    }

    public function deleteOrderTracking(OrderTracking $orderTracking)
    {
        $orderTracking->delete();
    }
}
