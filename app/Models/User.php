<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'firstName', 'lastName', 'email', 'password', 'roleId', 'planId', 'annualPayment', 'isActive'
    ];

    protected $casts = [
        'password' => 'hashed',
        'roleId' => 'integer',
        'planId' => 'integer',
        'annualPayment' => 'boolean',
        'isActive' => 'boolean',
    ];

    protected $hidden = [
        'password'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'roleId');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'planId');
    }

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'userRestaurant', 'userId', 'restaurantId');
    }
}
