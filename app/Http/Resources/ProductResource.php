<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_category_id' => $this->product_category_id,
            'product_category' => $this->productCategory->name,
            'product_subcategory_id' => $this->product_subcategory_id,
            'product_subcategory' => $this->productSubcategory->name,
            'images' => $this->whenLoaded('productImages', ProductImageResource::collection($this->productImages)),
            'variations' => $this->whenLoaded('productVariations', ProductVariationResource::collection($this->productVariations)),
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
        ];
    }
}
