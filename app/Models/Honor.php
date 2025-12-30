<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Honor extends Model
{
    use HasFactory;

    protected $table = 'tb_honor';

    protected $fillable = [
        'name_karyawan',
        'rincian_lembur',
        'total_jam',
        'total_pembayaran',
        'status'
    ];

    protected $casts = [
        'total_pembayaran' => 'decimal:3',
        'total_jam' => 'integer'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}