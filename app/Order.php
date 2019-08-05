<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

 protected $fillable=['user_id','cart_id'];
 public function user(){
     return $this->belongsTo(User::class);
 }
public function orderAddress(){
    return $this->hasMany(OrderAddress::class);
}
}
