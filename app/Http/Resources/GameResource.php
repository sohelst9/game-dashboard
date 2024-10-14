<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class GameResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'game_link' => $this->game_link,
            'category' => $this->category,
            'image' => $this->image,
            'description' => $this->description,
            'short_desc' => Str::limit(strip_tags($this->description), 100),
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
