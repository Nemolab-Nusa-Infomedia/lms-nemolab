<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminEbookController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $perPage = $request->input('per_page', 10);
        if ($user->role === 'superadmin') {
            $ebooks = Ebook::paginate($perPage);
        } else {
            $ebooks = Ebook::where('mentor_id', $user->id)->paginate($perPage);
        }
        return view('admin.coursesebook.view', compact('ebooks'));
    }
    

    public function create()
    {
        $courses = auth()->user()->courses;
        return view('admin.coursesebook.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'course_id' => 'nullable|exists:tbl_courses,id',
            'name' => 'required|string|max:255',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'nullable|integer',
            'description' => 'required|string',
            'link' => 'required|url',
        ]);
    
        if ($validatedData['type'] === 'free') {
            $validatedData['price'] = 0;
        }
    
        $validatedData['mentor_id'] = auth()->id();
    
        Ebook::create($validatedData);
    
        return redirect()->route('admin.ebook')->with('success', 'eBook created successfully.');
    }
    

    public function edit(Ebook $ebook)
    {
        $courses = auth()->user()->courses;
        return view('admin.coursesebook.update', compact('ebook', 'courses'));
    }

    public function update(Request $request, Ebook $ebook)
    {
        $validatedData = $request->validate([
            'course_id' => 'nullable|exists:tbl_courses,id',
            'name' => 'required|string|max:255',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'nullable|integer',
            'description' => 'required|string',
            'link' => 'required|url',
        ]);
        
        if ($validatedData['type'] === 'free') {
            $validatedData['price'] = 0;
        }
    
        $ebook->update($validatedData);
    
        return redirect()->route('admin.ebook')->with('success', 'eBook updated successfully.');
    }

    public function destroy(Ebook $ebook)
    {
        $ebook->delete();

        return redirect()->route('admin.ebook')->with('success', 'eBook deleted successfully.');
    }
}
