<?php

namespace App\Http\actions;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use App\Brand;
class BrandCRUD{
    public function create($request){
     $newbrand=Brand::create([
        'brand_name'=>$request->brand_name,'user_id'=>$request->user_id,'category_id'=>$request->category_id
     ]);
    cache::forget('brand.*');
    $brands=Brand::all();
    foreach($brands as $brand){
     Redis::hmset('brand.'.$brand->id,
     [
       'id'=> $brand->id,
       'brand_name'=>$brand->brand_name,
       'category_id'=> $brand->category_id,
       'user_id'=>$brand->user_id,
     ]);
    }
    
    return $newbrand;
    }
    public function show($id){
      return cache::get('brand.'.$id);
    }
    public function index(){
      $keys=Redis::keys('brand.*');
      $client=[];
      foreach($keys as $key){
         $client[]=Redis::hgetall('brand.'.substr($key,strlen($key)-2,strlen($key)));
      }
       return  $client;
    }
    public function update($request,$id){
        $brand=Brand::find($id);
        $brand->brand_name=$request->brand_name;
        $brand->user_id=$request->user_id;
        $brand->save();
         Redis::hmset('brand.'.$brand->id,
         [
       'id'=> $brand->id,
       'brand_name'=>$brand->brand_name,
       'category_id'=> $brand->category_id,
       'user_id'=>$brand->user_id,
         ]);
       
        return $brand;
    }
    public function destroy($id){
     $b=Brand::find($id);
     $b->delete();
     Redis::del('brand.*');
     $brands=Brand::all();
        foreach($brands as $brand){
         Redis::hmset('brand.'.$brand->id,
         [
            'id'=> $brand->id,
            'brand_name'=>$brand->brand_name,
            'category_id'=> $brand->category_id,
            'user_id'=>$brand->user_id,
         ]);
        }
    }
}