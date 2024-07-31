<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiCourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name_mentor' => $this->name,
            'course' => $this->courses->map(function ($course) {
                return [
                    'id_course' => $course->id,
                    'cover_course' => $course->cover,
                    'title_course' => $course->name,
                    'description_course' => $course->description,
                    'level_course' => $course->level,
                    'type_course' => $course->type,
                    'price_course' => $course->price,
                    
                    // Add other properties you need from the Course model
                ];
            })
        ];
    }
}