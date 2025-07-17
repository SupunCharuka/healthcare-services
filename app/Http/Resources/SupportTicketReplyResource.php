<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SupportTicketReplyResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "ticket_id" => $this->ticket_id,
            //"ticket" => $this->ticket_id !== null ? $this->whenLoaded('ticket', $this->ticket) : null,
            "user_id" => $this->user_id,
            "admin_id" => $this->admin_id,
            "admin" => $this->admin_id !== null ? $this->whenLoaded('admin', $this->admin) : null,
            "reply" => $this->reply,
            "attachment" => $this->attachment !== null ? asset("uploads/service-provider/ticket/reply/" . $this->attachment) : null,
            "created_at" => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
