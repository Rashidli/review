<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThingService extends Model
{

    use HasFactory, SoftDeletes;

    public function things()
    {
        return $this->belongsToMany(Thing::class,'thing_prices')->withPivot('min_price', 'max_price');
    }

}
