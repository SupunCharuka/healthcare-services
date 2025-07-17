<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use JsonException;

class InquiryInvoiceResource extends JsonResource
{

    /**
     * @throws JsonException
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "inquiry_id" => $this->inquiry_id,
            "inquiry" => $this->whenLoaded('inquiry', new CustomerInquiryResource($this->inquiry)),
            "amount" => $this->amount,
            "payment_type" => $this->payment_type,
            "document" => $this->when($this->document !== null, asset("uploads/customer/bank-transfer/file/$this->document", null)),
            "comment" => $this->comment,
            "is_paid" => $this->paid,
            "is_rejected" => $this->rejected_at !== null,
            "rejected_at" => $this->rejected_at,
//            "payment_response" => $this->payment_response != null ? json_decode($this->payment_response, true, 512, JSON_THROW_ON_ERROR) : null,
            "payment_response" => $this->payment_response != null ? new PayHerePaymentResponseResource(json_decode($this->payment_response, false, 512, JSON_THROW_ON_ERROR)) : null,
            "created_at" => $this->created_at->format('Y-m-d H:i:s'),
            "created_at_format" => $this->created_at->format('M d, Y h:i A'),
            "updated_at" => $this->updated_at,
        ];
    }
}
