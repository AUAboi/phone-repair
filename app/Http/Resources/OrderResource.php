<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'user' => new UserResource($this->whenLoaded('user')),
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'created_at' =>  $this->created_at->diffForHumans(),
            'order_status' => $this->order_status,
            'order_no' => $this->order_no,
            'products' => $this->whenLoaded('products'),
            'slug' => $this->order_no,
            'total' => $this->formatted_total
        ];
    }
}
