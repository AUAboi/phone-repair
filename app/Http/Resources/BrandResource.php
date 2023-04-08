<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
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
            'mobile' => $this->mobile,
            'tablet' => $this->tablet,
            'laptop' => $this->laptop,
            'image' =>  $this->media ? $this->media->baseMedia->getUrl() : null,
            'slug' => $this->slug,
            'devices' => DeviceResource::collection($this->whenLoaded('devices'))
        ];
    }
}
