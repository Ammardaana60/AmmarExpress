<?php

namespace  App\Http\actions;
use App\Product;
use App\pocket;
use App\CartItem;
use App\Brand;
use App\Http\actions\transactionFacade;
use Auth;
class PocketCRUD {
    public function create($id){
    pocket::create([
     'user_id'=>$id,
     'cash'=>0,
     'currency'=>'dinar',
    ]);
    return 'done';
    }
    public function  update($request){
    $pocket=pocket::find(Auth::user()->id);
    if($pocket->currency=='dollar'){
    $pocket->cash=$pocket->cash+($request->cash*0.7);
    $pocket->currency=$request->currency;
    $pocket->save();
    }else if($pocket->currency=='dinar'){
    $pocket->cash=$pocket->cash+$request->cash;
    $pocket->currency=$request->currency;
    $pocket->save();
     return response()->json($pocket->cash);
    }else {
        return "this currency isn't allow here";
    }
    }
    public function payment(){
        $checkPocketMoney=pocket::find(Auth::user()->id);
        $CartPrice=CartFacade::totalPrice();
        if($checkPocketMoney->cash==0 && $CartPrice !="isn't enough"){
            return 'your pocket is empty';
        }else if($checkPocketMoney->cash>=$CartPrice){
        $moneywithDraw=pocket::find(Auth::user()->id);
        $moneywithDraw->cash=$moneywithDraw->cash-$CartPrice;
        $moneywithDraw->save();
         $items=CartItem::where('cart_id','=',Auth::user()->id)->get();
          foreach($items as $item){
            
             $product=Product::find($item->product_id);
             $brand=Brand::find($product->brand_id);
             $transaction=[
              'from_user'=>Auth::user()->id,
              'to_user'=>$brand->user_id,
              'price'=>$product->product_price,
              'quantity'=>$item->quantity,
              'product_id'=>$product->id,
            ];
           transactionFacade::create($transaction);
            }
            $items=CartItem::where('cart_id','=',Auth::user()->id)->delete();
            return 'done';
        }else {
            return "pocket money isn't enough";
        }
    }
}