<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\actions\CartItemFacade;
use App\Http\Requests\CartItemRequest;

class CartItemController extends Controller
{
    public function create(CartItemRequest $request){
        return response()->json(CartItemFacade::create($request));
    }
    public function update(CartItemRequest $request ,$id){
        return response()->json(CartItemFacade::update($request,$id));
    }
    public function destroy($id){
        return response()->json(CartItemFacade::destroy($id));
    }
}
