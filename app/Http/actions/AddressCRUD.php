<?php
namespace App\Http\actions;

use App\Address;
use Auth;
use App\User;
class AddressCRUD{
public function create($request){
    Address::create([
    'user_id'=>Auth::user()->id,
    'city_id'=>$request->city_id,
    'country_id'=>$request->country_id,
    'postal_code'=>$request->postal_code,
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