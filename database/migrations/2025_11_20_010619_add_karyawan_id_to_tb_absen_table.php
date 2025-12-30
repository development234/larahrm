<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tb_absen', function (Blueprint $table) {
            $table->foreignId('karyawan_id')->after('id')->nullable()->constrained('tb_karyawan')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('tb_absen', function (Blueprint $table) {
            $table->dropForeign(['karyawan_id']);
            $table->dropColumn('karyawan_id');
        });
    }
};