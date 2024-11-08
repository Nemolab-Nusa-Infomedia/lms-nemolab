<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseEbook extends Model
{
    use HasFactory;
    protected $table = 'tbl_course_ebooks';

    protected $fillable = [
        'course_id',
        'ebook_id',
        'type',
        'status',
        'price',
    ];

    // Relasi ke Course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    // Relasi ke Ebook
    public function ebook()
    {
        return $this->belongsTo(Ebook::class, 'ebook_id');
    }
}
