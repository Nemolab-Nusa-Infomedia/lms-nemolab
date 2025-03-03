<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Category;
use App\Models\Course;
use App\Models\Tools;
use App\Models\Chapter;
use App\Models\CompleteEpisodeCourse;
use App\Models\Lesson;
use App\Models\Forum;
use App\Models\Transaction;

class AdminCourseController extends Controller
{
    /**
     * Menampilkan halaman course admin
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->role === 'superadmin') {
            //jika superadmin maka menampilkan seluruh data course
            $courses = Course::with('users')->OrderBy('id', 'DESC')->get();
        } else {
            //jika selain itu('mentor') maka menampilkan seluruh data course yang dimiliki mentor, gunakan mentor_id
            $courses = Course::where('mentor_id', $user->id)->OrderBy('id', 'DESC')->get();
        }

        return view('admin.course-video.view', compact('courses'));
    }


// menampilkan tampilan tambah data course
    public function create()
    {
        $category = Category::all();
        $tools = Tools::all();
        return view('admin.course-video.create', compact('category', 'tools'));
    }

    /**
     * Fungsi untuk mengirim data ke database dengan melewati perentara model
     */
    public function store(Request $request)
    {
        /**
         * Melakukan Validasi Request yang dikiriman
         * 
         * (required artinya wajib dan nullable artinya boleh kosong)
         * (sting artinya data harus berupa karakter, image artinya data harus berupa gambar/file,'in: draft,published' artinya data harus berisi salah satu dari keduanya)
         * (max membuat batas maksimum panjang data, mimes berguna untuk memastikan ekstensi dari file yang dikirimkan)
         * 
         */
        $request->validate([
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'required|integer',
            'level' => 'required|in:beginner,intermediate,expert',
            'description' => 'required|string',
            'tools' => 'required|array', // Pastikan tools adalah array
            'tools.*' => 'exists:tbl_tools,id', // Setiap elemen tools harus valid di tabel tools
            'link_grub' => 'required'
        ]);
        if ($request['type'] === 'free') {
            $request['price'] = 0;
        }

        /*
         * Str::random(10) digunakan untuk membuat nama acak sebanyak 10 karakter
         * $images->getClientOriginalName() digunakan untuk mendapatkan nama file asli
         * $images->storeAs('public/images/covers/' + $imagesGetNewName) digunakan untuk menyimpan file ke folder public/images/covers
         * 
         * Jika resources diisi, maka $resources akan berisi nilai resources yang dikirimkan
         * Jika resources kosong, maka $resources akan berisi null
         *
        */
        $images = $request->cover; //menyimoan data user pada $images
        $imagesGetNewName = Str::random(10) . $images->getClientOriginalName(); //membuat nama acak lalu dikombinasikan dengan nama asli
        $images->storeAs('public/images/covers/' . $imagesGetNewName); //menyimpan file di storage/app/public/images/covers
        $resources = 'null'; //secara default resource bernilai null

        //jika terdapat request resource dikirimkan maka $resources akan berisi nilai yang dikirimkan
        if ($request->resources) {
            $resources = $request->resources;
        }
        /**
         * Memasukan data dengan create melalui model Course terlebih dahulu
         * mengambil nilai dari request
         */
        $course = Course::create([
            'category' => $request->category,
            'name' => $request->name,
            'cover' => $imagesGetNewName,
            'type' => $request->type,
            'status' => $request->status,
            'price' => $request->price,
            'level' => $request->level,
            'description' => $request->description,
            'resources' => $resources,
            'link_grub' => $request->link_grub,
            'mentor_id' => Auth::user()->id,
        ]);
        // Menghubungkan course dengan tools menggunakan relasi many-to-many (bisa diilhat di model tools)
        $tools = is_string($request->tools) ? json_decode($request->tools, true) : $request->tools;

        if (is_array($tools)) {
            // Convert the tools array to a simple array of IDs
            $toolIds = array_map('intval', $tools);
            $course->tools()->sync($toolIds);
        } else {
            return back()->withErrors(['tools' => 'Invalid tools data.']);
        }
        return redirect()->route('admin.course')->with('alert', ['type' => 'success', 'message' => 'Data Berhasil Dibuat!']);
    }

    /**
     * menampilkan halaman edit
     * mengambil id dari request query yang sebelumnya dikirim (dari tombol, setiap tombol memiliki route dengan id sendiri)
     */
    public function edit(Request $requests)
    {
        $id = $requests->query('id');
        $category = Category::all(); //memuat seluruh data category (fitur ini belum diterapkan jika ingin menerapkan cek commit versi lama di github)
        $course = Course::where('id', $id)->first(); //menampilan data course sesuai id sebelumnya
        $tools = Tools::all(); //memuat seluruh data tool
        $coursetool = Course::with('tools')->findOrFail($course->id);
        return view('admin.course-video.update', compact('course', 'category', 'coursetool', 'tools'));
    }

        /**
         * Melakukan Validasi Request yang dikiriman
         * 
         * (required artinya wajib dan nullable artinya boleh kosong)
         * (sting artinya data harus berupa karakter, image artinya data harus berupa gambar/file,'in: draft,published' artinya data harus berisi salah satu dari keduanya)
         * (max membuat batas maksimum panjang data, mimes berguna untuk memastikan ekstensi dari file yang dikirimkan)
         * 
         */
    public function update(Request $request, $id)
    {
        $course = Course::where('id', $id)->first();

        $request->validate([
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', //membuat cover wajib disi
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'required|integer',
            'level' => 'required|in:beginner,intermediate,expert',
            'description' => 'required|string',
            'tools' => 'required|array', // Pastikan tools adalah array
            'tools.*' => 'exists:tbl_tools,id', // Setiap elemen tools harus valid di tabel tools
            'link_grub' => 'required',
        ]);

        if ($request['type'] === 'free') {
            $request['price'] = 0;
        }
        $images = $request->cover; //simpan data cover di $images
        //jika data $images terisi maka akan menggantikan file sebelumnya distorage
        if ($images) {
            $imagesGetNewName = Str::random(10) . $images->getClientOriginalName();//sama seperti sebelumnya
            $images->storeAs('public/images/covers/' . $imagesGetNewName); //mengirim file ke storage
            $data['cover'] = $imagesGetNewName; //mengganti nama file sebelumnya dengan yang baru (agar cover terbaru tidak terhapus pada sesi selanjutnya) pada sesi ini data belum dikirimkan ke databse
            Storage::delete('public/images/covers/' . $course->cover); //menghapus cover dari storage berdasarkan nama file sebelum diubah
        } else {
            $data['cover'] = $course->cover; //jika tidak ada cover baru dikirimkan maka gunakan data lama
        }

        $slug = Str::slug($request->name); //mengubah slug agar sama dengan nama course

        $resources = 'null'; //fungsi yang sama seperti di methode store

        if ($request->resources) {
            $resources = $request->resources;
        }
        $course->update([
            'category' => $request->category,
            'name' => $request->name,
            'slug' => $slug,
            'cover' => $data['cover'], //mennganti data cover lama denga terbaru yang disimpan $data['cover']
            'type' => $request->type,
            'status' => $request->status,
            'price' => $request->price,
            'level' => $request->level,
            'resources' => $resources,
            'link_grub' => $request->link_grub,
            'description' => $request->description,
        ]);

        $tools = is_string($request->tools) ? json_decode($request->tools, true) : $request->tools;

        if (is_array($tools)) {
            // Convert the tools array to a simple array of IDs
            $toolIds = array_map('intval', $tools);
            $course->tools()->sync($toolIds);
        } else {
            return back()->withErrors(['tools' => 'Invalid tools data.']);
        }
        
        return redirect()->route('admin.course')->with('alert', ['type' => 'info', 'message' => 'Data Berhasil Diubah!']);
    }

    /**
     * mengahapus data berdasarkan id yang dikirimkan
     */
    public function delete(Request $requests)
    {
        // id course
        $id = $requests->query('id');

        $course = Course::where('id', $id)->first();

        // check course apakah terdapat coursre
        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }

        // Delete images course
        if ($course->cover && Storage::exists('public/images/covers/' . $course->cover)) {
            Storage::delete('public/images/covers/' . $course->cover);
        }

        // ambil semua chapters dari id course
        $chapters = Chapter::where('course_id', $id)->get();

        // foreach semua chapter dan semua lesson yang mempunyai id course sama untuk hapus lesson
        foreach ($chapters as $chapter) {
            Lesson::where('chapter_id', $chapter->id)->each(function ($lesson) {
                $totalep = CompleteEpisodeCourse::where('episode_id', $lesson->id)->count();

                if ($totalep > 0) {
                    CompleteEpisodeCourse::where('episode_id', $lesson->id)->delete();
                }


                $lesson->delete();
            });

            $chapter->delete();
        }

        Transaction::where('course_id', $id)->delete();
        $course->delete();
        return redirect()->route('admin.course')->with('alert', ['type' => 'error', 'message' => 'Data Berhasil Dihapus!']);
    }
}
