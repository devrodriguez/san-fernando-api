<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['code', 'name', 'description', 'price_per_unit', 'image_url'];

    public function dishes()
    {
        return $this->belongsToMany(Dish::class);
    }
}
