<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailTransactions extends Model
{
    use HasFactory; // Menggunakan trait HasFactory untuk mendukung pembuatan instance model dengan factory

    // Menargetkan tabel `tbl_detail_transactions` dalam database
    protected $table = 'tbl_detail_transactions';

    // Menentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'transaction_code',
        'name_item',        
        'harga_awal',      
        'promo',            
        'total_harga',      
    ];
}
