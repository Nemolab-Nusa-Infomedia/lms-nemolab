<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    use HasFactory;

    protected $table = 'tbl_ebooks';

    protected $fillable = [
        'course_id',
        'name',
        'type',
        'status',
        'level',
        'price',
        'description',
        'ebook',
        'mentor_id'
    ];

    // Define the relationship with Course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    // Define the relationship with User
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id', 'id');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
