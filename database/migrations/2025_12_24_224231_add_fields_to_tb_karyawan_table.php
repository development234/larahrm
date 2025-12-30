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
        Schema::table('tb_karyawan', function (Blueprint $table) {
            $table->string('id_personel')->nullable()->after('id');
            $table->string('nama_lengkap')->nullable();
            $table->string('email')->nullable();
            $table->string('hp', 20)->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('area_kerja')->nullable();
            $table->date('akhir_kontrak')->nullable();
            $table->string('rekening')->nullable();

            $table->string('berkas1')->nullable();
            $table->string('berkas2')->nullable();
            $table->string('berkas3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_karyawan', function (Blueprint $table) {
            Schema::table('tb_karyawan', function (Blueprint $table) {
            $table->dropColumn([
                'id_personel',
                'nama_lengkap',
                'email',
                'hp',
                'tempat_lahir',
                'tgl_lahir',
                'alamat',
                'area_kerja',
                'akhir_kontrak',
                'rekening',
                'berkas1',
                'berkas2',
                'berkas3',
            ]);
        });
        });
    }
};
