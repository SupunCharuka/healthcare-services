<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PayHerePaymentResponseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "order_id" => $this->order_id,
            "payment_id" => $this->payment_id,
            "captured_amount" => $this->captured_amount,
            "payhere_amount" => $this->payhere_amount,
            "payhere_currency" => $this->payhere_currency,
            "status_code" => $this->status_code,
            "status" => $this->status,
            "custom_1" => $this->custom_1,
            "status_message" => $this->status_message,
            "method" => $this->method,
            "recurring" => $this->recurring,
        ];
    }
}
