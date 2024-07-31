<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = 'tbl_reviews';
    protected $fillable = [
        'name',
        'cover',
        'type',
        'status',
        'price',
        'level',
        'description',
        'mentor_id',
    ];

    public function users() {
        // jika ingin memanggil course dari user setiap foreign key maka gunakan tabel users sebagai belongsto untuk join relation
        return $this->belongsTo(User::class, 'mentor_id', 'id');
    }
}