<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tbltransaksi extends Model
{
    protected $fillable = [
        'nama_pembeli',
        'nama_product',
        'jumlah_product',
        'totalprice',
        'alamat_pengiriman',
        'no_HP',
        'status_transaksi',
        'AWB_Bill',
        'snap_token',
        'order_id'
    ];
}