<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceStaticInputResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->serviceStaticInput?->id,
            'name' => $this->serviceStaticInput?->name,
            'is_active' => $this->availability === 1
        ];
    }
}
