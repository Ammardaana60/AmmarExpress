<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
class Product extends Model implements HasMedia
{
    use Searchable,SoftDeletes,HasMediaTrait;
    protected $fillable=['images','brand_id','ARproduct_name','ARproduct_description','product_price','category_id','product_name','product_quantity','product_rating','product_description','tag','properities'];
    protected $with = ['comments'];
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function categories(){
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
    // public function registerMediaConversions(Media $media = null)
    // {
    //  $this->addMediaConversion('thumb')
    //      ->width(50)
    //      ->height(50);
    // }
}
