<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        return Plan::all();
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|string',
            'monthlyFee' => 'sometimes|numeric',
            'yearlyFee' => 'sometimes|numeric',
            'maxNumberOfRestaurants' => 'sometimes|integer',
            'description' => 'sometimes|string',
        ]);
        
        if (!$plan  = Plan::find((int) $id)) {
            return response()->json([
                'message' => 'Plan not found'
            ], 404);
        }

        $plan->update($data);

        return $plan;
    }
}
