<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Price;

class ShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id, // revient a faire $this->resource->id car notre model Show se trouve dans $this->resource
            'title' => $this->title,
            'description' => $this->description,
            'auteur' => $this->auteurs,
            'poster_url' => $this->poster_url,
            'duree' => $this->duration,
            'location' => LocationResource::make($this->whenLoaded('location')),
            'Annee' => $this->created_in,
        ];
    }
}
