<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Model extends EloquentModel
{
    protected $fillable = [
        'name',
        'maker_id',
    ];

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
