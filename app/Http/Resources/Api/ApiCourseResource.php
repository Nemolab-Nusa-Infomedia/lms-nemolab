<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ApiCourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $imagesMentor = "nemolab/admin/img/avatar.png";

        if ($this->avatar != "default.png") {
            $imagesMentor = url(Storage::url("images/avatars/" . $this->avatar));
        }

        return [
            'name_mentor' => $this->name,
            'avatars_mentor' => $imagesMentor,
            'course' => $this->courses->map(function ($course) {
                return [
                    'slug_course' => $course->slug,
                    'category_course' => $course->category,
                    'cover_course' => url(Storage::url('images/covers/' . $course->cover)),
                    'title_course' => $course->name,
                    'description_course' => $course->description,
                    'level_course' => $course->level,
                    'type_course' => $course->type,
                    'price_course' => number_format($course->price, 0),
                    // Add other properties you need from the Course model
                ];
            }),
            'message' => 'course tersedia'
        ];
    }
}