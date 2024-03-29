<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['category_name','user_id'];
    public function product(){
        return $this->hasMany(Product::class);
    }
    public function brands(){
        return $this->hasMany(Brand::class);
    }
}
