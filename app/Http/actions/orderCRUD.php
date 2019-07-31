<?php
namespace App\Http\actions;

use App\Order;
use Auth;
class orderCRUD {

    public function create($id){
         $order= new Order();
         $order->cart_id=$id;
         $order->user_id=$id;
         $order->save();   
  }
}