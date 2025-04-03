<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblevent extends Model
{
    protected $fillable = [
        'date_event',
        'name_event',
        'tiket',
        'harga_tiket',
        'description_event',
        'location_event',
        'image_event'
    ];
}