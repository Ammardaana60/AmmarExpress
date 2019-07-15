<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\actions\CartFacade;
use App\Http\Requests\CartRequest;
class CartController extends Controller
{
    public function create(CartRequest $request){
        return response()->json(CartFacade::create($request));
    }
    public function update($id,CartRequest $request){
        return response()->json(CartFacade::update($id,$request));
    }
    public function destroy($id){
        return response()->json(CartFacade::destroy($id));
    }
    public function clearCart(){
        return response()->json(CartFacade::clearCart());
    }
    public function show($id){
        return response()->json(CartFacade::show($id));
    }
    public function buyNow(){
        return response()->json(CartFacade::buyNow());
    }

}
