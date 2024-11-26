<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    // Menggunakan trait HasFactory untuk mendukung pembuatan instance model dengan factory
    use HasFactory;
    
    // Menargetkan tabel `tbl_chapters` dalam database
    protected $table = 'tbl_chapters';

    // Menentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'name',   
        'course_id' 
    ];

    // Relasi dengan model Lesson
    public function lessons()
    {
        // Menentukan relasi *hasMany* dengan model `Lesson`
        // Setiap bab / chapter dapat memiliki banyak pelajaran (lesson) yang terkait
        return $this->hasMany(Lesson::class, 'chapter_id', 'id');
    }
}
