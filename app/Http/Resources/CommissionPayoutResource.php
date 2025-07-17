<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommissionPayoutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $invoice_amount = $this->invoice->amount ?? 0;
        $commission_percentage = $this->serviceCategory->commission ?? 0;
        $commission_amount = ($commission_percentage / 100) * $invoice_amount;
        return [
            "invoice_id" => $this->invoice->id,
            "inquiry_id" => $this->id,
            "customer_name" => $this->name,
            "service_category_name" => $this->serviceCategory->name,
            "is_invoice_paid" => $this->invoice->paid,
            "invoice_amount" => $invoice_amount,
            "commission_percentage" => $commission_percentage,
            "commission_amount" => $commission_amount,
            "payout_amount" => $invoice_amount - $commission_amount,
            "status" => $this->when($this->service->commissionPayouts->isNotEmpty(), "paid", 'unpaid')
        ];
    }
}
