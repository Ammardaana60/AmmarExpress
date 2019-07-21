<?php
namespace App\Http\actions;
use Auth;
use Illuminate\Support\Facades\Redis;        
use Illuminate\Support\Facades\Cache;        
use Illuminate\Support\Facades\DB;
 use App\Product;
class productCRUD{
   public function search($request){
      // $products=new Product();
      // return $products->search($request)->get();
      // $product=Product::find(198);
      // return response()->json(Product::find(198));
   }
   public function createProduct($pro){
      $product=new Product();
      $product->product_name=$pro->product_name;
      $product->product_description=$pro->product_description;
      $product->product_price= $pro->product_price;
      $product->product_quantity=$pro->product_quantity;
      $product->product_rating=0;
      $product->properities=$pro->properities;
      $product->tag=$pro->tag;
      $product->brand_id=$pro->brand_id;
      $product->category_id=$pro->category_id;
      $product->images=$product->addMedia($pro->images)->toMediaCollection('PrdocutImages');
      $product->save(); 
      Cache::forget('product.*');
      $products=Product::all();
      foreach($products as $product){
      Cache::put('product.'.$product->id,[
         'id' => $product->id,
         'product_name' => $product->product_name,
         'product_description' => $product->product_description,
         'product_price' => $product->product_price,
         'product_quantity' => $product->product_quantity,
         'product_rating' => $product->product_rating,
         'brand_id'=>$product->brand_id,
         'category_id'=>$product->category_id,
         'images'=>$product->getMedia(),

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
     Cache::put('product.'.$id,[
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
     return Product::find($id);
     } 
    public function index(){
     $keys=Redis::keys('product.*');
     $client=[];
     foreach($keys as $key){
        $client[]=Redis::hgetall('product.'.substr($key,strlen($key)-2,strlen($key)));
     }
      return  $client;
    }
    public function AR_index(){
       $product=DB::select('select product_rating,product_price,ARproduct_name,ARproduct_description from products');
    return $product;
    }
}