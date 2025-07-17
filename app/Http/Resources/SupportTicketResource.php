<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SupportTicketResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "title" => $this->title,
            "slug" => $this->slug,
            "description" => $this->description,
            "status" => $this->status,
            "created_at" => $this->created_at->format('Y-m-d H:i:s'),
            "file" => $this->file !== null ? asset("uploads/service-provider/ticket/" . $this->file) : null,
        ];
    }
}
