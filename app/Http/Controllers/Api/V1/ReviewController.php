<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        return Review::all()->setHidden(['createdAt']);
    }

    public function destroy(string $id)
    {
        if (!$review  = Review::find((int) $id)) {
            return response()->json([
                'message' => 'Review not found'
            ], 404);
        }

        $review->delete();
        return response()->noContent();
    }
}
