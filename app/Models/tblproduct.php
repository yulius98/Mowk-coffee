<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblproduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_product',
        'image',
        'description',
        'price'
        
    ];

    protected $casts = [
        
    ];
}

            