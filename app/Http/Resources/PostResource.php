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
        // 1: These are Illuminate\Support\Carbon instances. They implement
        // the magic __toString() method, so you can just cast them.

        return [
            'id'         => $this->id,
            'created_at' => (string) $this->created_at, // 1
            'updated_at' => (string) $this->updated_at, // 1
            'title'      => $this->title,
            'content'    => $this->content,
            'user'       => new UserResource($this->user),
        ];
    }
}
