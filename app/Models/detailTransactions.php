<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailTransactions extends Model
{
    use HasFactory;

    protected $table = 'tbl_detail_transactions';

    protected $fillable = [
        'transaction_code',
        'name_item',
        'harga_awal',
        'promo',
        'total_harga',
    ];
}
