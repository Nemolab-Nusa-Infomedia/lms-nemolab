<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminEbookController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $perPage = $request->input('per_page', 10);
        // Show all ebooks for superadmin, or filter by mentor for other users
        $ebooks = ($user->role === 'superadmin')
            ? Ebook::paginate($perPage)
            : Ebook::where('mentor_id', $user->id)->paginate($perPage);

        return view('admin.coursesebook.view', compact('ebooks'));
    }
    public function create()
    {
        $courses = auth()->user()->courses;
        return view('admin.coursesebook.create', compact('courses'));
    }
    // Method untuk menyimpan eBook baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'course_id' => 'nullable|exists:tbl_courses,id',
            'name' => 'required|string|max:255',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'nullable|integer',
            'description' => 'required|string',
            'ebook' => 'required|file|mimes:pdf|max:25240',
        ]);
        // Set price to 0 if the type is free
        if ($validatedData['type'] === 'free') {
            $validatedData['price'] = 0;
        }
        // Simpan file PDF ke dalam storage
        if ($request->hasFile('ebook')) {
            $ebookPath = $request->file('ebook')->store('public/pdfs');
            $validatedData['ebook'] = basename($ebookPath);
        }
        // Assign the current user's ID as the mentor_id
        $validatedData['mentor_id'] = auth()->id();
        // Simpan data eBook ke database
        Ebook::create($validatedData);
        return redirect()->route('admin.ebook')->with('success', 'eBook created successfully.');
    }
    public function edit(Ebook $ebook)
    {
        $courses = auth()->user()->courses;
        return view('admin.coursesebook.update', compact('ebook', 'courses'));
    }
    // Method untuk memperbarui eBook
    public function update(Request $request, Ebook $ebook)
    {
        $validatedData = $request->validate([
            'course_id' => 'nullable|exists:tbl_courses,id',
            'name' => 'required|string|max:255',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'nullable|integer',
            'description' => 'required|string',
            'ebook' => 'nullable|file|mimes:pdf|max:25240',
        ]);
        // Set price to 0 if the type is free
        if ($validatedData['type'] === 'free') {
            $validatedData['price'] = 0;
        }
        // Jika ada file PDF baru yang diupload
        if ($request->hasFile('ebook')) {
            // Hapus file PDF lama dari storage jika ada
            if (Storage::exists('public/pdfs/' . $ebook->ebook)) {
                Storage::delete('public/pdfs/' . $ebook->ebook);
            }
            // Simpan file PDF baru ke storage
            $ebookPath = $request->file('ebook')->store('public/pdfs');
            $validatedData['ebook'] = basename($ebookPath);
        }
        // Update data eBook
        $ebook->update($validatedData);
        return redirect()->route('admin.ebook')->with('success', 'eBook updated successfully.');
    }

    public function destroy(Ebook $ebook)
    {
        // Remove the file from storage if it exists
        if (Storage::exists('public/pdfs/' . $ebook->ebook)) {
            Storage::delete('public/pdfs/' . $ebook->ebook);
        }
        $ebook->delete();
        return redirect()->route('admin.ebook')->with('success', 'eBook deleted successfully.');
    }
}
