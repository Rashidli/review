<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportWarehouse extends Model
{
    use HasFactory;

    public function transports()
    {
        return $this->belongsToMany(Transport::class, 'transport_prices')->withPivot('monthly_price', 'daily_price');
    }
}
