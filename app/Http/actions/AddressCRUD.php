<?php
namespace App\Http\actions;

use App\Address;
use Auth;
use App\Order;
class AddressCRUD{
    public function create($id){
        $order=Order::where('user_id','=',$id)->latest()->first();
        Address::create([
            'user_id'=>$id,
            'order_id'=>$order->id,
        ]);
  }

}