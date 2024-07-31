<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GabungkelasController extends Controller
{
    public function index(){
        return view('gabungkelas');
    }
}
