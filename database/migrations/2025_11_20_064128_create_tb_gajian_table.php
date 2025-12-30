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
        Schema::create('tb_gajian', function (Blueprint $table) {
            $table->id();
            $table->string('name_user');
            $table->string('periode'); // Format: YYYY-MM
            $table->enum('status', ['draft', 'diproses', 'selesai', 'dibatalkan'])->default('draft');
            $table->date('tanggal_proses')->nullable();
            $table->decimal('total_dibayarkan', 15, 2)->default(0);
            $table->timestamps();

            // Index untuk performa
            $table->index('name_user');
            $table->index('periode');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_gajian');
    }
};