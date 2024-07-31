<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsercourseController extends Controller
{
    public function index(){
        return view('Usercourse');
    }
}
