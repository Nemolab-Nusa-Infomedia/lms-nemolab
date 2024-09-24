<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;

class AdminChapterController extends Controller
{
    public function index($slug) {
        $id =  Course::where('slug', $slug)->first()->id;
        
        $chapters = Chapter::where('course_id', $id)->get();
        return view('admin.chapter.view', compact('chapters', 'slug', 'id'));
    }

    public function create($slug, $id_course) {
        return view('admin.chapter.create', compact('slug', 'id_course'));
    }


    public function store(Request $requests, $id_chapter) {
        $requests->validate([
            'name' => 'required',
        ]);
        
        Chapter::create([
            'name' => $requests->name,
            'course_id' => $id_chapter, 
        ]);

        $course = Course::where('id', $id_chapter)->first();
        
        Alert::success('Success', 'Chapter Berhasil Di Buat');
        return redirect()->route('admin.chapter', $course->slug);
    }

    public function edit($slug, $id_chapter) {
        $chapters = Chapter::where('id', $id_chapter)->first();
        return view('admin.chapter.update', compact('chapters', 'slug'));
    }

    public function update(Request $requests, $id) {
        $requests->validate([
            'name' => 'required',
        ]);

        $chapter = Chapter::where('id', $id)->first(); 
        
        $chapter->update([
            'name' => $requests->name,
        ]);     


        $course = Course::where('id', $chapter->course_id)->first();
        
        Alert::success('Success', 'Chapter Berhasil Di Edit');
        return redirect()->route('admin.chapter', $course->slug);
    }

    public function delete($id) {
        $chapter = Chapter::find($id);
        if ($chapter) {
            Lesson::where('chapter_id', $chapter->id)->delete();
            $chapter->delete();
    
            $course = Course::where('id', $chapter->course_id)->first();
            Alert::success('Success', 'Chapter Berhasil Di Hapus');
        } else {
            Alert::error('Error', 'Chapter tidak ditemukan');
        }
        return redirect()->route('admin.chapter', $course->slug);
    }    
}