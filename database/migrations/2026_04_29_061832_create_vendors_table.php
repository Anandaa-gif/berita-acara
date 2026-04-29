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
        Schema::create('vendors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('jenis_kegiatan');
            $table->string('lokasi');
            $table->string('start_koordinat');
            $table->string('end_koordinat');
            $table->string('panjang_kabel');
            $table->string('banyak_core');
            $table->string('jenis_kabel');
            $table->string('tehnisi_1');
            $table->string('tehnisi_2')->nullable();
            $table->string('tehnisi_3')->nullable();
            $table->string('tehnisi_4')->nullable();
            $table->string('tehnisi_5')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
