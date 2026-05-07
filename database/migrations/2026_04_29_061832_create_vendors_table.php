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
            $table->string('action')->nullable();
            $table->string('start_koordinat')->nullable();
            $table->string('end_koordinat')->nullable();
            $table->string('koordinat')->nullable();
            $table->string('panjang_kabel')->nullable();
            $table->string('banyak_core')->nullable();
            $table->string('jenis_kabel')->nullable();
            $table->string('spliter')->nullable();
            $table->string('ratio')->nullable();
            $table->string('redaman_input')->nullable();
            $table->string('redaman_output')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('tehnisi_1');
            $table->string('tehnisi_2')->nullable();
            $table->string('tehnisi_3')->nullable();
            $table->string('tehnisi_4')->nullable();
            $table->string('tehnisi_5')->nullable();
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
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
