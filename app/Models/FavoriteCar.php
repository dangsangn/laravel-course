<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteCar extends Model
{
    protected $fillable = [
        'car_id',
        'user_id',
    ];
}
