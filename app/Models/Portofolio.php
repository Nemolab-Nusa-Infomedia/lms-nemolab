<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    use HasFactory;

    protected $table = 'tbl_portofolio';
    
    protected $fillable = [
        'portofolio_name',
        'description',
        'link_portofolio',
        'course_id'
    ];
}