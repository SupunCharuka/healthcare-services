<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariationResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "product_id" => $this->product_id,
            "name" => $this->name,
            "price" => (float)$this->price,
            "discount" => (float)$this->discount,
            "quantity" => (int)$this->quantity,
            "description" => $this->description,
        ];
    }
}
