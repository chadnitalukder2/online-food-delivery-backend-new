<?php

namespace App\Http\Controllers;

use App\Collections\ReviewCollection;
use App\Http\Requests\ReviewsRequest;
use App\Http\Resources\ReviewsResource;
use App\Services\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected $ReviewService;

    public function __construct()
    {
        $this->ReviewService = new ReviewService();
    }

    // Get all menus with optional filtering and pagination
    public function index(Request $request)
    {
        $filters = $request->only(['rating']);
        $menus = $this->ReviewService->getFilteredReviews($filters);
        return new ReviewCollection($menus);
    }

    public function show($id)
    {
        $menu = $this->ReviewService->getReviewById($id);
        return new ReviewsResource($menu);
    }

    public function store(ReviewsRequest $request)
    {
        $menu = $this->ReviewService->createReview($request->validated());
        return new ReviewsResource($menu);
    }


    public function update(ReviewsRequest $request, $id)
    {
        $delivery = $this->ReviewService->getReviewById($id);
        $updatedDelivery = $this->ReviewService->updateReview($delivery, $request->validated());
        return new ReviewsResource($updatedDelivery);
    }

    public function destroy($id)
    {
        $delivery = $this->ReviewService->getReviewById($id);
        $this->ReviewService->deleteReview($delivery);
        return response()->json(null, 204);
    }

}
