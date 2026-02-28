<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::select([
            'id', 'firstName', 'lastName', 'email', 'isActive'
        ])->with('restaurants')->get();
    }

    public function show(string $id)
    {
        $user = User::select([
            'id', 'firstName', 'lastName', 'email', 'isActive', 'roleId', 'planId'
        ])->where('id', (int) $id)->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        return $user;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'planId' => 'required|integer',
            'restaurants' => 'required|array',
            'restaurants.*.name' => 'required|string',
            'restaurants.*.city' => 'required|string',
            'restaurants.*.cuisine' => 'required|string',
            'restaurants.*.address' => 'required|string',
            'restaurants.*.zipCode' => 'required|string|max:10',
            'restaurants.*.countryCode' => 'required|string|uppercase|min:2|max:2',
        ]);

        if(!Plan::find($data['planId'])) {
            return response()->json([
                'message' => 'Plan not found'
            ], 404);
        }

        $user = User::create($data);
        $user->restaurants()->createMany($data['restaurants']);
        $user->load('restaurants');

        return $user;
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'isActive' => 'required|boolean'
        ]);
        $user = User::find((int) $id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        $user->update($data);

        return $user;
    }
}
