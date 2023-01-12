<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
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
            'first_name' => $this->first_name,
            'zip_code' => $this->zip_code,
            'city' => $this->city,
            'address' => $this->address,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'user' => new UserResource($this->whenLoaded('user')),
            'device' => new DeviceResource($this->whenLoaded('device')),
            'appointment_date' => Carbon::parse($this->appointment_date)->format('d F Y'),
            'appointment_time' => Carbon::parse($this->appointment_time)->format('g:i A')

        ];
    }
}
