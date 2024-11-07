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
            'file_ebook' => 'required|mimes:pdf|max:15120',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:2050',
        ]);

        if ($validatedData['type'] === 'free') {
            $validatedData['price'] = 0;
        }

        $cover = $request->file('cover');
        $coverName = Str::random(10) . '_' . $cover->getClientOriginalName();
        $cover->storeAs('public/images/covers/ebook', $coverName);
        $validatedData['cover'] = $coverName;

        $ebookFile = $request->file('file_ebook');
        $ebookFileName = Str::random(10) . '_' . $ebookFile->getClientOriginalName();
        $ebookFile->storeAs('public/file_pdf', $ebookFileName);
        $validatedData['file_ebook'] = $ebookFileName;

        $validatedData['slug'] = Str::slug($validatedData['name']);
        $validatedData['mentor_id'] = Auth::user()->id;

        Ebook::create($validatedData);

        Alert::success('Success', 'eBook Berhasil Dibuat');
        return redirect()->route('admin.ebook');
    }

    public function edit($id)
    {
        $ebook = Ebook::findOrFail($id);
        $categories = Category::all();
        return view('admin.course-ebook.update', compact('ebook', 'categories'));
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
            'file_ebook' => 'nullable|mimes:pdf|max:5120',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2050',
        ]);

        if ($validatedData['type'] === 'free') {
            $validatedData['price'] = 0;
        }

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName = Str::random(10) . '_' . $cover->getClientOriginalName();
            $cover->storeAs('public/images/covers/ebook', $coverName);

            Storage::delete('public/images/covers/ebook/' . $ebook->cover);
            $validatedData['cover'] = $coverName;
        }

        if ($request->hasFile('file_ebook')) {
            $ebookFile = $request->file('file_ebook');
            $ebookFileName = Str::random(10) . '_' . $ebookFile->getClientOriginalName();
            $ebookFile->storeAs('public/file_pdf', $ebookFileName);

            Storage::delete('public/file_pdf/' . $ebook->file_ebook);
            $validatedData['file_ebook'] = $ebookFileName;  
        }

        $validatedData['slug'] = Str::slug($validatedData['name']);
        $ebook->update($validatedData);

        Alert::success('Success', 'eBook Berhasil Diperbarui');
        return redirect()->route('admin.ebook');
    }

    public function destroy($id)
    {
        $ebook = Ebook::findOrFail($id);
        Storage::delete(['public/file_pdf/' . $ebook->file_ebook, 'public/images/covers/ebook/' . $ebook->cover]);
        $ebook->delete();

        Alert::success('Success', 'eBook Berhasil Dihapus');
        return redirect()->route('admin.ebook');
    }
}
