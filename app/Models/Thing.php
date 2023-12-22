<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thing extends Model
{
    use HasFactory, SoftDeletes;

    public function thing_services()
    {
        return $this->belongsToMany(ThingService::class, 'thing_prices')->withPivot('min_price', 'max_price');
    }

}
