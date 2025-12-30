<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perizinan extends Model
{
    use HasFactory;

    protected $table = 'tb_perizinan';

    protected $fillable = [
        'karyawan_id',
        'karyawan',
        'jabatan',
        'jenis_izin',
        'tanggal_izin',
        'durasi',
        'status'
    ];

    protected $casts = [
        'tanggal_izin' => 'date',
    ];

    // Relasi ke model Karyawan
    public function karyawanRelation()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
}