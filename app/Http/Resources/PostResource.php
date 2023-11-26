<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title' => $this->title,
            'user' => new UserResource($this->whenLoaded('user')),
            'body' => $this->body,
            'image' => $this->media ? $this->media->baseMedia->getUrl() : null,
            'formatted_date' => $this->created_at->diffForHumans(),
            'created_at' => $this->created_at->format('d F Y'),
            'author' => $this->author,
            'summary' =>  $this->summary,
            'status' => $this->status,
            'slug' => $this->slug,
        ];
    }
}
