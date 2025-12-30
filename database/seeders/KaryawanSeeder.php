<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Karyawan;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        Karyawan::create([
            'name_user' => 'John Doe',
            'nik' => 'K001',
            'jabatan' => 'Manager',
            'tanggal_gabung' => '2024-01-01',
            'Status' => 'Aktif',
            'password' => 'password123'
        ]);

        Karyawan::create([
            'name_user' => 'Budi Santoso',
            'nik' => 'K002', 
            'jabatan' => 'HRD',
            'tanggal_gabung' => '2024-01-15',
            'Status' => 'Aktif',
            'password' => 'password123'
        ]);

        Karyawan::create([
            'name_user' => 'Siti Rahayu',
            'nik' => 'K003',
            'jabatan' => 'Staff IT',
            'tanggal_gabung' => '2024-02-01',
            'Status' => 'Aktif',
            'password' => 'password123'
        ]);
    }
}