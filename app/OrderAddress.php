<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    protected $fillable=['user_id','order_id','address_id'];
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
