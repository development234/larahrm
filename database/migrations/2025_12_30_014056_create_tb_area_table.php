<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_area', function (Blueprint $table) {
            $table->id();
            $table->string('nama_area');          // contoh: Kantor, Rumah Sakit
            $table->string('kota')->default('Banjarmasin');
            $table->timestamps();
        });
    
        DB::table('tb_area')->insert([
            ['nama_area' => 'Kantor', 'kota' => 'Banjarmasin'],
            ['nama_area' => 'Rumah Sakit', 'kota' => 'Banjarmasin'],
        ]);
    }
    
    public function down(): void
    {
        Schema::dropIfExists('tb_area');
    }

};
