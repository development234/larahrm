<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    use HasFactory;

    protected $table = 'tb_gajian';

    protected $fillable = [
        'name_user',
        'periode',
        'status',
        'tanggal_proses',
        'total_dibayarkan'
    ];

    protected $casts = [
        'tanggal_proses' => 'date',
        'total_dibayarkan' => 'decimal:2'
    ];

    /**
     * Scope untuk filter status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk filter periode
     */
    public function scopePeriode($query, $periode)
    {
        return $query->where('periode', $periode);
    }

    /**
     * Scope untuk filter karyawan
     */
    public function scopeKaryawan($query, $name)
    {
        return $query->where('name_user', 'like', '%'.$name.'%');
    }
}