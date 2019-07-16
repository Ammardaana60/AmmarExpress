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
    public function clearCart($id){
        return response()->json(CartFacade::clearCart($id));
    }
    public function buyNow($id){
        return response()->json(CartFacade::buyNow($id));
    }
    public function show($id){
        return response()->json(CartFacade::show($id));
    }

}
