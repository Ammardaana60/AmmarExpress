<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pocket;
use App\Http\actions\PocketFacade;

class pocketController extends Controller
{
    public function createPocket(){
    return response()->json(PocketFacade::createPocket());
    }
    public function update(Request $request){
    return response()->json(PocketFacade::update($request));
    }
    public function payment(){
    return response()->json(PocketFacade::payment());
    }
    
}
