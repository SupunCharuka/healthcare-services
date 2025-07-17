<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderBannerResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "mobile_image" => asset("uploads/banners/mobile-image/" . $this->mobile_image),
            "is_active" => $this->is_active,
        ];
    }
}
