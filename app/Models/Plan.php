<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasFactory,SoftDeletes;

    public function warehouses()
    {
        return $this->belongsToMany(PlanWarehouse::class, 'plan_prices')->withPivot('monthly_price', 'daily_price','monthly_price_per_square_meter','daily_price_per_square_meter');
    }
}
