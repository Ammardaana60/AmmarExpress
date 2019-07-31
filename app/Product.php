<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Laravel\Scout\Searchable;Searchable,
// use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
class Product extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $fillable=['images','brand_id','ARproduct_name','ARproduct_description','product_price','category_id','product_name','product_quantity','product_rating','product_description','tag','properities','discount','status'];
    protected $with = ['comments','details'];
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function details(){
        return $this->hasMany(Productdetails::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    // public function searchableAs(){
    //  return 'product_name';
    // }
   
}
