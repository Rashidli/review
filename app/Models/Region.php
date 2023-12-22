<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use HasFactory, SoftDeletes;

    public function region_cars()
    {
        return $this->belongsToMany(Car::class, 'region_prices')->withPivot('min_price','max_price');
    }
}
