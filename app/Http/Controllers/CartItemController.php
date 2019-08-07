<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\actions\CartItemFacade;
use App\Http\Requests\CartItemRequest;
use App\Http\Resources\CartItemRescource;

class CartItemController extends Controller
{
    public function create(CartItemRequest $request){
        return new CartItemRescource(CartItemFacade::create($request));
    }
    public function update(CartItemRequest $request ,$id){
        return new CartItemRescource(CartItemFacade::update($request,$id));
    }
    public function destroy($id){
        return new CartItemRescource(CartItemFacade::destroy($id));
    }
}
