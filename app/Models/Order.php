<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function order_directions()
    {
        return $this->hasMany(OrderDirection::class);
    }

    public function order_masters(){
        return $this->hasMany(OrderMaster::class);
    }

    public function order_workers()
    {
        return $this->hasMany(OrderWorker::class);
    }

}
