<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\actions\CartFacade;
use App\Http\Requests\CartRequest;
use App\Http\Resources\CartResource;

class CartController extends Controller
{
    public function update($id,CartRequest $request){
        return new CartResource(CartFacade::update($id,$request));
    }
    public function index(){
        return new CartResource(CartFacade::index());
    }

}
