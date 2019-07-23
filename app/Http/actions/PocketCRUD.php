<?php

namespace  App\Http\actions;
use App\Product;
use App\Pocket;
use App\CartItem;
use App\Brand;
use App\Productdetails;
use App\Http\actions\transactionFacade;
use Auth;
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
        $checkPocketMoney=Pocket::find(Auth::user()->id);
        $CartPrice=CartFacade::totalPrice();
        if($checkPocketMoney->cash==0 && $CartPrice !=0){
            return 'your pocket is empty';
        }else if($checkPocketMoney->cash>=$CartPrice){
        $moneywithDraw=Pocket::find(Auth::user()->id);
        $moneywithDraw->cash=$moneywithDraw->cash-$CartPrice;
        $moneywithDraw->save();
        CartFacade::UpdateQuantity();
        $order=orderFacade::create();
        AddressFacade::create($order); 
        $items=CartItem::where('cart_id','=',Auth::user()->id)->where('status','=',1)->get();
        if(count($items)>0){
        foreach($items as $item){
        $itemDiscount=Productdetails::where('product_id','=',$item->product_id)->where('color','=',$item->color)->where('size','=',$item->size)->get('itemDiscount');
        $product=Product::find($item->product_id);
        $brand=Brand::find($product->brand_id);
        $discount= 0;
        if($discount==0){
             $transaction=[
              'from_user'=>Auth::user()->id,
              'to_user'=>$brand->user_id,
              'price'=>$product->product_price,
              'quantity'=>$item->quantity,
              'product_id'=>$product->id,
            ];
        }else{
            $actualDiscount=$product->product_price*$discount;
            $transaction=[
                'from_user'=>Auth::user()->id,
                'to_user'=>$brand->user_id,
                'price'=>$product->product_price-$actualDiscount,
                'quantity'=>$item->quantity,
                'product_id'=>$product->id,
              ];

        }
            CartItemFacade::itemStatusUpdate($item->id,$order);
            ProductFacade::ProductStatus($item->product_id);
            transactionFacade::create($transaction);
        }
            return 'done';
        }
        else{
            return 'empty cart';
        }
        }else {
            return "pocket money isn't enough";
        }
    }
}