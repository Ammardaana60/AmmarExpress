<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\actions\PocketFacade;
use App\Http\Resources\PocketResources;
class PocketController extends Controller
{
    public function createPocket(){
    return PocketFacade::createPocket();
    }
    public function update(Request $request){
    return new PocketResources(PocketFacade::update($request));
    }
    public function checkout(Request $request){
    return PocketFacade::checkout($request);
    }
    
}
