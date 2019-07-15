<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable=['user_id','status'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function cartItem(){
        return $this->hasMany(CartItem::class);
    }
  public function cart_item(){
    return $this->hasMany(CartItem::class);
  }
    
}
