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

    public function users()
    {
        return $this->belongsTo(User::class, 'mentor_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // public function ebook()
    // {
    //     return $this->hasOne(Ebook::class, 'course_id', 'id');
    // }

    public function tools()
    {
        return $this->belongsToMany(Tools::class, 'tbl_course_tools', 'course_id', 'tool_id');
    }
        /**
     * Relasi ke model Forum.
     * Sebuah course memiliki satu forum.
     */
    public function forum()
    {
        return $this->hasOne(Forum::class);
    }
}
