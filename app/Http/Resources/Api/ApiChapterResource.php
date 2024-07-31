<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiChapterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name_chapter' => $this->name,
            'lesson' => $this->lessons->map(function ($lesson) {
                return [
                    'name_video' => $lesson->name,
                    'link_video' => $lesson->video
                ];
            })
        ];
    }
}