<?php

namespace App\Http\Controllers;

use App\Collections\DiscountCollection;
use App\Http\Requests\DiscountsRequest;
use App\Http\Resources\DiscountsResource;
use App\Services\DiscountService;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    protected $DiscountService;

    public function __construct()
    {
        $this->DiscountService = new DiscountService();
    }

    public function index(Request $request)
    {
        $discount = $this->DiscountService->getDiscount();
        return new DiscountCollection($discount);
    }
    public function show($id){
        $discount = $this->DiscountService->getDiscountById($id);
        return new DiscountsResource($discount);
    }

    public function store(DiscountsRequest $request){
        $discount = $this->DiscountService->createDiscount($request->validated());
        return new DiscountsResource($discount);
    }

    public function update(DiscountsRequest $request, $id)
    {
        $discount = $this->DiscountService->getDiscountById($id);
    
        $updatedDiscount = $this->DiscountService->updatedDiscount($discount, $request->validated());
        return new DiscountsResource($updatedDiscount);
    }

    // Delete 
    public function destroy($id)
    {
        $discount = $this->DiscountService->getDiscountById($id);
        $this->DiscountService->deleteDiscount($discount);
        return response()->json(null, 204);
    }

}
