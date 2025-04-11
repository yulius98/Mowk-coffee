<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblpesertaEvent extends Model
{
    protected $fillable = [
        'name_event',
        'nama_peserta',
        'alamat_peserta',
        'no_HP',
        'email_peserta',
        'status_pembanyaran'
    ];
}