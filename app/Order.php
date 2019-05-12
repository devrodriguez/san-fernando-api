<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['price', 'payment_method', 'carrier'];
    
    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'orders_details');
    }

    public function products() 
    {
        return $this->belongsToMany(Product::class, 'orders_details');
    }
}
