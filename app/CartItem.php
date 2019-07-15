<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
 protected $fillable=['cart_id','product_id','quantity'];
 public function Product(){
     return $this->hasOne(Product::class);
 }
 public function Cart(){
     return $this->belongsTo(Cart::class);
 }
 public function user(){
     return $this->belongsTo(User::class);
 }
 
}
