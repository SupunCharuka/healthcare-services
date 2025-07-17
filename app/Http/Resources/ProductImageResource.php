<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductImageResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'images' => $this->images,
            'image_url' => asset("uploads/admin/product-images/{$this->images}"),
            'thumb_image_url' => asset("uploads/admin/product-images/thumb/{$this->images}"),
        ];
    }
}
