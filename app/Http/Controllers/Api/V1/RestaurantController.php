<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::with('reviews')->get()->map(function ($restaurant) {
            $restaurant->rating = $restaurant->reviews->avg('rating');
            $restaurant->makeHidden('reviews');
            return $restaurant;
        });

        return $restaurants;
    }
}
