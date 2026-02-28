<?php

use App\Http\Controllers\Api\V1\PlanController;
use App\Http\Controllers\Api\V1\RestaurantController;
use App\Http\Controllers\Api\V1\ReviewController;
use App\Http\Controllers\Api\V1\RoleController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function() {
  Route::post('registration', [UserController::class, 'store']);
  Route::resource('users', UserController::class);
  Route::resource('restaurants', RestaurantController::class);
  Route::resource('plans', PlanController::class);
  Route::resource('roles', RoleController::class);
  Route::resource('reviews', ReviewController::class);
});