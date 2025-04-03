<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblpesertaEvent extends Model
{
    protected $fillable = [
        'Id_event',
        'nama_peserta',
        'alamat_peserta',
        'no_HP',
        'status_pembanyaran'
    ];
}