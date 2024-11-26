<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Category;

class AdminEbookController extends Controller
{
    /**
     * Menampilkan halaman admin eBook
     */
    public function index(Request $request)
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // Tentukan eBook berdasarkan peran pengguna
        // Jika user adalah superadmin, tampilkan semua eBook
        // Jika bukan, tampilkan eBook berdasarkan mentor_id
        $ebooks = $user->role === 'superadmin' ? Ebook::all() : Ebook::where('mentor_id', $user->id)->get();

        // Tampilkan view untuk daftar eBook dengan data yang didapat
        return view('admin.course-ebook.view', compact('ebooks'));
    }

    /**
     * Menampilkan halaman untuk membuat eBook baru
     */
    public function create()
    {
        // Ambil semua kategori (fitur kategori belum diterapkan sepenuhnya)
        $categories = Category::all();

        // Tampilkan halaman untuk membuat eBook
        return view('admin.course-ebook.create', compact('categories'));
    }

    /**
     * Menyimpan data eBook baru
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $validatedData = $request->validate([
            'category' => 'required|in:Frontend Developer,Backend Developer,Wordpress Developer,Graphics Designer,Fullstack Developer,UI/UX Designer',
            'name' => 'required|string',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'nullable|integer',
            'description' => 'required|string',
            'level' => 'required',
            'file_ebook' => 'required|mimes:pdf|max:10240', // Hanya menerima file PDF
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Hanya menerima file gambar
        ]);

        // Jika tipe eBook adalah free, atur harga menjadi 0
        if ($validatedData['type'] === 'free') {
            $validatedData['price'] = 0;
        }

        // Proses upload cover
        $cover = $request->cover;
        $coverName = Str::random(10) . '.' . $cover->getClientOriginalExtension();
        $cover->storeAs('public/images/covers', $coverName); // Simpan di direktori public/images/covers
        $validatedData['cover'] = $coverName;

        // Proses upload file eBook
        $ebookFile = $request->file_ebook;
        $ebookFileName = Str::random(15) . '.' . $ebookFile->getClientOriginalExtension();
        $ebookFile->storeAs('public/file_pdf', $ebookFileName); // Simpan di direktori public/file_pdf
        $validatedData['file_ebook'] = $ebookFileName;

        // Tambahkan slug dan mentor_id
        $validatedData['slug'] = Str::slug($validatedData['name']);
        $validatedData['mentor_id'] = Auth::user()->id;

        // Simpan data eBook ke database
        Ebook::create($validatedData);

        // Tampilkan notifikasi sukses
        Alert::success('Success', 'eBook Berhasil Dibuat');
        return redirect()->route('admin.ebook');
    }

    /**
     * Menampilkan halaman untuk mengedit eBook
     */
    public function edit(Request $requests)
    {
        // Ambil id dari query string
        $id = $requests->query('id');

        // Cari data eBook berdasarkan id
        $ebooks = Ebook::where('id', $id)->first();

        // Tampilkan halaman edit eBook
        return view('admin.course-ebook.update', compact('ebooks'));
    }

    /**
     * Memperbarui data eBook
     */
    public function update(Request $request, Ebook $ebook)
    {
        // Validasi input dari form
        $validatedData = $request->validate([
            'category' => 'required|string|max:255',
            'name' => 'required|string',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'nullable|integer',
            'description' => 'required|string',
            'level' => 'required',
            'file_ebook' => 'nullable|mimes:pdf|max:10240',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Jika tipe eBook adalah free, atur harga menjadi 0
        if ($validatedData['type'] === 'free') {
            $validatedData['price'] = 0;
        }

        // Update cover jika ada file baru
        if ($request->hasFile('cover')) {
            $cover = $request->cover;
            $coverName = Str::random(10) . '.' . $cover->getClientOriginalExtension();
            $cover->storeAs('public/images/covers', $coverName);

            // Hapus cover lama
            Storage::delete('public/images/covers/' . $ebook->cover);
            $validatedData['cover'] = $coverName;
        }

        // Update file eBook jika ada file baru
        if ($request->hasFile('file_ebook')) {
            $ebookFile = $request->file_ebook;
            $ebookFileName = Str::random(15) . '.' . $ebookFile->getClientOriginalExtension();
            $ebookFile->storeAs('public/file_pdf', $ebookFileName);

            // Hapus file eBook lama
            Storage::delete('public/file_pdf/' . $ebook->file_ebook);
            $validatedData['file_ebook'] = $ebookFileName;
        }

        // Update slug
        $validatedData['slug'] = Str::slug($validatedData['name']);

        // Perbarui data eBook di database
        $ebook->update($validatedData);

        // Tampilkan notifikasi sukses
        Alert::success('Success', 'eBook Berhasil Diperbarui');
        return redirect()->route('admin.ebook');
    }

    /**
     * Menghapus eBook
     */
    public function delete(Request $requests)
    {
        // Ambil id dari query string
        $id = $requests->query('id');

        // Cari data eBook berdasarkan id
        $ebook = Ebook::where('id', $id)->first();

        // Hapus data eBook dan file terkait
        $ebook->delete();
        Storage::delete('public/file_pdf/' . $ebook->file_ebook); // Hapus file eBook
        Storage::delete('public/images/covers/' . $ebook->cover); // Hapus cover

        // Tampilkan notifikasi sukses
        Alert::success('Success', 'eBook Berhasil Dihapus');
        return redirect()->route('admin.ebook');
    }

}
