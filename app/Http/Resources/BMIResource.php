<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BMIResource extends JsonResource
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
            'berat_badan' =>  $this->berat_badan,
            'tinggi_badan' =>  $this->tinggi_badan,
            'bmi' =>  $this->bmi,
            'status' =>  $this->status,
            'keterangan' =>  $this->keterangan,
            'created_at' => date_format($this->created_at, "d-m-Y H:i:s"),
        ];
    }
}
