<?php

namespace App\Http\actions;
use Illuminate\Support\Facades\Cache;
use App\Brand;
use Auth;
use App\Http\Resources\BrandResource;

class BrandCRUD{
  public function search($brand){
   $brand=Brand::where('brand_name','=',$brand)->paginate(5);  
   return $brand;
  }
  public function create($request){
   $brand=Brand::create([
        'brand_name'=>$request->brand_name,'user_id'=>Auth::user()->id,'category_id'=>$request->category_id,
    ]);
    return new BrandResource($brand);
  }
  public function show($id){
     return new BrandResource(Brand::find($id));
  }
  public function index(){
     return BrandResource::collection(Brand::all());
  }
  public function update($request,$id){
     $brand=Brand::find($id);
     $brand->brand_name=$request->brand_name;
     $brand->user_id=$request->user_id;
     $brand->save();
     return new BrandResource($brand);
  }
  public function destroy($id){
     $b=Brand::find($id);
     $b->delete();
  }
}