<?php

namespace App\Http\Resources;

use App\Models\DeviceRepair;
use App\Models\Repair;
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
            'repairs' => DeviceRepairResource::collection($this->whenLoaded('repairs')),
            'device_repairs' => $this->whenLoaded('repairs', function () {
                return Repair::all()->transform(fn ($repair) => [
                    'id' => $repair->id,
                    'repair' => $repair->title,
                    'device_repairs' => DeviceRepair::where('device_id', $this->id)->where('repair_id', $repair->id)->get()
                ])->filter(function ($repair) {
                    return $repair['device_repairs']->count();
                });
            })
        ];
    }
}
