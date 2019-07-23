<?php
namespace App\Http\actions;
use App\Transaction;
use App\Pocket;
use App\Http\actions\orderFacade;
use App\Notifications\productAddToCart;
class transactionCRUD{
 public function create($request){
    $pocket=Pocket::find($request['to_user']);
    $pocket->cash=$pocket->cash+($request['price']*$request['quantity']);
    $pocket->save();
    Transaction::create([
        'from_user'=>$request['from_user'],
        'to_user'=>$request['to_user'],
        'cash'=>$request['price']*$request['quantity'],//price with discount
    ]);
    $request['to_user']->notify(new productAddToCart());
    
 }
 
}
