<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => $this->name,
            'is_admin' => $this->is_admin,
            'email' => $this->email,
            'appointments' => AppointmentResource::collection($this->whenLoaded('appointments')),
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
        ];
    }
}
