<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory, SoftDeletes;

    public function directions()
    {
        return $this->belongsToMany(Direction::class, 'direction_prices')->withPivot('min_price', 'max_price');
    }

    public function regions()
    {
        return $this->belongsToMany(Region::class, 'region_prices')->withPivot('min_price', 'max_price');
    }
}
