<?php
namespace App\Http\actions;

use App\Address;
use Auth;
class AddressCRUD{
    public function create($order){
        Address::create([
            'user_id'=>Auth::user()->id,
            'order_id'=>$order,
        ]);
    }
//    public function update($request,$order){
//        $address=User::find(Auth::user()->id);
//        $address->=$order;
//        $address->save();
//    }
}