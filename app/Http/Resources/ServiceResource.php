<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "title" => $this->title,
            "slug" => $this->slug,
            "service_category_id" => $this->service_category_id,
            "service_category" => $this->whenLoaded('category', new ServiceCategoryResource($this->category)),
            "bank_detail" => $this->whenLoaded('bankDetail', new BankDetailResource($this->bankDetail)),
            "sub_category_id" => $this->sub_categories_id,
            "subcategory" => $this->subcategory->name,
            "district_id" => $this->district_id,
            "district" => $this->whenLoaded('district', $this->district),
            "city_id" => $this->city_id,
            "city" => $this->whenLoaded('city', $this->city),
            "number" => $this->number,
            "description" => $this->description,
            "status" => $this->status,
            "image" => asset("uploads/service-provider/service/" . $this->image),
        ];
    }
}
