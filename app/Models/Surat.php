<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'tb_surat';

    protected $fillable = [
        'tanggal',
        'perihal',
        'tujuan',
        'berkas_surat',
        'status'
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}