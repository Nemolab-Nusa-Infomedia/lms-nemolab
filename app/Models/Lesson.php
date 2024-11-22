<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class Lesson extends Model
    {
        use HasFactory;

        protected $table = 'tbl_lessons';

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
