<?php

namespace App\Http\Controllers;

use App\Collections\OrderTrackingCollection;
use App\Http\Requests\OrderTrackingsRequest;
use App\Http\Resources\OrderTrackingsResource;
use App\Services\OrderTrackingsService;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
    protected $OrderTrackingsService;

    public function __construct()
    {
        $this->OrderTrackingsService = new OrderTrackingsService();
    }

    // Get all orderTracking with optional filtering and pagination
    public function index(Request $request)
    {
        $filters = $request->only(['current_status', 'estimated_delivery_time']);
        $orderTracking = $this->OrderTrackingsService->getFilteredOrderTracking($filters);
        return new OrderTrackingCollection($orderTracking);
    }
    public function show($id){
        $orderTracking = $this->OrderTrackingsService->getOrderTrackingById($id);
        return new OrderTrackingsResource($orderTracking);
    }

    public function store(OrderTrackingsRequest $request)
    {
        $orderTracking = $this->OrderTrackingsService->createOrderTracking($request->validated());
        return new OrderTrackingsResource($orderTracking);
    }

    public function update(OrderTrackingsRequest $request, $id)
    {
        $orderTracking = $this->OrderTrackingsService->getOrderTrackingById($id);
        $updatedOrderTracking = $this->OrderTrackingsService->updateOrderTracking($orderTracking, $request->validated());
        return new OrderTrackingsResource($updatedOrderTracking);
    }

    public function destroy($id){
        $orderTracking = $this->OrderTrackingsService->getOrderTrackingById($id);
        $this->OrderTrackingsService->deleteOrderTracking($orderTracking);
        return response()->json(null, 204);
    }

}
