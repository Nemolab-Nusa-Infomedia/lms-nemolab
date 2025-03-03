<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompleteEpisodeCourse extends Model
{
    // Menggunakan trait HasFactory untuk mendukung pembuatan instance model dengan factory
    use HasFactory;

    // Menargetkan tabel `tbl_complete_episode_courses` dalam database
    protected $table = 'tbl_complete_episode_courses';

    // Menentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'user_id',   
        'course_id', 
        'episode_id' 
    ];

    // Relasi dengan model Course
    public function course()
    {
        // Menentukan relasi *belongsTo* dengan model `Course`
        // Menunjukkan bahwa setiap record di tabel ini terhubung dengan satu kursus
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
