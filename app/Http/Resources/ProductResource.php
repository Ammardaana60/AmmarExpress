<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
           'brand'=>$this->brand->id,
            'user'=>$this->brand->user->id,
            'product_name'=>$this->product_name,
            'product_description'=>$this->product_description,
            'product_rating'=>$this->product_rating,
            'product_price'=>$this->product_price,
            'product_quantity'=>$this->product_quantity,
            'images'=>$this->images,
            'comment'=>$this->comments,
            'items'=>$this->details,
        ];
    }
}
