<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'category' => $this->category->name,
            'title' => $this->title,
            'author' => new UserResource($this->user),
            'text' => $this->text,
            'image' => $this->image,
            'likes' => $this->likes->where('liked',1)->count(),
            'comment' => $this->likes->where('comment',!null)->count(),
        ];
    }
}
