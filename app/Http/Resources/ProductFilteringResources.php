<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductFilteringResources extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->product_name,
            'description'=>$this->product_description,
            'price'=>$this->product_price,
            'quantity'=>$this->product_quantity,
            'discount'=>$this->discount,
            'status'=>$this->status,
            'brand'=>$this->brand->brand_name,
            'category'=>$this->category->category_name,
            'properities'=>$this->properities,
            'arabic name'=>$this->product_nameAR,
            'arabic description'=>$this->product_descriptionAR,
            'tags'=>$this->tags[0]['name'],
            'media'=>$this->media[0]['file_name'],
            'details'=>$this->details,
        ];
    }
}
