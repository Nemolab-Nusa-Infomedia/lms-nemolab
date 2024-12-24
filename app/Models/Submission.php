<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory; // Menggunakan trait HasFactory untuk mendukung pembuatan seeder/factory
    // Menargetkan tabel `tbl_submissions` dalam database
    protected $table = 'tbl_submissions';

    // Mengatur kolom-kolom yang dapat diisi oleh user
    protected $fillable = [
        'status',
        'user_id',
    ];

    // Relasi dengan model `User`
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
