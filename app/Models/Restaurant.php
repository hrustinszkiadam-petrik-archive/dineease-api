<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'city', 'cuisine', 'address', 'zipCode', 'countryCode', 'description', 'imageUrl'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class, 'restaurantId');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'userRestaurant', 'restaurantId', 'userId');
    }
}
