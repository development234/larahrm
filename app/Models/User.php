<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Scope untuk user aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    // Scope untuk role tertentu
    public function scopeRole($query, $role)
    {
        return $query->where('role', $role);
    }

    // Method untuk cek apakah user admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Method untuk cek apakah user aktif
    public function isAktif()
    {
        return $this->status === 'aktif';
    }

    // Method untuk cek apakah user bisa login
    public function canLogin()
    {
        return $this->isAktif();
    }
}