<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Menargetkan tabel `tbl_transactions` dalam database
    protected $table = 'tbl_transactions';

    // Menentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'status',            
        'course_id',        
        'transaction_code',  
        'user_id',           
        'ebook_id',          
        'bundle_id',         
        'snap_token',        
        'name',              
        'price',            
    ];

    // Relasi dengan model `User`
    public function user()
    {
        // Setiap transaksi dimiliki oleh satu pengguna
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi dengan model `Course`
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // Relasi dengan model `Ebook`
    public function ebook()
    {
        return $this->belongsTo(Ebook::class, 'ebook_id');
    }

    // Relasi dengan model `CourseEbook`
    public function bundle()
    {
        return $this->belongsTo(CourseEbook::class, 'bundle_id');
    }
}
