<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'monthlyFee', 'yearlyFee', 'maxNumberOfRestaurants', 'description'
    ];

    protected $casts = [
        'monthlyFee' => 'float',
        'yearlyFee' => 'float',
        'maxNumberOfRestaurants' => 'integer'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'planId');
    }
}
