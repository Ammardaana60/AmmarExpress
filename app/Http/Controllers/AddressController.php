<?php

namespace App\Http\Controllers;

use App\Http\actions\AddressFacade;
use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;

class AddressController extends Controller
{
    public function create(AddressRequest $request){
        return new AddressResource(AddressFacade::create($request));
    }
    public function update(AddressRequest $request){
        return new AddressResource(AddressFacade::update($request));
    }
}
