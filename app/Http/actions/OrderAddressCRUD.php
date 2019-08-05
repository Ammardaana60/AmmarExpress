<?php

namespace App\Http\actions;

use App\OrderAddress;
use App\Order;
class  OrderAddressCRUD{
 public function createOrderAddress($id,$address_id){
        $order=Order::where('user_id','=',$id)->latest()->first();
        OrderAddress::create([
            'user_id'=>$id,
            'order_id'=>$order->id,
            'address_id'=>$address_id,
        ]);
 }
}