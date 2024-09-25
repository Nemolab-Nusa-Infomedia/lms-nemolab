<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comments;
use Illuminate\Support\Facades\Auth;
use App\Models\Forum;
use App\Models\Course;
use App\Models\Transaction;
use RealRashid\SweetAlert\Facades\Alert;

class MemberCommentController extends Controller
{
    public function index($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $checkTrx = Transaction::where('course_id', $course->id)->where('user_id', Auth::user()->id)->first();
        $forum = $course->forum()->with('comments.replies')->firstOrFail();
        $comments = $forum->comments()->whereNull('parent_id')->with('replies')->paginate(10);
        if(Auth::user()->role != 'students') {
            return view('member.forum', compact('course', 'forum', 'comments'));
        }
        else {
            if($checkTrx){
                return view('member.forum', compact('course', 'forum', 'comments'));
            }
            else{
                Alert::error('error', 'Maaf Akses Tidak Bisa, Karena Anda belum Beli Kelas!!!');
                return redirect()->route('member.course.join', $slug);
            }
        }
    }

    public function storeComment(Request $request, $slug)
    {
        $request->validate([
            'comment' => 'required|string',
            'forum_id' => 'required|integer',
        ]);
        $course = Course::where('slug', $slug)->firstOrFail();
        $forum = $course->forum;
        if ($forum->id !== (int) $request->forum_id) {
            return redirect()->route('member.forum', ['slug' => $slug])
                ->with('error', 'Invalid forum ID.');
        }
        $comment = new Comments();
        $comment->forum_id = $request->forum_id;
        $comment->user_id = Auth::id();
        $comment->comment = $request->comment;
        $comment->parent_id = null;
        $comment->save();
        Alert::success('Success', 'Berhasil mengirim pertanyaan');
        return redirect()->route('member.forum', ['slug' => $slug]);
    }

    public function search(Request $request, $slug)
    {
        $query = $request->input('query');
        $course = Course::where('slug', $slug)->firstOrFail();
        $forum = $course->forum;
        $comments = Comments::where('forum_id', $forum->id)
            ->where('comment', 'LIKE', '%' . $query . '%')
            ->with('user')
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('member.forum', [
            'course' => $course,
            'forum' => $forum,
            'comments' => $comments,
        ]);
    }



    public function getReplies($comment_id)
    {
        $replies = Comments::where('parent_id', $comment_id)
            ->with('user')
            ->orderBy('created_at', 'ASC')
            ->get();
        return view('member.replies', compact('replies'));
    }

    // Method to store replies remains unchanged

    public function storeReply(Request $request)
    {
        $request->validate([
            'reply' => 'required|string',
            'comment_id' => 'required|integer',
        ]);

        $reply = new Comments();
        $reply->comment = null;
        $reply->reply = $request->reply;
        $reply->user_id = Auth::id();
        $reply->parent_id = $request->comment_id;
        $reply->forum_id = Comments::find($request->comment_id)->forum_id;
        $reply->save();

        return response()->json(['success' => true]);
    }
}
