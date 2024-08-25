<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => new UserResource($this->user),
            'seller' => new UserResource($this->seller),
            'order_code' => $this->order_code,
            'total_price' => $this->total_price,
            'payment_status' => $this->payment_status,
            'payment_url' => $this->payment_url,
            'delivery_address' => $this->delivery_address,
            'order_items' => OrderItemResource::collection($this->orderItems),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
