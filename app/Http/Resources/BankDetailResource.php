<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BankDetailResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "service_id" => $this->service_id,
            "bank_id" => $this->bank_id,
            "branch_id" => $this->branch_id,
            //"service" => $this->service_id === null ? null : new ServiceResource($this->service),
            "account_holder" => $this->account_holder,
            "account_number" => $this->account_number,
            "bank_book" => $this->bank_book !== null ? asset("uploads/service-provider/bank-details/bank-book/" . $this->bank_book) : null,
        ];
    }
}
