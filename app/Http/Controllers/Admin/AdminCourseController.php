<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminCourseController extends Controller
{
    public function index() {
        $courses = Course::all();
        // return response()->json($courses);
        dd($courses);
    }

    public function create() {
        // Return a view for creating courses, if needed
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'required|integer',
            'level' => 'required|in:beginner,intermediate,expert',
            'description' => 'nullable|string',
            'mentor_id' => 'required|exists:users,id', 
        ]);

        $coverPath = null;

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName = Str::random(10) . '.' . $cover->getClientOriginalExtension();
            $coverPath = $cover->storeAs('public/images/covers', $coverName);
        }

        Course::create([
            'name' => $request->name,
            'cover' => $coverPath,
            'type' => $request->type,
            'status' => $request->status,
            'price' => $request->price,
            'level' => $request->level,
            'description' => $request->description,
            'mentor_id' => $request->mentor_id,
        ]);

        return response()->json([
            'message' => 'Course successfully created'
        ], 201); // 201 Created
    }

    public function edit($id) {
        $course = Course::findOrFail($id);
        return response()->json($course);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'required|integer',
            'level' => 'required|in:beginner,intermediate,expert',
            'description' => 'nullable|string',
            'mentor_id' => 'required|exists:users,id',
        ]);

        $course = Course::findOrFail($id);
        $coverPath = $course->cover;

        if ($request->hasFile('cover')) {
            if ($coverPath) {
                Storage::disk('public')->delete($coverPath);
            }

            $cover = $request->file('cover');
            $coverName = Str::random(10) . '.' . $cover->getClientOriginalExtension();
            $coverPath = $cover->storeAs('public/images/covers', $coverName);
        }

        $course->update([
            'name' => $request->name,
            'cover' => $coverPath,
            'type' => $request->type,
            'status' => $request->status,
            'price' => $request->price,
            'level' => $request->level,
            'description' => $request->description,
            'mentor_id' => $request->mentor_id,
        ]);

        return response()->json([
            'message' => 'Course successfully updated'
        ], 200);
    }

    public function delete($id) {
        $course = Course::findOrFail($id);

        if ($course->cover) {
            Storage::disk('public')->delete($course->cover);
        }

        $course->delete();

        return response()->json([
            'message' => 'Course successfully deleted'
        ], 200);
    }
}