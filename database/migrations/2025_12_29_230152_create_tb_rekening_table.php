<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_rekening', function (Blueprint $table) {
            $table->id();

            $table->string('bank', 50);           // Nama Bank (BRI, BCA, Mandiri, dll)
            $table->string('no_rekening', 50);    // Nomor rekening
            $table->string('kode_bank', 50);     // Nama pemilik rekening

            // kalau mau hubungkan ke karyawan nanti:
            // $table->unsignedBigInteger('karyawan_id')->nullable();
            // $table->foreign('karyawan_id')->references('id')->on('tb_karyawan')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_rekening');
    }
};
