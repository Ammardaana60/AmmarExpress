<?php
namespace App\Http\actions;

use App\Address;
use Auth;
use App\User;
use App\Order;
class AddressCRUD{
public function create($id){
    $order=Order::where('user_id','=',$id)->latest()->first();
    $user=User::find($id);
    Address::create([
        'user_id'=>$id,
        'order_id'=>$order->id,
        'country_id'=>$user->country_id,
        'city_id'=>$user->city_id,
        'postal_code'=>$user->postal_code,
        ]);
}
public function update($request){
    $Address=User::find(Auth::user()->id);
    $Address->country_id=$request->country;
    $Address->city_id=$request->city;
    $Address->postal_code=$request->postal_code;
    $Address->save();
}
}