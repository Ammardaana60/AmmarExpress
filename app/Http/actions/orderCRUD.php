<?php
namespace App\Http\actions;

use App\Order;
use Auth;

class orderCRUD {

    public function create(){
        $order= Order::create([
         'cart_id'=>Auth::user()->id,
         'user_id'=>Auth::user()->id,
       ]);
     return $order->id;
    }
}