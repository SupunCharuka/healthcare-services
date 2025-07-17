<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HealthProfileResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "title" => $this->title,
            "created_at" => $this->created_at->format('Y-m-d H:i:s'),
            "file" => $this->file !== null ? asset("uploads/customer/health-profile/" . $this->file) : "https://img.icons8.com/fluency/48/000000/pdf-mail.png",
        ];
    }
}
