<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ebook extends Model
{
    use HasFactory; // Menggunakan trait HasFactory untuk mendukung pembuatan instance model dengan factory

    // Menargetkan tabel `tbl_ebooks` dalam database
    protected $table = 'tbl_ebooks';
    // Menentukan kolom yang dapat diisi
    protected $fillable = [
        'cover',          
        'category',      
        'name',          
        'type',           
        'product_type',   
        'status',         
        'level',          
        'price',          
        'description',    
        'file_ebook',     
        'mentor_id',      
        'slug'            
    ];

    // Fungsi untuk menghasilkan slug unik berdasarkan nama eBook
    public static function generateUniqueSlug($name)
    {
        // Membuat slug dari nama eBook
        $slug = Str::slug($name);

        // Menghitung jumlah slug yang mirip di database
        $count = static::where('slug', 'LIKE', "{$slug}%")->count();

        // Jika ada slug serupa, tambahkan angka untuk membuatnya unik
        return $count ? "{$slug}-{$count}" : $slug;
    }

    // Relasi dengan model User
    public function users()
    {
        // eBook dimiliki oleh satu mentor (user) melalui `mentor_id`
        return $this->belongsTo(User::class, 'mentor_id', 'id');
    }

    // Relasi dengan model Transaction
    public function transactions()
    {
        // eBook memiliki banyak transaksi
        return $this->hasMany(Transaction::class);
    }

    // Relasi dengan model CourseEbook
    public function courseEbooks()
    {
        // eBook dapat terkait dengan banyak CourseEbook melalui `ebook_id`
        return $this->hasMany(CourseEbook::class, 'ebook_id');
    }
}
