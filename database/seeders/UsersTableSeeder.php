<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [];
        $password = Hash::make('123456789');
        $now = Carbon::now();

        $names = [
            'Ahmad Rizki', 'Budi Santoso', 'Citra Dewi', 'Dian Pratama', 'Eko Wijaya',
            'Fajar Nugroho', 'Gita Maharani', 'Hendra Setiawan', 'Indah Permata', 'Joko Susilo',
            'Kartika Sari', 'Lukman Hakim', 'Maya Wulandari', 'Nova Pratama', 'Oki Setiawan',
            'Putri Anggraini', 'Rizki Ramadhan', 'Sari Indah', 'Tono Wijaya', 'Umi Kulsum'
        ];

        foreach ($names as $index => $name) {
            $email = strtolower(str_replace(' ', '', $name)) . '@hrlara.com';
            
            // User pertama jadi admin, lainnya user
            $role = $index === 0 ? 'admin' : 'user';
            
            // 2 user pertama nonaktif, lainnya aktif
            $status = $index < 2 ? 'nonaktif' : 'aktif';

            $users[] = [
                'name' => $name,
                'email' => $email,
                'email_verified_at' => $now,
                'password' => $password,
                'role' => $role,
                'status' => $status,
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('users')->insert($users);
        
        $this->command->info('Berhasil menambahkan 20 data users dengan role dan status!');
    }
}