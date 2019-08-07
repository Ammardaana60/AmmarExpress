<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\actions\ProductFacade;
use App\Http\Requests\productRequest;
use App\Http\Requests\UpdateRequest;
class ProductController extends Controller
{
    public function create(productRequest $request){
    return response()->json(ProductFacade::Create($request));
    }
    public function show($id){      
        return response()->json(ProductFacade::show($id));
    }
    public function index(Request $request){
        return response()->json(ProductFacade::index($request));
    }
    public function update($id,UpdateRequest $request){
        return response()->json(ProductFacade::Update($id,$request));
    }
    public function destroy($id){
        return response()->json(ProductFacade::Destroy($id));
    }
    public function readExcelFile(Request $filename){
        return response()->json(ProductFacade::readExcelFile($filename->import_file));
    }

}
