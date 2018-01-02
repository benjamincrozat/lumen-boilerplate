<?php

namespace App\Http\Resources;

class PostResource extends \Illuminate\Http\Resources\Json\Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'title'      => $this->title,
            'content'    => $this->content,
            'user'       => new UserResource($this->whenLoaded('user')),
        ];
    }
}
