<?php

namespace App\Http\Resources;

use App\Models\User;
use Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class InquiryConversationResource extends JsonResource
{

    private function getProfilePhoto(User $user)
    {
        return $this->when($user->profile_photo_path !== null, $user->profile_photo_url, "https://robohash.org/{$user->name}.png");
    }

    public function toArray($request)
    {
        return [
            'author' => [
                'firstName' => explode(" ", $this->sender->name)[0],
                'id' => (string)$this->sender->id,
                'imageUrl' => $this->sender->profile_photo_url,
                'lastName' => explode(" ", $this->sender->name)[1] ?? null,
            ],
            'receiver_profile_photo_url' => Auth::user()->id === $this->inquiry->user_id ?
                $this->getProfilePhoto($this->inquiry->service->user) :
                $this->getProfilePhoto($this->inquiry->user),
            'remoteId' => (string)$this->id,
            'id' => (string)$this->id,
            'repliedMessage' => $this->when($this->repliedMessage !== null, new self($this->repliedMessage), null),
            'text' => $this->text,
            'uri' => $this->when($this->attachment_name !== null, asset("uploads/conversations/$this->attachment_name", null)),
            'name' => $this->name,
            'mimeType' => $this->mime_type,
            'width' => (float)$this->width,
            'height' => (float)$this->height,
            'size' => (float)$this->size,
            'status' => $this->status,
            'type' => $this->type,
            'createdAt' => $this->when($this->created_at !== null, \Carbon::parse($this->created_at)->timestamp * 1000),
            'updatedAt' => $this->when($this->updated_at !== null, \Carbon::parse($this->updated_at)->timestamp * 1000),
        ];
    }
}
