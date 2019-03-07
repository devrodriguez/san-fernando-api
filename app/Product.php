<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function dishes()
    {
        return $this->belongsToMany(Dish::class);
    }
}
