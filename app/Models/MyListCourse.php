<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyListCourse extends Model
{
    use HasFactory;// Menggunakan trait HasFactory untuk mendukung pembuatan seeder/factory
    
    protected $table = 'tbl_my_list_courses';
    // Mengatur kolom-kolom yang dapat diisi oleh user
    protected $fillable = [
        'user_id',
        'course_id',
        'ebook_id',
    ];
}
