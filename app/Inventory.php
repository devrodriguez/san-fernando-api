<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public function products() 
    {
        return $this->belongsToMany(Product::class, 'inventories_detail')
        ->withPivot('inventory_id', 'product_id', 'available_amount')
        ->withTimestamps();
    }
}
