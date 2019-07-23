<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\actions\AddressFacade;

class AddressController extends Controller
{
    public function create(){
        return response()->json(AddressFacade::create());
    }
    public function update(AddressRequest $request){
        return response()->json(AddressFacade::update($request));
    }
}
