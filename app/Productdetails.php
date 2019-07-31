<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productdetails extends Model
{
   public function __construct()
    {
        
    }
protected $fillable=['size','color','quantity','itemStatus','itemDiscount','product_id'];
public function product(){
    return $this->belongsTo(Product::class);
}

}
