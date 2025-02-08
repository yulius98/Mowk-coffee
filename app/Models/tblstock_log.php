<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblstock_log extends Model
{
    protected $fillable = [
        'nama_product',
        'jumlahproduct_beli',
        'jumlah_product_jual'
    ];
}