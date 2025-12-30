<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tb_surat', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('perihal');
            $table->string('tujuan');
            $table->string('berkas_surat')->nullable();
            $table->enum('status', ['draft', 'dikirim', 'diterima', 'ditolak'])->default('draft');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_surat');
    }
};