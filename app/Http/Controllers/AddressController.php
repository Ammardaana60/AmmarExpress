<?php

namespace App\Http\Controllers;

use App\Http\actions\AddressFacade;
use App\Http\Requests\AddressRequest;
class AddressController extends Controller
{
    public function create(){
        return response()->json(AddressFacade::create());
    }
    public function update(AddressRequest $request){
        return response()->json(AddressFacade::update($request));
    }
}
