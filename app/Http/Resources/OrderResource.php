<?php

namespace App\Http\Resources;

use App\Enums\OrderStatusEnum;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonException;

class OrderResource extends JsonResource
{

    /**
     * @throws JsonException
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            'user_id' => $this->user_id,
            'user' => new UserResource($this->user),
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'mobile_number' => $this->number,
            'province' => $this->province->name,
            'district' => $this->district->name,
            'city' => $this->city->name,
            'province_id' => null,
            'district_id' => (int)$this->district_id,
            'city_id' => (int)$this->city_id,
            'payment_method' => $this->payment_method,
            'bank_receipt' => $this->bank_receipt !== null ? storage('uploads/customer/order/bank-receipt/' . $this->bank_receipt) : null,
            'bank_receipt_description' => $this->bank_receipt_description,
            "payment_response" => $this->payment_response !== null ? new PayHerePaymentResponseResource(json_decode($this->payment_response, false, 512, JSON_THROW_ON_ERROR)) : null,
            'total_amount' => (float)$this->amount,
            'status' => OrderStatusEnum::getKeyByValue($this->status),
            'orderItems' => OrderItemResource::collection($this->orderItems),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            "created_at_format" => $this->created_at->format('M d, Y h:i A'),
        ];
    }
}
