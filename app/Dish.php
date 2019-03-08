<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class, 'dishes_detail');
    }

    public function orders() {
        return $this->belongsToMany(Order::class);
    }
}
