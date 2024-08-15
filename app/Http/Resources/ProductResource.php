<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => ucwords($this->name),
            'description' => $this->description,
            'price' => $this->formatRupiah($this->price),
            'image_url' => $this->image_url,
            // 'category_id' => $this->category_id,
            'category' => new CategoryResource($this->whenLoaded('category')),
            // 'user_id' => $this->user_id,
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }

    private function formatRupiah($value)
    {
        return 'Rp ' . number_format($value, 0, ',', '.');
    }
}
