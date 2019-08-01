<?php
namespace App\Http\actions;
use Auth;
use Illuminate\Support\Facades\Redis;        
use Illuminate\Support\Facades\Cache;        
use Illuminate\Support\Facades\DB;
 use App\Product;
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
    $product=DB::select('select rating,product_price,images,product_name,product_description from products where status=1');
    return $product;
    }
    public function AR_index(){
    $product=DB::select('select rating,product_price,images,ARproduct_name,ARproduct_description from products where status=1');
    return $product;
    }
}