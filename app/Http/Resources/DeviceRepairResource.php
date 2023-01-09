<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeviceRepairResource extends JsonResource
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
            'title' => $this->pivot->title,
            'body' => $this->pivot->body,
            'price' => money($this->pivot->price, config('constants.currency'))->formatWithoutZeroes(),
        ];;
    }
}
