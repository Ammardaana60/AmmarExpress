<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\actions\BrandFacade;
use App\Http\Requests\brandRequest;
use App\Http\Resources\BrandResource;

class BrandController extends Controller
{
    public function create(brandRequest $request){
        return new BrandResource(BrandFacade::create($request));
    }
    public function destroy($id){
        return new BrandResource(BrandFacade::destroy($id));
    }
    public function update(brandRequest $request,$id){
       return new BrandResource(BrandFacade::update($request,$id));
    }
    public function show($id){
        return new BrandResource(BrandFacade::show($id));
    }
    public function index(){
        return BrandResource::collection(BrandFacade::index());
    }
}
