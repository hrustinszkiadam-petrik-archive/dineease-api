<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = null;

    protected $fillable = [
        'restaurantId', 'name', 'rating', 'comment'
    ];

    protected $casts = [
        'restaurantId' => 'integer',
        'rating' => 'float'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurantId');
    }
}
