<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CartItem extends Model 
{
    public function __construct()
    {
      
    }
    protected $fillable=['cart_id','product_id','quantity','status','size','color'];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function cart(){
        return $this->belongsTo(Cart::class);
    }
    public function productdetails(){
    return $this->hasOne(Productdetails::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
 
}
