<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BMRResource extends JsonResource
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
            'jenis_kelamin' => $this->jenis_kelamin,
            'berat_badan' =>  $this->berat_badan,
            'tinggi_badan' =>  $this->tinggi_badan,
            'usia' =>  $this->usia,
            'bmr' =>  $this->bmr,
            'status' =>  $this->status,
            'created_at' => date_format($this->created_at, "d-m-Y H:i:s"),
        ];
    }
}
