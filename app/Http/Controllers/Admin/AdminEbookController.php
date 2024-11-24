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
    public function index(Request $request)
    {
        $user = Auth::user();
        $ebooks = $user->role === 'superadmin' ? Ebook::all() : Ebook::where('mentor_id', $user->id)->get();
        return view('admin.course-ebook.view', compact('ebooks'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.course-ebook.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category' => 'required|in:Frontend Developer,Backend Developer,Wordpress Developer,Graphics Designer,Fullstack Developer,UI/UX Designer',
            'name' => 'required|string',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'nullable|integer',
            'description' => 'required|string',
            'level' => 'required',
            'file_ebook' => 'required|mimes:pdf|max:10240',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validatedData['type'] === 'free') {
            $validatedData['price'] = 0;
        }

        // Simpan cover
        $cover = $request->cover;
        $coverName = Str::random(10) . '.' . $cover->getClientOriginalExtension();
        $cover->storeAs('public/images/covers', $coverName);
        $validatedData['cover'] = $coverName;

        // Simpan file ebook
        $ebookFile = $request->file_ebook;
        $ebookFileName = Str::random(15) . '.' . $ebookFile->getClientOriginalExtension();
        $ebookFile->storeAs('public/file_pdf', $ebookFileName);
        $validatedData['file_ebook'] = $ebookFileName;

        $validatedData['slug'] = Str::slug($validatedData['name']);
        $validatedData['mentor_id'] = Auth::user()->id;

        Ebook::create($validatedData);

        Alert::success('Success', 'eBook Berhasil Dibuat');
        return redirect()->route('admin.ebook');
    }


    public function edit(Request $requests)
    {
        // id course
        $id = $requests->query('id');
        $ebooks = Ebook::where('id', $id)->first();
        return view('admin.course-ebook.update', compact('ebooks'));
    }

    public function update(Request $request, Ebook $ebook)
    {
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

        if ($validatedData['type'] === 'free') {
            $validatedData['price'] = 0;
        }

        if ($request->hasFile('cover')) {
            $cover = $request->cover;
            $coverName = Str::random(10) . '.' . $cover->getClientOriginalExtension();
            $cover->storeAs('public/images/covers', $coverName);

            // Hapus cover lama
            Storage::delete('public/images/covers/' . $ebook->cover);
            $validatedData['cover'] = $coverName;
        }

        if ($request->hasFile('file_ebook')) {
            $ebookFile = $request->file_ebook;
            $ebookFileName = Str::random(15) . '.' . $ebookFile->getClientOriginalExtension();
            $ebookFile->storeAs('public/file_pdf', $ebookFileName);

            // Hapus file ebook lama
            Storage::delete('public/file_pdf/' . $ebook->file_ebook);
            $validatedData['file_ebook'] = $ebookFileName;
        }

        $validatedData['slug'] = Str::slug($validatedData['name']);
        $ebook->update($validatedData);

        Alert::success('Success', 'eBook Berhasil Diperbarui');
        return redirect()->route('admin.ebook');
    }


    public function delete(Request $requests)
    {
        // id course
        $id = $requests->query('id');
        $ebook = Ebook::where('id', $id)->first();
        $ebook->delete();
        Storage::delete('public/file_pdf/' . $ebook->file_ebook);
        Storage::delete('public/images/covers/' . $ebook->cover);

        Alert::success('Success', 'eBook Berhasil Di Hapus');
        return redirect()->route('admin.ebook');
    }
}
