<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class LandingpageController extends Controller
{

    public function index(){
        $reviews = Review::with('user')->get();
        return view('member.home', ['reviews' => $reviews]);
    }


}
