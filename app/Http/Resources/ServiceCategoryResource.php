<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceCategoryResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "caption" => $this->caption,
            "slug" => $this->slug,
            "image" => $this->image,
            "video_id_eng" => $this->video_id ?? null,
            "video_id_si" => $this->video_id_si ?? null,
            "description" => $this->description,
            "created_at" => $this->created_at->format('Y-m-d H:i:s'),
            'sub_categories' => $this->whenLoaded('subCategories', ServiceSubCategoryResource::collection($this->subCategories)),
            'static_inputs' => $this->whenLoaded('staticInputs', ServiceStaticInputResource::collection($this->staticInputs))
        ];
    }
}
