<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => $this->image,
            'summary' => $this->summary,
            'body' => $this->body,
            'visits' => $this->visits,
            'published_at' => $this->published_at,
            'is_active' => $this->is_active,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'author' => [
                'id' => $this->user->id,
                'fullName' => $this->user->full_name,
                'email' => $this->user->email
            ],
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
                'description' => $this->category->description
            ]
        ];
    }
}
