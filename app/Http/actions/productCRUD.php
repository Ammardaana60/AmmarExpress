<?php
namespace App\Http\actions;
use Auth;     
use Illuminate\Support\Facades\Cache;        
use Rap2hpoutre\FastExcel\FastExcel;
 use App\Product;
 use Illuminate\Support\Facades\Storage;
class productCRUD{
   public function search($request){
      $products=new Product();
      return $products->search($request)->paginate(5);
  }
  
   public function createProduct($pro){
      $product=new Product();
      $product->addMedia($pro->images)->toMediaCollection('productImages');
      $product->brand_id=$pro->brand_id;
      $product->discount=$pro->discount;
      $product->category_id=$pro->category_id;
      $product->product_name=$pro->product_name;
      $product->product_description=$pro->product_description;
      $product->properities=$pro->properities;
      $product->tag=$pro->tag;
      $product->ARproduct_name=$pro->ARproduct_name;
      $product->ARproduct_description=$pro->ARproduct_description;
      $product->product_price=$pro->product_price;
      $product->status=1;
      $product->product_quantity=0;
      $product->save(); 
      Cache::set('product.'.$product->id,[
      'id'=>$product->id,
      'product_name'=>$product->product_name,
      'product_description'=>$product->product_description,
      'product_price'=>$product->product_price,
      'ARproduct_name'=>$product->ARproduct_name,
      'ARproduct_description'=>$product->product_description,
      'status'=>$product->status,
      'properities'=>$product->properities,
      'tag'=>$product->tag,
      'brand_id'=>$product->brand_id,
      'category_id'=>$product->category_id,
      'rating'=>$product->rating,
      'discount'=>$product->discount,
      'product_quantity'=>$product->product_quantity,
      ]);
      return response()->json(productDetailsFacade::create($pro,$product->id));
    }
    public function updateProduct($id,$request){
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
    Cache::set('product.'.$product->id,[
      'id'=>$product->id,
      'product_name'=>$product->product_name,
      'product_description'=>$product->product_description,
      'product_price'=>$product->product_price,
      'ARproduct_name'=>$product->ARproduct_name,
      'ARproduct_description'=>$product->product_description,
      'status'=>$product->status,
      'properities'=>$product->properities,
      'tag'=>$product->tag,
      'brand_id'=>$product->brand_id,
      'category_id'=>$product->category_id,
      'rating'=>$product->rating,
      'product_quantity'=>$product->product_quantity,
      'discount'=>$product->discount,
      ]);
    return $product;
    }
    public function ProductStatus($items){
       foreach($items as $item){
       $product=$item->product;
       if($product->product_quantity==0){
        $product->status=0;
       }
       $product->save();
      }
    }
    public function destroyProduct($id){
      $product=Product::find($id);
      $product->status=0;
      $product->save();
      Cache::forget('product.'.$id);
    }
    public function showProduct($id){
     $product=Cache::get('product'.$id);
     if($product->status==1)
      return $product;
     else
     return 'quantity not enough';
     } 
    public function index(){
    return Cache::get('product');
    }
    public function readExcelFile($filename){
      try{
        $path = $filename->file('import_file')->store('excel-files');
        $collection = (new FastExcel)->import(storage_path('app/' . $path));
        foreach($collection as $pro){                 
          $url = $pro['picture'];
          $contents = file_get_contents($url);
          $name = substr($url, strrpos($url, '/') + 1);
          Storage::put($name, $contents);
          $urls=Storage::url($name);    
          $product=new Product();
            $product->addMediaFromUrl($url)->toMediaCollection();
            $product->brand_id=$pro['brand_id'];
            $product->discount=$pro['discount'];
            $product->category_id=$pro['category_id'];
            $product->product_name=$pro['product_name'];
            $product->product_description=$pro['product_description'];
            $product->properities=$pro['properities'];
            $product->tag=$pro['tag'];
            $product->ARproduct_name=$pro['Arproduct_name'];
            $product->ARproduct_description=$pro['Arproduct_description'];
            $product->product_price=$pro['product_price'];
            $product->status=1;
            $product->product_quantity=0;
            $product->save(); 
          }
     
    }
    catch(\Exception $e){
      \Log::Error('fucken error:'.$e->getMessage());
  }
  }
}