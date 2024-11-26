<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;// Menggunakan trait HasFactory untuk mendukung pembuatan seeder/factory
use Illuminate\Database\Eloquent\Model;

    class Lesson extends Model
    {
        use HasFactory;

        protected $table = 'tbl_lessons';//menargetkan tbl_lessons
    // Mengatur kolom-kolom yang dapat diisi oleh user
        protected $fillable = [
            'name',
            'episode',
            'video',
            'chapter_id'
        ];

        public function chapters()
        {
            return $this->belongsTo(Chapter::class, 'chapter_id', 'id');
        }
    }
