<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceCategoryInputResource extends JsonResource
{

    public function toArray($request): array
    {
        parent::toarray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'placeholder' => $this->placeholder,
            'options' => $this->option !== null ? explode(', ', $this->option) : null,
            'is_required' => $this->required === 'true',
        ];
    }
}
