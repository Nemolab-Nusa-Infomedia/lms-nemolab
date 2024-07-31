<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lesson;

class AdminLessonController extends Controller
{
    public function index() {
        $lesson = Lesson::all();
        dd($lesson);
    }

    public function create() {
        
    }

    public function store(Request $requests) {
        $requests->validate([
            'name' => 'required',
            'video' => 'required|url',
        ]);

        Lesson::create([
            'name' => $requests->name,
            'video' => $requests->video,
            'chapter_id' => 1,
        ]);
        
        return response()->json([
            'message' => 'Data berhasil dibuat'
        ], 200);
    }

    public function edit() {
        
    }

    public function update(Request $requests, $id) {
        $requests->validate([
            'name' => 'required',
            'video' => 'required|url',
        ]);

        $lesson = Lesson::findOrFail($id);

        $lesson->update([
            'name' => $requests->name,
            'video' => $requests->video,
            'chapter_id' => 1,
        ]);     

        return response()->json([
            'message' => 'Data berhasil diedit'
        ], 200);
    }

    public function delete($id) {
        $lesson = Lesson::findOrFail($id); 
        $lesson->delete();
        
        return response()->json([
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}