<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartItemRescource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'cart_id'=>$this->cart_id,
            'name'=>$this->product->product_name,
            'description'=>$this->product->product_description,
            'arabic name'=>$this->product->product_nameAR,
            'arabic description'=>$this->product->product_descriptionAR,
            'price'=>$this->product->product_price,
            'quantity'=>$this->quantity,
        ];
    }
}
