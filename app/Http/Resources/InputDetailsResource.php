<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Str;

class InputDetailsResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'inquiry_id' => $this->inquiry_id,
            'input_id' => $this->input_id,
            'name' => $this->input->name,
            'data' => $this->when(
                Str::endsWith($this->data, ['.pdf', '.jpg', '.jpeg', '.png', '.gif']),
                asset('uploads/frontend/inquiry/file/' . $this->data),
                $this->data,
            ),
            'is_file' => $this->when(Str::endsWith($this->data, ['.pdf', '.jpg', '.jpeg', '.png', '.gif']), true, false),
            'is_pdf' => $this->when(Str::endsWith($this->data, ['.pdf']), true, false),
        ];
    }
}
