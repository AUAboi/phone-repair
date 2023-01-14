<?php

namespace App\Http\Resources;

use App\Models\DeviceRepair;
use Illuminate\Http\Resources\Json\JsonResource;

class DeviceResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'image' =>  $this->media ? $this->media->baseMedia->getUrl() : null,
            'brand' => new BrandResource($this->whenLoaded('brand')),
            'repairs' => DeviceRepairResource::collection($this->whenLoaded('repairs'))
        ];
    }
}
