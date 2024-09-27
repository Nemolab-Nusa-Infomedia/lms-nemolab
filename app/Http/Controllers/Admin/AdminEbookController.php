<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use Illuminate\Support\Str;

class AdminEbookController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $perPage = $request->input('per_page', 10);
        // Show all eBooks for superadmin, or filter by mentor for other users
        $ebooks = ($user->role === 'superadmin')
            ? Ebook::paginate($perPage)
            : Ebook::where('mentor_id', $user->id)->paginate($perPage);

        return view('admin.coursesebook.view', compact('ebooks'));
    }

    public function create()
    {
        $category = Category::all();
        $courses = auth()->user()->courses;
        return view('admin.coursesebook.create', compact('courses', 'category'));
    }

    // Store a new eBook
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category' => 'required|string|max:255',
            'course_id' => 'nullable|exists:tbl_courses,id',
            'name' => 'required|string|max:255',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'nullable|integer|min:0',
            'description' => 'required|string',
            'ebook' => 'required|file|mimes:pdf|max:25240',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Generate a unique name for the cover image
        $cover = $request->file('cover');
        $coverName = Str::random(10) . '_' . $cover->getClientOriginalName();
        $cover->storeAs('public/images/covers/ebook', $coverName);
        $validatedData['cover'] = $coverName;
        // Handle optional resources field
        $resources = $request->input('resources', 'null');

        // Set price to 0 if type is free
        if ($validatedData['type'] === 'free') {
            $validatedData['price'] = 0;
        }

        // Save the eBook file
        if ($request->hasFile('ebook')) {
            $ebookPath = $request->file('ebook')->store('public/pdfs');
            $validatedData['ebook'] = basename($ebookPath);
        }

        // Set the current user as the mentor for the eBook
        $validatedData['mentor_id'] = auth()->id();

        // Store the eBook in the database
        Ebook::create($validatedData);

        return redirect()->route('admin.ebook')->with('success', 'eBook created successfully.');
    }

    public function edit(Ebook $ebook)
    {
        $category = Category::all();
        $courses = auth()->user()->courses;
        return view('admin.coursesebook.update', compact('ebook', 'courses', 'category'));
    }

    // Update eBook
    public function update(Request $request, Ebook $ebook)
    {
        $validatedData = $request->validate([
            'category' => 'required|string|max:255',
            'course_id' => 'nullable|exists:tbl_courses,id',
            'name' => 'required|string|max:255',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'nullable|integer|min:0',
            'description' => 'required|string',
            'ebook' => 'nullable|file|mimes:pdf|max:25240',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Set price to 0 if type is free
        if ($validatedData['type'] === 'free') {
            $validatedData['price'] = 0;
        }
        // If a new PDF is uploaded, delete the old one and store the new one
        if ($request->hasFile('ebook')) {
            if (Storage::exists('public/pdfs/' . $ebook->ebook)) {
                Storage::delete('public/pdfs/' . $ebook->ebook);
            }
            $ebookPath = $request->file('ebook')->store('public/pdfs');
            $validatedData['ebook'] = basename($ebookPath);
        }
        // If a new cover image is uploaded, delete the old one and store the new one
        if ($request->hasFile('cover')) {
            if (Storage::exists('public/images/covers/ebook/' . $ebook->cover)) {
                Storage::delete('public/images/covers/ebook/' . $ebook->cover);
            }
            $cover = $request->file('cover');
            $coverName = Str::random(10) . '_' . $cover->getClientOriginalName();
            $cover->storeAs('public/images/covers/ebook', $coverName);
            $validatedData['cover'] = $coverName;
        }
        // Update the eBook data
        $ebook->update($validatedData);

        return redirect()->route('admin.ebook')->with('success', 'eBook updated successfully.');
    }

    public function destroy(Ebook $ebook)
    {
        // Delete the eBook file from storage
        if (Storage::exists('public/pdfs/' . $ebook->ebook)) {
            Storage::delete('public/pdfs/' . $ebook->ebook);
        }
        // Delete the cover image if it exists
        if (Storage::exists('public/images/covers/ebook/' . $ebook->cover)) {
            Storage::delete('public/images/covers/ebook/' . $ebook->cover);
        }
        // Delete the eBook record from the database
        $ebook->delete();

        return redirect()->route('admin.ebook')->with('success', 'eBook deleted successfully.');
    }
}
