<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;

    protected $table = 'tb_rekening';

    protected $fillable = [
        'bank',
        'kode_bank'
    ];
}
