<?php
namespace App\Http\actions;
// use Predis\client;
use Illuminate\Support\Facades\Redis;        
use Illuminate\Support\Facades\Cache;        
use App\Product;
class productCRUD{
   public function search($request){
      $products=new Product();
      return $products->search($request)->get();
   }
   public function createProduct($pro){
      $image=$pro->file('images')->store('productImage');
      
      $product=Product::create([
      'product_name' => $pro->product_name,
      'product_description' => $pro->product_description,
      'product_price' => $pro->product_price,
      'product_quantity' => $pro->product_quantity,
      'product_rating' =>0,
      'brand_id'=>$pro->brand_id,
      'category_id'=>$pro->category_id,
      'images'=>$image,
     ]);
     Cache::forget('product.*');
     $products=Product::all();
     foreach($products as $product){
      Redis::hmset('product.'.$product->id,[
         'id' => $product->id,
         'product_name' => $product->product_name,
         'product_description' => $product->product_description,
         'product_price' => $product->product_price,
         'product_quantity' => $product->product_quantity,
         'product_rating' => $product->product_rating,
         'brand_id'=>$product->brand_id,
         'category_id'=>$product->category_id,
         'images'=>$image,
         ]);
     } 
     
     return $product;
    }
    public function updateProduct($id,$request){
    $image=$request->file('images')->store('productImages');
    $product=Product::find($id);
    $product->product_name=$request->product_name;
    $product->product_description=$request->product_description;
    $product->product_quantity=$request->product_quantity;
    $product->product_price=$request->product_price;   
    $product->images=$image;
    $product->save();
      Redis::hmset('product.'.$id,[
         'id' => $id,
         'product_name' => $product->product_name,
         'product_description' => $product->product_description,
         'product_price' => $product->product_price,
         'product_quantity' => $product->product_quantity,
         'product_rating' => $product->product_rating,
         'brand_id'=>$product->brand_id,
         'category_id'=>$product->category_id,
         'images'=>$image,
         ]);
     return $product;
    }
    public function destroyProduct($id){
      $product=Product::find($id);
      $product->delete();
      Cache::forget('product.'.$id);
    }
    public function showProduct($id){
     return Cache::get('product.'.$id);
     } 
    public function index(){
     $keys=Redis::keys('product.*');
     $client=[];
     foreach($keys as $key){
        $client[]=Redis::hgetall('product.'.substr($key,strlen($key)-2,strlen($key)));
     }
      return  $client;
    }

    
}