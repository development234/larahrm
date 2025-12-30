<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    
    // Set ke data yang akan disimpan
    protected $table = 'tb_karyawan';

    protected $fillable = [
        'name_user',
        'nik',
        'jabatan',
        'tanggal_gabung',
        'Status',
        'name_user',
        'nik',
        'jabatan',
        'tanggal_gabung',
        'status',
        'id_personel',
        'nama_lengkap',
        'email',
        'hp',
        'tempat_lahir',
        'tgl_lahir',
        'alamat',
        'area_kerja',
        'akhir_kontrak',
        'rekening',
        'berkas1',
        'berkas2',
        'berkas3',
    ];

    protected $casts = [
        'tanggal_gabung' => 'date',
        'tgl_lahir' => 'date',
        'akhir_kontrak' => 'date',
    ];

    /**
    * Relasi ke model User
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

// Relasi dengan honors jika ada
    public function honors()
    {
        return $this->hasMany(Honor::class);
    }
    
}