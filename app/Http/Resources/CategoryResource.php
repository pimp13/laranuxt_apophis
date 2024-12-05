<?php

namespace App\Http\Resources;

use App\Facades\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'slug' => $this->slug,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }

    public function withResponse(Request $request, \Illuminate\Http\JsonResponse $response)
    {
        return ApiResponse::success(
            $this->getData(true),
            'Category fetched successfully'
        );
    }
}
