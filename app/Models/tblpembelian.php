<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblpembelian extends Model
{
    protected $fillable = [
        'nama_seller',
        'nama_product',
        'jumlah_product',
        'total_price'
        
    ];
}
