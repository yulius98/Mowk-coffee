<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tblproduct extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nama_product',
        'category',
        'image',
        'description',
        'discount',
        'discount_price',
        'price'
        
    ];
    public $timestamps = true;

    protected $casts = [
        
    ];
}

            