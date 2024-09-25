<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyListCourse extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_my_list_courses';

    protected $fillable = [
        'user_id',
        'course_id',
        // 'ebook_id',
    ];
}
