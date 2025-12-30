<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_perizinan', function (Blueprint $table) {
            $table->id();
            $table->string('karyawan');
            $table->string('jabatan');
            $table->string('jenis_izin');
            $table->date('tanggal_izin');
            $table->string('durasi');
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_perizinan');
    }
};