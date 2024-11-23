<?php

namespace App\Services;

use App\Models\Review;
use GuzzleHttp\Psr7\Request;

class ReviewService
{
    // Get all Reviews with optional filtering and pagination
    public function getFilteredReviews(array $filters, $perPage = 10)
    {
        $query = Review::query();

        if (isset($filters['rating'])) {
            $query->where('rating', $filters['rating']);
        }

        return $query->get();
    }

    public function getReviewById($id)
    {
        return Review::findOrFail($id);
    }

    public function createReview(array $data)
    {
        return Review::create($data);
    }

    public function updateReview(Review $review, array $data)
    {
        $review->update($data);
        return $review;
    }

    public function deleteReview(Review $review)
    {
        $review->delete();
    }
}
