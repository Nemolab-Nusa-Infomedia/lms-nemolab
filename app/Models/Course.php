<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

use App\Models\Tools;
use App\Models\Ebook;
use App\Models\Forum;
use App\Models\Transaction;
use App\Models\User;

class Course extends Model
{
    // Menggunakan trait HasFactory untuk mendukung pembuatan instance model dengan factory
    // Menggunakan trait Sluggable untuk mendukung pembuatan slug otomatis
    use HasFactory, Sluggable;

    // Menargetkan tabel `tbl_courses` dalam database
    protected $table = 'tbl_courses';

    // Menentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'category',        
        'name',            
        'slug',            
        'cover',           
        'type',            
        'status',         
        'price',           
        'pruduct_type',   
        'level',           
        'description',     
        'resources',       
        'link_grub',       
        'rating',          
        'mentor_id',       
    ];

    // Mengonfigurasi slug otomatis berdasarkan nama kursus
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name' // Sumber slug diambil dari kolom `name`
            ]
        ];
    }

    // Relasi dengan model User (mentor yang mengelola kursus)
    public function users()
    {
        return $this->belongsTo(User::class, 'mentor_id', 'id');
    }

    // Relasi dengan model Transaction (transaksi terkait kursus ini)
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Relasi dengan model Tools melalui tabel pivot `tbl_course_tools`
    public function tools()
    {
        return $this->belongsToMany(Tools::class, 'tbl_course_tools', 'course_id', 'tool_id');
    }

    // Relasi dengan model CourseEbook untuk mengelola eBook yang terhubung ke kursus
    public function courseEbooks()
    {
        return $this->hasMany(CourseEbook::class, 'course_id');
    }
}

