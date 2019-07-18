<?php
namespace App\Http\actions;
use App\Transaction;
use App\pocket;
class transactionCRUD{
 public function create($request){
    //  dd($request['price']*$request['quantity']);
    $pocket=Pocket::find($request['to_user']);

    $pocket->cash=$pocket->cash+($request['price']*$request['quantity']);
    $pocket->save();
    Transaction::create([
        'from_user'=>$request['from_user'],
        'to_user'=>$request['to_user'],
        'cash'=>$request['price']*$request['quantity'],
    ]);
    
 }
 
}
