<?php

namespace  App\Http\actions;
use App\Pocket;
use Auth;
use App\User;
use Illuminate\Support\Facades\Queue;
use App\Jobs\paymentprocsss;
class PocketCRUD {
public function create($id){
  Pocket::create([
   'user_id'=>$id,
   'cash'=>0,
   'currency'=>'dinar',
  ]);
  return 'done';
}
public function  update($request){
    $pocket=Pocket::find(Auth::user()->id);
    if($pocket->currency=='dinar'){
     $pocket->cash=$pocket->cash+$request->cash;
     $pocket->currency=$request->currency;
     $pocket->save();
     return $pocket;
    }else{
      return "this currency isn't allow now";
    }
}
public function checkout($request){
    $user=User::find(Auth::user()->id);
    $pocket=$user->pocket;
    $cartItem=$user->cart->items->where('status','=',1);
    $CartPrice=CartFacade::totalPrice($cartItem);
    if($pocket->cash==0 or $CartPrice==0){
        return 'your pocket is empty or your cart is empty';
    }else if($pocket->cash>=$CartPrice){
        Queue::push(new paymentprocsss($cartItem,Auth::user()->id,$CartPrice,$request->address_id));        
        return 'done';
    }else
        return 'money in the pocket isnot enough or product quantity not enough';   
    }
}
