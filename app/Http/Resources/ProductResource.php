<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->media ? $this->media->baseMedia->getUrl() : null,
            'body' => $this->body,
            'formatted_price' => $this->formatted_price,
            'price' => $this->price,
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
