<?php

namespace App\Http\Controllers;

use App\Collections\OrderCollection;
use App\Http\Requests\OrdersRequest;
use App\Http\Resources\OrdersResource;
use App\Models\Cart;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $filters = $request->only(['total_amount', 'status', 'payment_status', 'delivery_address']);
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

    public function store(Request $request)
    {
        $orderItemsIds = $request->order_items_id;
      
        DB::beginTransaction();
        try {
            $orders = new Order([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'delivery_address' => $request->input('delivery_address'),
                'phone' => $request->input('phone'),
                'total_amount' => $request->input('total_amount'),
                'user_id' => $request->input('user_id'),
            ]);
    
            $orders->save();
            $order_id = $orders->id;
    
            foreach ($orderItemsIds as $orderItemsId) {
                $orderItem = Cart::find($orderItemsId);
                $orderItem->order_id = $order_id;
                $orderItem->status = 'ordered';
                $orderItem->save();
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage() ], 500);
        }
        
    
        return response()->json([
            'message' => 'orders added successfully',
        ], 201);
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

    public function ordersByRestaurant(Request $request)
    {
        $validated = $request->validate([
            'restaurant_ids' => 'required|array',
            'restaurant_ids.*' => 'integer|exists:restaurants,id',
        ]);

        try {
            $orders = Cart::whereIn('restaurant_id', $validated['restaurant_ids'])->get();

            if ($orders->isEmpty()) {
                return response()->json(['message' => 'No orders found for these restaurants.'], 404);
            }

            return response()->json($orders, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch orders.', 'details' => $e->getMessage()], 500);
        }
    }


}
