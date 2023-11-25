<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'product_model' => new ProductResource($this->product ?? null),
            'name' => $this->name,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'formatted_total' => $this->formatted_total,
            'formatted_price' => $this->formatted_price
        ];
    }
}
