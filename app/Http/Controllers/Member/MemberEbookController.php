<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberEbookController extends Controller
{
    public function index()
    {
        return view('member.ebook');
    }
}