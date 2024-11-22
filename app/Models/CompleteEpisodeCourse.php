<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompleteEpisodeCourse extends Model
{
    use HasFactory;

    protected $table = 'tbl_complete_episode_courses';
    protected $fillable = ['user_id', 'course_id', 'episode_id'];
    public function course()
    {   
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
