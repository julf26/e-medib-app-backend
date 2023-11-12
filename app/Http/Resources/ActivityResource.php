<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'activity_name' => $this->activity_name,
            'activity_desc' => $this->activity_desc,
            'met' => $this->met,
            'user' =>  $this->whenLoaded('user'),
            'created_at' => date_format($this->created_at, "d-m-Y H:i:s"),
        ];
    }
}
