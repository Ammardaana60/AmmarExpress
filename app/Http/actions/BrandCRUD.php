<?php

namespace App\Http\actions;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Brand;
use App\Product;
use Auth;
class BrandCRUD{
   public function search($brand){
   $brand=Brand::where('brand_name','=',$brand)->paginate(5);  
  return $brand;
   }
    public function create($request){
     $brand=Brand::create([
        'brand_name'=>$request->brand_name,'user_id'=>Auth::user()->id,'category_id'=>$request->category_id,
     ]);
    Cache::put('brand.'.$brand->id,
     ['id'=> $brand->id,
       'brand_name'=>$brand->brand_name,
       'category_id'=> $brand->category_id,
       'user_id'=>$brand->user_id,
     ]);   
    return $brand;
    }
    public function show($id){
      return Cache::get('brand.'.$id);
    }
    public function index(){
      return Cache::get('brand');
    }
    public function update($request,$id){
        $brand=Brand::find($id);
        $brand->brand_name=$request->brand_name;
        $brand->user_id=$request->user_id;
        $brand->save();
        Cache::put('brand.'.$brand->id,
         ['id'=> $brand->id,
         'brand_name'=>$brand->brand_name,
         'category_id'=> $brand->category_id,
         'user_id'=>$brand->user_id,
         ]);
       
        return $brand;
    }
    public function destroy($id){
     $b=Brand::find($id);
     $b->delete();
     Cache::del('brand.'.$b->id);
    }
}