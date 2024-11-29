<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiskonKelas extends Model
{
    use HasFactory; // Menggunakan trait HasFactory untuk mendukung pembuatan instance model dengan factory

    // Menargetkan tabel `tbl_diskon_kelas` dalam database
    protected $table = 'tbl_diskon_kelas';

    // Menentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'kode_diskon',  // Kode diskon unik yang digunakan untuk identifikasi
        'rate_diskon',  // Nilai diskon dalam bentuk persentase atau nominal
    ];
}
