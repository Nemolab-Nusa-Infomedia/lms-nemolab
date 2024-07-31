<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Chapter;

class AdminChapterController extends Controller
{
    public function index() {
        $chapter = Chapter::all();
        dd($chapter);
    }

    public function create() {
        
    }

    public function store(Request $requests) {
        $requests->validate([
            'name' => 'required',
        ]);
                    
        Chapter::create([
            'name' => $requests->name,
            'course_id' => 1, 
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
        ]);

        $chapter = Chapter::findOrFail($id);
        
        $chapter->update([
            'name' => $requests->name,
        ]);     

        return response()->json([
            'message' => 'Data berhasil diedit'
        ], 200);
    }

    public function delete($id) {
        $chapter = Chapter::findOrFail($id); 
        $chapter->delete();
        
        return response()->json([
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}