<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory; // Menggunakan trait HasFactory untuk mendukung pembuatan seeder/factory

    // Menargetkan tabel `tbl_reviews` dalam database
    protected $table = 'tbl_reviews';
    
    // Menentukan kolom yang dapat diisi
    protected $fillable = [
        'user_id',   
        'course_id', 
        'ebook_id',  
        'note',      
    ];

    // Relasi one-to-many dengan model User
    public function user()
    {
        // Menghubungkan tabel `tbl_reviews` dengan tabel `users` melalui `user_id`
        return $this->belongsTo(User::class);
    }

    // Relasi one-to-many dengan model Course
    public function course()
    {
        // Menghubungkan tabel `tbl_reviews` dengan tabel `courses` melalui `course_id`
        return $this->belongsTo(Course::class);
    }

    // Relasi one-to-many dengan model Ebook
    public function ebook()
    {
        // Menghubungkan tabel `tbl_reviews` dengan tabel `ebooks` melalui `ebook_id`
        return $this->belongsTo(Ebook::class);
    }
}
