<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'tbl_transactions';

    protected $fillable = [
        'status',
        'course_id',
        'transaction_code',
        'user_id',
        'ebook_id',
        'snap_token',
        'name',
        'price',
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // Relasi dengan model Ebook
    public function ebook()
    {
        return $this->belongsTo(Ebook::class, 'ebook_id');
    }
}