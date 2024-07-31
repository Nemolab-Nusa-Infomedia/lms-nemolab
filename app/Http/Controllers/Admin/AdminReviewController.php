<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class AdminReviewController extends Controller
{
    public function index() {
        $reviews = Review::all();
        return response()->json($reviews);
        dd($reviews);
    }

    public function create() {
        // Return a view for creating reviews, if needed
        return view('admin.reviews.create');
    }

    public function store(Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:tbl_courses,id',
            'rating' => 'required|integer|min:1|max:5',
            'note' => 'nullable|string|max:255',
        ]);

        $review = Review::create([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'rating' => $request->rating,
            'note' => $request->note,
        ]);

        return response()->json([
            'message' => 'Review created successfully',
            'review' => $review
        ], 201);
    }

    public function edit($id) {
        $review = Review::findOrFail($id);
        return view('admin.reviews.edit', compact('review'));
    }

    public function update(Request $request, $id) {
        $review = Review::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:tbl_courses,id',
            'rating' => 'required|integer|min:1|max:5',
            'note' => 'nullable|string|max:255',
        ]);

        $review->update([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'rating' => $request->rating,
            'note' => $request->note,
        ]);

        return response()->json([
            'message' => 'Review updated successfully',
            'review' => $review
        ], 200);
    }

    public function delete($id) {
        $review = Review::findOrFail($id);
        $review->delete();

        return response()->json([
            'message' => 'Review deleted successfully'
        ], 200);
    }
}
