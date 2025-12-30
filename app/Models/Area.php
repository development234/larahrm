<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'tb_area';

    protected $fillable = [
        'nama_area',
        'kota',
    ];
}

