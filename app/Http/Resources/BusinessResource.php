<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BusinessResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "address" => $this->address,
            "postcode" => $this->postcode,
            "district_id" => $this->district_id,
            "district" => $this->district_id !== null ? $this->whenLoaded('district', $this->district) : null,
            "city_id" => $this->city_id,
            "city" => $this->city_id !== null ? $this->whenLoaded('city', $this->city) : null,
            "owner_name" => $this->owner_name,
            "registration_no" => $this->registration_no,
            "document" => $this->document,
            "document_path" => $this->document !== null ? asset("uploads/service-provider/business/profile/" . $this->document) : null,
            "status" => $this->status,
        ];
    }
}
