<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Lesson;
use App\Models\Chapter;
use App\Models\CompleteEpisodeCourse;
use App\Models\Course;

class AdminLessonController extends Controller
{
    /**
     * Menampilkan halaman daftar lessons berdasarkan chapter
     */
    public function index($slug_course, $id_chapter)
    {
        // Mengambil semua lesson yang terkait dengan chapter tertentu
        $lessons = Lesson::where('chapter_id', $id_chapter)->get();

        // Menampilkan halaman daftar lessons dengan data lessons, slug_course, dan id_chapter
        return view('admin.lesson.view', compact('lessons', 'slug_course', 'id_chapter'));
    }

    /**
     * Menampilkan halaman untuk membuat lesson baru
     */
    public function create($slug_course, $id_chapter)
    {
        // Menampilkan halaman form pembuatan lesson dengan slug_course dan id_chapter
        return view('admin.lesson.create', compact('slug_course', 'id_chapter'));
    }

    /**
     * Menyimpan lesson baru ke dalam database
     */
    public function store(Request $requests, $id_chapter)
    {
        // Validasi input untuk memastikan nama dan video lesson diisi
        $requests->validate([
            'name' => 'required',
            'video' => 'required',
        ]);

        // Mendapatkan data chapter dan course yang terkait dengan chapter ini
        $chapter = Chapter::where('id', $id_chapter)->first();
        $course = Course::where('id', $chapter->course_id)->first();

        // Membuat lesson baru dengan nama, video, dan ID chapter yang terkait
        Lesson::create([
            'name' => $requests->name,
            'episode' => Str::random(12), // Menggenerate kode episode secara acak
            'video' => $requests->video,
            'chapter_id' => $id_chapter,
        ]);

        // Menampilkan notifikasi sukses dan kembali ke halaman daftar lessons
        return redirect()->route('admin.lesson', ['slug_course' => $course->slug, $id_chapter])->with('alert', ['type' => 'success', 'message' => 'Data Berhasil Dibuat!']);
    }

    /**
     * Menampilkan halaman untuk mengedit lesson
     */
    public function edit(Request $requests, $slug_course, $id_chapter)
    {
        // Mendapatkan ID lesson dari query parameter
        $id_lesson = $requests->query('id');

        // Mencari data lesson berdasarkan ID
        $lessons = Lesson::where('id', $id_lesson)->first();

        // Menampilkan halaman form edit lesson dengan data lessons, slug_course, dan id_chapter
        return view('admin.lesson.update', compact('lessons', 'slug_course', 'id_chapter'));
    }

    /**
     * Memperbarui data lesson di database
     */
    public function update(Request $requests, $id)
    {
        // Validasi input untuk memastikan nama dan video lesson diisi
        $requests->validate([
            'name' => 'required',
            'video' => 'required',
        ]);

        // Mencari lesson berdasarkan ID
        $lesson = Lesson::findOrFail($id);

        // Mendapatkan data chapter dan course terkait lesson ini
        $chapter = Chapter::where('id', $lesson->chapter_id)->first();
        $course = Course::where('id', $chapter->course_id)->first();

        // Memperbarui data lesson. Jika video diubah, episode baru akan di-generate
        if ($lesson->video != $requests->video) {
            $lesson->update([
                'name' => $requests->name,
                'episode' => Str::random(12), // Menggenerate episode baru jika video berubah
                'video' => $requests->video,
            ]);
        } else {
            $lesson->update([
                'name' => $requests->name,
            ]);
        }

        // Menampilkan notifikasi sukses dan kembali ke halaman daftar lessons
        return redirect()->route('admin.lesson', [$course->slug, 'id_chapter' => $chapter->id])->with('alert', ['type' => 'info', 'message' => 'Data Berhasil Diubah!']);
    }

    /**
     * Menghapus lesson dari database
     */
    public function delete(Request $requests)
    {
        // Mendapatkan ID lesson dari query parameter
        $id_lesson = $requests->query('id');

        // Mencari data lesson, chapter, dan course terkait
        $lesson = Lesson::where('id', $id_lesson)->first();
        $chapter = Chapter::where('id', $lesson->chapter_id)->first();
        $course = Course::where('id', $chapter->course_id)->first();

        // Menghapus data episode yang telah diselesaikan jika ada
        $ep = CompleteEpisodeCourse::where('episode_id', $id_lesson)->first();
        if ($ep) {
            $ep->delete();
        }

        // Menghapus lesson dari database
        $lesson->delete();

        // Menampilkan notifikasi sukses dan kembali ke halaman daftar lessons
        return redirect()->route('admin.lesson', ['slug_course' => $course->slug, 'id_chapter' => $chapter->id])->with('alert', ['type' => 'error', 'message' => 'Data Berhasil Dihapus!']);
    }

}
