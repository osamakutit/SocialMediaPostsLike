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
            'author' => $this->user->name,
            'title' => $this->title,
            'text' => $this->text,
            'image' => $this->image,
        ];
    }

    // public function formatSingleItem()
    // {
    //     return [
    //         'title' => $this->title,
    //         'image' => $this->image,
    //         'author' => $this->user->name,
    //     ];
    // }
}
