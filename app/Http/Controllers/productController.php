<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\actions\ProductFacade;
use App\Http\Requests\productRequest;
use App\Http\Requests\UpdateRequest;
class productController extends Controller
{
    public function search(Request $request){
        return response()->json(ProductFacade::search($request->task));
    }
    public function create(productRequest $request){
    return response()->json(ProductFacade::createProduct($request));
    }
    public function show($id){
        
        return response()->json(ProductFacade::showProduct($id));
    }
    public function index(){
        return response()->json(ProductFacade::index());
    }
    public function update($id,UpdateRequest $request){
        return response()->json(ProductFacade::updateProduct($id,$request));
    }
    public function destroy($id){
        return response()->json(ProductFacade::destroyProduct($id));
    }

}
