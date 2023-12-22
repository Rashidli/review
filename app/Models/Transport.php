<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transport extends Model
{
    use HasFactory, SoftDeletes;

    public function warehouses()
    {
        return $this->belongsToMany(TransportWarehouse::class, 'transport_prices')->withPivot('monthly_price', 'daily_price');
    }
}
