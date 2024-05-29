<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RepresentationResource extends JsonResource
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
            'spectacle' => $this->show->title,
            'lieu' => $this->LocationDesignation,
            'schedule' => $this->schedule->format('Y-m-d H:i'),
        ];
    }
}
