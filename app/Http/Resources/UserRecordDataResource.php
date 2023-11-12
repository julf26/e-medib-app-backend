<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRecordDataResource extends JsonResource
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
            'bmi' => $this->bmi,
            'bmr' => $this->bmr,
            'disease_history' => $this->disease_history,
            'alergic' => $this->alergic,
            'blood_pressure' => $this->blood_pressure,
            'blood_sugar_level' => $this->blood_sugar_level,
            'cholesterol' => $this->cholesterol,
            'user' =>  $this->whenLoaded('user'),
            'created_at' => date_format($this->created_at, "d-m-Y H:i:s"),
        ];
    }
}
