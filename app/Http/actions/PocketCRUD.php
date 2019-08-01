<?php

namespace  App\Http\actions;
use App\Product;
use App\Pocket;
use App\CartItem;
use App\Jobs\Transaction;
use App\Productdetails;
use App\Brand;
use Auth;
use App\Jobs\address;
use App\Jobs\minusMoney;
use App\User;
use App\Cart;
use App\Events\CreateOrder;
use App\Events\SendSupplierNotification;
use App\Jobs\sendsupplieremail;
use App\Jobs\quantityupdate;
use Illuminate\Support\Facades\Queue;
use App\Jobs\orderJob;
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
    if($pocket->currency=='dollar'){
    $pocket->cash=$pocket->cash+($request->cash*0.71);
    $pocket->currency='dinar';
    $pocket->save();
    }else 
    if($pocket->currency=='dinar'){
    $pocket->cash=$pocket->cash+$request->cash;
    $pocket->currency=$request->currency;
    $pocket->save();
     return response()->json($pocket->cash);
    }else {
        return "this currency isn't allow here";
    }
    }
    public function payment(){
    $pocket=Pocket::find(Auth::user()->id); 
     $cartItem=Cart::find(Auth::user()->id)->items->where('status','=',1);
     $CartPrice=CartFacade::totalPrice($cartItem);
     if($pocket->cash==0 or $CartPrice==0){
        return 'your pocket is empty or your cart is empty';
        }else if($pocket->cash>=$CartPrice){
        Queue::push(new paymentprocsss($cartItem,Auth::user()->id,$CartPrice));        
        return 'done';
        }
        else{
            return 'money in the pocket isnot enough or product quantity not enough';
        }  
    }
}