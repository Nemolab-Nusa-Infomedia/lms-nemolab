<?php
namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ebook;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Course;

class MemberEbookController extends Controller
{
    public function index($slug)
    {
        // Cari ebook berdasarkan slug
        $ebook = Ebook::where('slug', $slug)->firstOrFail();
        $course = Course::where('id', $ebook->course_id)->first();
        $coursePrice = $course ? $course->price : 'N/A';

    return view('member.joinebook', compact('ebook', 'coursePrice'));
        return view('member.joinebook', compact('ebook','coursePrice'));
    }

    public function read($slug)
    {
        // Cari ebook berdasarkan slug
        $ebook = Ebook::where('slug', $slug)->firstOrFail();
        return view('member.ebook', compact('ebook'));
        // $checkTrx = Transaction::where('ebook_id', $ebook->id)->where('user_id', Auth::user()->id)->first();
        // if($checkTrx){
        //     return view('member.ebook', compact('ebook'));
        // }
        // else{
        //     Alert::error('error', 'Maaf Akses Akses Ditolak, Karena Anda Belum Berlangganan');
        //     return redirect()->route('member.ebook.index', $slug);
        // }
    }
}
