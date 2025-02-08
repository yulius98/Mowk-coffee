<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblpenjualan extends Model
{
    protected $fillable = [
        'nama_pembeli',
        'nama_product',
        'jumlah_product',
        'total_price'
        
    ];
}