<?php

namespace App\Http\Controllers;

use App\Http\actions\AddressFacade;
use App\Http\Requests\AddressRequest;
class AddressController extends Controller
{
    public function create(AddressRequest $request){
        return response()->json(AddressFacade::create($request));
    }
    public function update(AddressRequest $request){
        return response()->json(AddressFacade::update($request));
    }
}
