<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    use HasFactory, SoftDeletes;

    protected $guarded = [];

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

    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }
    public function order_images()
    {
        return $this->hasMany(OrderImage::class);
    }
    public function order_stores()
    {
        return $this->hasMany(OrderStore::class);
    }

    public function order_kv_stores()
    {
        return $this->hasMany(OrderKvStore::class);
    }

}
