<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tools extends Model
{
    use HasFactory; // Menggunakan trait HasFactory untuk mendukung pembuatan seeder/factory

    // Menargetkan tabel `tbl_tools` dalam database
    protected $table = 'tbl_tools';

    // Menentukan kolom yang dapat diisi
    protected $fillable = [
        'name_tools',  
        'logo_tools',  
        'link',       
    ];

    // Relasi many-to-many dengan model `Course`
    public function courses()
    {
        // Kolom `tool_id` di tabel pivot merujuk ke `id` pada tabel tools
        // Kolom `course_id` di tabel pivot merujuk ke `id` pada tabel courses
        return $this->belongsToMany(Course::class, 'tbl_course_tools', 'tool_id', 'course_id');
    }
}
