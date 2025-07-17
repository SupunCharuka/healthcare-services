<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "image" => $this->image,
            "description" => $this->description,
            "image_url" => asset("uploads/admin/product-category/" . $this->image),
            //"sub_categories" => $this->when($this->resource->relationLoaded('productSubCategories'), ProductSubCategoryResource::collection($this->productSubCategories)),
        ];
    }
}
