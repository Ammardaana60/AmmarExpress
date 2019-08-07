<?php
namespace App\Http\actions;       
use Rap2hpoutre\FastExcel\FastExcel;
use App\Product;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ProductFilteringResources;

class ProductCRUD{
public function Create($pro){
      $tags=explode(',',$pro->tag);
      $product=new Product();
      $product->attachTag($tags);
      $product->addMedia($pro->images)->toMediaCollection('productImages');
      $product->brand_id=$pro->brand_id;
      $product->discount=$pro->discount;
      $product->category_id=$pro->category_id;
      $product->product_name=$pro->product_name;
      $product->product_description=$pro->product_description;
      $product->properities=$pro->properities;
      $product->product_nameAR=$pro->ARproduct_name;
      $product->product_descriptionAR=$pro->ARproduct_description;
      $product->product_price=$pro->product_price;
      $product->status=1;
      $product->product_quantity=0;
      $product->save(); 
      ProductDetailsFacade::create($pro,$product->id);
      return $product;
}
public function Update($id,$request){
      $product=Product::find($id);
      $product->addMedia($request->images)->toMediaCollection('productImages');
      $product->product_name=$request->product_name;
      $product->product_description=$request->product_description;
      $product->product_quantity=$product->product_quantity+$request->product_quantity;
      $product->product_price=$request->product_price;   
      $product->ARproduct_name=$request->ARproduct_name;
      $product->Arproduct_description=$request->Arproduct_description;
      $product->discount=$request->discount;
      if($request->product_quatity>0){
        $product->status=1;
      }
      $product->save();
      return $product;
}
public function Status($items){
      foreach($items as $item){
       $product=$item->product;
      if($product->product_quantity==0){
        $product->status=0;
      }
       $product->save();
      }
}
public function Destroy($id){
      $product=Product::find($id);
      $product->status=0;
      $product->save();
}
public function show($id){
    return Product::find($id);
} 
public function index($request){
  return Product::with(['tags','media'])
  ->withAnyTags([$request->tags,''])
  ->where('brand_id','=',$request->brand_id)
  ->get();
 }
public function CreateFromExcel($pro){
       $url = $pro['picture'];
       $contents = file_get_contents($url);
       $name = substr($url, strrpos($url, '/') + 1);
       Storage::put($name, $contents);
       $product=new Product();
       $product->addMediaFromUrl($url)->toMediaCollection();
       $product->brand_id=$pro['brand_id'];
       $product->discount=$pro['discount'];
       $product->category_id=$pro['category_id'];
       $product->product_name=$pro['product_name'];
       $product->product_description=$pro['product_description'];
       $product->properities=$pro['properities'];
       $product->product_nameAR=$pro['Arproduct_name'];
       $product->product_descriptionAR=$pro['Arproduct_description'];
       $product->product_price=$pro['product_price'];
       $product->status=1;
       $product->product_quantity=0;
       $product->save();
       $product->attachTag($pro['tag']);
       $product->save(); 
}
public function ReadExcelFile($filename){
      try{
        $fileContent=file_get_contents($filename);
        $name = substr($filename, strrpos($filename, '/') + 1);
        Storage::put($name, $fileContent);
        $collection = (new FastExcel)->import($filename);
        foreach($collection as $pro){                 
        ProductFacade::CreateFromExcel($pro);
        }
        return $collection;
        }catch(\Exception $e){
          \Log::Error('fucken error:'.$e->getMessage());
        }
     }
}