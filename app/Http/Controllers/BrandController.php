<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\actions\BrandFacade;
use App\Http\Requests\brandRequest;
class BrandController extends Controller
{
    public function create(brandRequest $request){
        return response()->json(BrandFacade::create($request));
    }
    public function destroy($id){
        return response()->json(BrandFacade::destroy($id));
    }
    public function update(brandRequest $request,$id){
       return response()->json(BrandFacade::update($request,$id));
    }
    public function show($id){
        return response()->json(BrandFacade::show($id));
    }
    public function index(){
        return response()->json(BrandFacade::index());
    }
}
