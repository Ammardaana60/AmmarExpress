<?php

namespace App\Http\actions;
use App\Brand;
use Auth;
class BrandCRUD{
  public function create($request){
   $brand=Brand::create([
        'brand_name'=>$request->brand_name,'user_id'=>Auth::user()->id,'category_id'=>$request->category_id,
    ]);
    return $brand;
  }
  public function show($id){
     return Brand::find($id);
  }
  public function index(){
     return Brand::all();
  }
  public function update($request,$id){
     $brand=Brand::find($id);
     $brand->brand_name=$request->brand_name;
     $brand->user_id=$request->user_id;
     $brand->save();
     return $brand;
  }
  public function destroy($id){
     $b=Brand::find($id);
     $b->delete();
  }
}