<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InquiryReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "service_category" => $this->inquiry->serviceCategory->name,
            "service_user_name" => $this->inquiry->service->user->name,
            "inquiry_id" => $this->inquiry_id,
            "rating" => $this->rating,
            "title" => $this->title,
            "message" => $this->message,
            "status" => $this->status,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "created_at_format" => $this->created_at->format('d M Y, h:iA'),
        ];
    }
}
