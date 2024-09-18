<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

    public function pdfProxy()
    {
        $url = 'https://drive.google.com/uc?id=1AG-W_AfRm69WRI-OCbOKMpWqTYTq2hzw';

        $response = Http::get($url);

        if ($response->successful()) {
            return response($response->body(), 200)
                ->header('Content-Type', 'application/pdf');
        } else {
            return response('File not found', 404);
        }
    }
}
