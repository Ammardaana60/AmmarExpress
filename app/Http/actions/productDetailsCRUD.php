<?php
namespace App\Http\actions;

use App\Productdetails;
use App\Product;
class productDetailsCRUD 
{
    public function create($pro,$id){
        $x=0;
        // for($i=0;$i<$pro->color->count();$i++){
            $productDetails=new Productdetails();
            $productDetails->size=$pro->size;
            $x=$x+$productDetails->quantity=$pro->itemquantity;
            $productDetails->color=$pro->color;
            $productDetails->product_id=$id;
            $productDetails->save();
            // }
           $product=Product::find($id);
           $product->product_quantity=$x;
           $product->save();
           return $product;
    }
}
