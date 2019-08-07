<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\actions\ProductFacade;
use App\Http\Requests\productRequest;
use App\Http\Requests\UpdateRequest;
class ProductController extends Controller
{
    public function create(productRequest $request){
    return new ProductFilteringResources(ProductFacade::Create($request));
    }
    public function show($id){      
        return new ProductFilteringResources(ProductFacade::show($id));
    }
    public function index(Request $request){
        return ProductFilteringResources::collection(ProductFacade::index($request));
    }
    public function update($id,UpdateRequest $request){
        return new ProductFilteringResources(ProductFacade::Update($id,$request));
    }
    public function destroy($id){
        return new ProductFilteringResources(ProductFacade::Destroy($id));
    }
    public function readExcelFile(Request $filename){
        return ProductFilteringResources::collection(ProductFacade::readExcelFile($filename->import_file));
    }

}
