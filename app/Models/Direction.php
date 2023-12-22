<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Direction extends Model
{
    use HasFactory, SoftDeletes;

    public function direction_cars(){
        return $this->belongsToMany(Car::class, 'direction_prices')->withPivot('min_price', 'max_price');
    }
}
