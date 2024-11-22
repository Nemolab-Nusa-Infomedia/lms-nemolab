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
    use HasFactory, Sluggable;

    protected $table = 'tbl_courses';

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

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    // Di dalam model Course
    public function users()
    {
        return $this->belongsTo(User::class, 'mentor_id', 'id');
    }


    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function tools()
    {
        return $this->belongsToMany(Tools::class, 'tbl_course_tools', 'course_id', 'tool_id');
    }
    // In Course.php model
    public function courseEbooks()
    {
        return $this->hasMany(CourseEbook::class, 'course_id');
    }
}
