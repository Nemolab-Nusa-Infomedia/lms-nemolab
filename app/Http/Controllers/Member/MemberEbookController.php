<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ebook;

class MemberEbookController extends Controller
{
    public function index($id)
    {
        $ebook = Ebook::findOrFail($id);
        return view('member.joinebook', compact('ebook'));
    }

    public function read($id)
    {
        $ebook = Ebook::findOrFail($id);
        return view('member.ebook', compact('ebook'));
    }
}
