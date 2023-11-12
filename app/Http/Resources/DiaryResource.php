<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiaryResource extends JsonResource
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
            'gambar_luka' => $this->gambar_luka,
            'catatan_luka' => $this->catatan_luka,
            'catatan' => $this->catatan,
            'user' =>  $this->whenLoaded('user'),
            'created_at' => date_format($this->created_at, "d-m-Y H:i:s"),
        ];
    }
}
