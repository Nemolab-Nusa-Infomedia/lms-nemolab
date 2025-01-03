<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\CompleteEpisodeCourse;

class AdminChapterController extends Controller
{

   /**
     * Menampilkan halaman chapter berdasarkan slug course
     */
    public function index($slug_course)
    {
        // Mencari ID course berdasarkan slug yang diberikan
        $id_course = Course::where('slug', $slug_course)->first()->id;

        // Mengambil semua chapter yang berhubungan dengan course tersebut, diurutkan berdasarkan waktu pembuatan
        $chapters = Chapter::where('course_id', $id_course)->orderBy('created_at', 'ASC')->get();

        // Menampilkan halaman view chapter dengan data slug_course, chapters, dan id_course
        return view('admin.chapter.view', compact('slug_course', 'chapters', 'id_course'));
    }

    /**
     * Menampilkan halaman untuk membuat chapter baru
     */
    public function create($slug_course)
    {
        // Menampilkan halaman form pembuatan chapter dengan slug_course
        return view('admin.chapter.create', compact('slug_course'));
    }

    /**
     * Menyimpan chapter baru ke dalam database
     */
    public function store(Request $requests, $slug_course)
    {
        // Mencari ID course berdasarkan slug yang diberikan
        $id = Course::where('slug', $slug_course)->first()->id;

        // Validasi input untuk memastikan nama chapter diisi
        $requests->validate([
            'name' => 'required',
        ]);

        // Membuat chapter baru dengan nama dan ID course yang terkait
        Chapter::create([
            'name' => $requests->name,
            'course_id' => $id,
        ]);

        // Menampilkan notifikasi sukses dan kembali ke halaman daftar chapter
        Alert::success('Success', 'Chapter Berhasil Di Buat');
        return redirect()->route('admin.chapter', $slug_course);
    }

    /**
     * Menampilkan halaman untuk mengedit chapter
     */
    public function edit(Request $requests, $slug_course)
    {
        // Mendapatkan ID chapter dari query parameter
        $id = $requests->query('id');

        // Mencari data chapter berdasarkan ID
        $chapters = Chapter::where('id', $id)->first();

        // Menampilkan halaman form edit chapter dengan data chapter dan slug_course
        return view('admin.chapter.update', compact('chapters', 'slug_course'));
    }

    /**
     * Memperbarui data chapter di database
     */
    public function update(Request $requests, $slug_course, $id_chapter)
    {
        // Validasi input untuk memastikan nama chapter diisi
        $requests->validate([
            'name' => 'required',
        ]);

        // Mencari chapter berdasarkan ID
        $chapter = Chapter::where('id', $id_chapter)->first();

        // Memperbarui nama chapter
        $chapter->update([
            'name' => $requests->name,
        ]);

        // Menampilkan notifikasi sukses dan kembali ke halaman daftar chapter
        Alert::success('Success', 'Chapter Berhasil Di Edit');
        return redirect()->route('admin.chapter', $slug_course);
    }

    /**
     * Menghapus chapter dan semua lesson yang terkait
     */
    public function delete(Request $requests)
    {
        // Mendapatkan ID chapter dari query parameter
        $id = $requests->query('id');

        // Mencari data chapter berdasarkan ID
        $chapter = Chapter::where('id', $id)->first();

        // Menghapus semua lesson yang berhubungan dengan chapter ini
        Lesson::where('chapter_id', $chapter->id)->each(function ($lesson) {
            // Menghapus data episode yang sudah diselesaikan terkait dengan lesson ini
            $totalep = CompleteEpisodeCourse::where('episode_id', $lesson->id)->count();
            if ($totalep > 0) {
                CompleteEpisodeCourse::where('episode_id', $lesson->id)->delete();
            }

            // Menghapus lesson
            $lesson->delete();
        });

        // Menghapus chapter
        $chapter->delete();
        Alert::success('Success', 'Chapter Berhasil Di Hapus');
        return redirect()->back();
    }

}
