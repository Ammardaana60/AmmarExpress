<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable=['brand_name','user_id','category_id'];
    protected $with=['products'];
    public function products(){
     return $this->hasMany(Product::class);
   }
   public function categories(){
    return $this->belongsToMany(Category::class);
}
   public function user(){
    return $this->belongsTo(User::class);
   }
}
