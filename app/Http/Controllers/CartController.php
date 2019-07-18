<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\actions\CartFacade;
use App\Http\Requests\CartRequest;
class CartController extends Controller
{
    public function update($id,CartRequest $request){
        return response()->json(CartFacade::update($id,$request));
    }
    public function clearCart(){
        return response()->json(CartFacade::clearCart());
    }
    public function buyNow(){
        return response()->json(CartFacade::buyNow());
    }
    public function show(){
        return response()->json(CartFacade::show());
    }

}
