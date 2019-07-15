<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable=['brand_name','user_id','category_id'];
    public function product(){
     return $this->hasMany(Product::class);
   }
   public function category(){
    return $this->belongsToMany(Category::class);
}
   public function user(){
    return $this->belongsTo(Category::class);
   }
}
