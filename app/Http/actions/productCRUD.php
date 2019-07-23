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
  public function ProductStatus($id){
     $product=Product::find($id);
     if($product->product_quantity==0){
        $product->status=0;
        $product->save();
     }
  }
   public function createProduct($pro){
      $product=new Product();
      $product->brand_id=$pro->brand_id;
      $product->category_id=$pro->category_id;
      $product->product_name=$pro->product_name;
      $product->product_description=$pro->product_description;
      $product->properities=$pro->properities;
      $product->tag=$pro->tag;
      $product->ARproduct_name=$pro->ARproduct_name;
      $product->ARproduct_description=$pro->ARproduct_description;
      $product->product_price=$pro->product_price;
      $product->status=1;
      $product->images=$pro->images;
      $product->product_quantity=0;
      $product->save(); 
      return response()->json(productDetailsFacade::create($pro,$product->id));
    }
    public function updateProduct($id,$request){
    $image=$request->file('images')->store('productImages');
    $product=Product::find($id);
    $product->product_name=$request->product_name;
    $product->product_description=$request->product_description;
    $product->product_quantity=$product->product_quantity+$request->product_quantity;
    $product->product_price=$request->product_price;   
    if($request->product_quatity>0){
       $product->status=1;
    }
    $product->images=$image;
    $product->save();
     Cache::put('product.'.$id,[
         'id' => $id,
         'product_name' => $product->product_name,
         'product_description' => $product->product_description,
         'product_price' => $product->product_price,
         'product_quantity' => $product->product_quantity,
         'rating' => $product->rating,
         'brand_id'=>$product->brand_id,
         'category_id'=>$product->category_id,
         'images'=>$image,
         ]);
     return $product;
    }
    public function destroyProduct($id){
      $product=Product::find($id);
      $product->status=0;
      $product->save();
      Cache::forget('product.'.$id);
    }
    public function showProduct($id){
     $product=Product::find($id);
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