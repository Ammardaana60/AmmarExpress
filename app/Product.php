<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use Searchable,SoftDeletes;
    protected $fillable=['images','brand_id','product_price','category_id','product_name','product_quantity','product_rating','product_description'];
    public function comment(){
        return $this->hasMany(Comment::class);
    }
    public function category(){
        return $this->belongsToMany(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function searchableAs(){
     return 'product_name';
 }
}
