<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['code', 'name', 'description', 'price', 'img_url'];

    public function dishes()
    {
        return $this->belongsToMany(Dish::class);
    }
}
