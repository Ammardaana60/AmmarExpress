<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PocketResources extends JsonResource
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
            'user name'=>$this->user->name,
            'cash'=>$this->cash,
            'currency'=>$this->currency,
        ];
    }
}
