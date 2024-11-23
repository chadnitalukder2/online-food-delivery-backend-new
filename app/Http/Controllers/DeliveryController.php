<?php

namespace App\Http\Controllers;

use App\Collections\DeliveryCollection;
use App\Http\Requests\DeliveriesRequest;
use App\Http\Resources\DeliveriesResource;
use App\Services\DeliveryService;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    protected $DeliveryService;

    public function __construct()
    {
        $this->DeliveryService = new DeliveryService();
    }

    // Get all menus with optional filtering and pagination
    public function index(Request $request)
    {
        $filters = $request->only(['estimated_time', 'status']);
        $delivery = $this->DeliveryService->getFilteredDelivery($filters);
        return new DeliveryCollection($delivery);
    }
    public function show($id){
        $delivery = $this->DeliveryService->getDeliveryById($id);
        if (!$delivery) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        return new DeliveriesResource($delivery);
    }

    public function store(DeliveriesRequest $request)
    {
        $order = $this->DeliveryService->createDelivery($request->validated());
        return new DeliveriesResource($order);
    }

    public function update(DeliveriesRequest $request, $id)
    {
        $delivery = $this->DeliveryService->getDeliveryById($id);
        $updatedDelivery = $this->DeliveryService->updateDelivery($delivery, $request->validated());
        return new DeliveriesResource($updatedDelivery);
    }

    public function destroy($id){
        $delivery = $this->DeliveryService->getDeliveryById($id);
        $this->DeliveryService->deleteDelivery($delivery);
        return response()->json(null, 204);
    }

}
