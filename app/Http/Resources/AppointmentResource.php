<?php

namespace App\Http\Resources;

use App\Models\DeviceRepair;
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
            'last_name' => $this->last_name,
            'appointment_number' => $this->appointment_number,
            'slug' => $this->appointment_number,
            'zip_code' => $this->zip_code,
            'city' => $this->city,
            'address' => $this->address,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'total' => $this->formatted_total,
            'message' => $this->message,
            'phone' => $this->phone,
            'appointment_date' => Carbon::parse($this->appointment_date)->format('d F Y'),
            'appointment_time' => Carbon::parse($this->appointment_time)->format('g:i A'),
            'device_name' => $this->device_name,
            'user' => new UserResource($this->whenLoaded('user')),
            'device' => new DeviceResource($this->whenLoaded('device')),
            'device_repair' => $this->whenLoaded('deviceRepair')
        ];
    }
}
