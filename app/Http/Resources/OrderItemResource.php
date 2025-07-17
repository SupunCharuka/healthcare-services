<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'product_id' => $this->product_id,
            'product_variation_id' => $this->product_variations_id,
            'product' => new ProductResource($this->product),
            'product_image' => $this->product->productImages ?
                storage('uploads/admin/product-images/thumb/' . $this->product->productImages->first()->images)
                : null,
            'variation' => new ProductVariationResource($this->productVariation),
            'quantity' => $this->qty,
            'price' => (float)$this->price,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            "created_at_format" => $this->created_at->format('M d, Y h:i A'),
        ];
    }
}
