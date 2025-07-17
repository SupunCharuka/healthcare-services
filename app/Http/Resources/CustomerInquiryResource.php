<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerInquiryResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "service_category_id" => $this->service_category_id,
            "service_category" => $this->serviceCategory->name,
            'user_id' => $this->user_id,
            //'user' => $this->user,
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "province" => $this->whenLoaded('province', $this->province->name),
            "district" => $this->whenLoaded('district', $this->district->name),
            "city" => $this->whenLoaded('city', $this->city->name),
            "service_id" => $this->service_id,
            "is_video_call" => $this->is_video_call,
            "appointment_datetime" => $this->appointment_datetime,
            "assigned_to" => $this->when($this->service_id !== null && $this->service->user_id !== null, $this->service?->user?->name),
            "cost" => $this->cost,
            "latitude" => $this->latitude !== null ? (float)$this->latitude : null,
            "longitude" => $this->longitude !== null ? (float)$this->longitude : null,
            "status" => $this->status,
            "member_status" => $this->member_status,
            "latest_conversation" => $this->whenLoaded('latestConversation', new InquiryConversationResource($this->latestConversation)),
            //            $this->mergeWhen($this->status !== 2, [
            //                'first-secret' => 'value',
            //                'second-secret' => 'value',
            //            ]),
            'input_details' => $this->whenLoaded('inputDetails', InputDetailsResource::collection($this->inputDetails)),
            "created_at" => $this->created_at->format('Y-m-d H:i:s'),
            "created_at_format" => $this->created_at->format('M d, Y h:i A'),
            //"input_details" => InputDetailsResource::collection($this->whenLoaded('inputDetails')),
        ];
    }
}
