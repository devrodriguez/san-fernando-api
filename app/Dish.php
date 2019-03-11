<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = ['name', 'price'];
    
    public function products()
    {
        return $this->belongsToMany(Product::class, 'dishes_detail')->as('dishes_detail')->withTimestamps();
    }

    public function orders() {
        return $this->belongsToMany(Order::class);
    }
}
