<?php

namespace App\Http\Controllers;

use App\Collections\OrderCollection;
use App\Http\Requests\OrdersRequest;
use App\Http\Resources\OrdersResource;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $OrderService;

    public function __construct()
    {
        $this->OrderService = new OrderService();
    }

    // Get all menus with optional filtering and pagination
    public function index(Request $request)
    {
        $filters = $request->only(['total_amount', 'status', 'payment_method', 'order_date', 'delivery_address']);
        $menus = $this->OrderService->getFilteredOrder($filters);
        return new OrderCollection($menus);
    }
    public function show($id){
        $order = $this->OrderService->getOrderById($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        return new OrdersResource($order);
    }

    public function store(OrdersRequest $request)
    {
        $order = $this->OrderService->createOrder($request->validated());
        return new OrdersResource($order);
    }

    public function update(OrdersRequest $request, $id)
    {
        $order = $this->OrderService->getOrderById($id);
        $updatedOrder = $this->OrderService->updateOrder($order, $request->validated());
        return new OrdersResource($updatedOrder);
    }

    public function destroy($id){
        $order = $this->OrderService->getOrderById($id);
        $this->OrderService->deleteOrder($order);
        return response()->json(null, 204);
    }

}
