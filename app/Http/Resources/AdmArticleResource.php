<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdmArticleResource extends JsonResource
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
            'media' => $this->media?->name,
            'title' => $this->title,
            'views' => $this->views,
            'author' => [
                'first_name' => $this->user?->first_name,
                'last_name' => $this->user?->last_name,
            ],
            'status' => $this->status,
            'category' => $this->category?->name,
        ];
    }
}
