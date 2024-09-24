<?php
namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ebook;

class MemberEbookController extends Controller
{
    public function index($slug)
    {
        // Cari ebook berdasarkan slug
        $ebook = Ebook::where('slug', $slug)->firstOrFail();
        return view('member.joinebook', compact('ebook'));
    }

    public function read($slug)
    {
        // Cari ebook berdasarkan slug
        $ebook = Ebook::where('slug', $slug)->firstOrFail();
        return view('member.ebook', compact('ebook'));
    }
}
