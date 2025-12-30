<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RekeningSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tb_rekening')->insert([
            ['bank' => 'Bank Indonesia', 'no_rekening' => '0000000000', 'kode_bank' => '009'],
            ['bank' => 'Bank BRI', 'no_rekening' => '1234567890', 'kode_bank' => '002'],
            ['bank' => 'Bank BNI', 'no_rekening' => '1234567891', 'kode_bank' => '009'],
            ['bank' => 'Bank Mandiri', 'no_rekening' => '1234567892', 'kode_bank' => '008'],
            ['bank' => 'Bank BCA', 'no_rekening' => '1234567893', 'kode_bank' => '014'],
            ['bank' => 'Bank BTN', 'no_rekening' => '1234567894', 'kode_bank' => '200'],
            ['bank' => 'Bank CIMB Niaga', 'no_rekening' => '1234567895', 'kode_bank' => '022'],
            ['bank' => 'Bank Danamon', 'no_rekening' => '1234567896', 'kode_bank' => '011'],
            ['bank' => 'Bank Permata', 'no_rekening' => '1234567897', 'kode_bank' => '013'],
            ['bank' => 'Bank Panin', 'no_rekening' => '1234567898', 'kode_bank' => '019'],
            ['bank' => 'Bank Mega', 'no_rekening' => '1234567899', 'kode_bank' => '426'],
            ['bank' => 'Bank Syariah Indonesia (BSI)', 'no_rekening' => '1234567800', 'kode_bank' => '451'],
            ['bank' => 'Bank Jago', 'no_rekening' => '1234567801', 'kode_bank' => '542'],
            ['bank' => 'Bank Jenius (BTPN)', 'no_rekening' => '1234567802', 'kode_bank' => '213'],
            ['bank' => 'Bank Muamalat', 'no_rekening' => '1234567803', 'kode_bank' => '147'],
        ]);
    }
}

