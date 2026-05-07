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
        Schema::create('backbones', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('jenis_kegiatan')->nullable();
            $table->string('lokasi');
            $table->string('tiang_odp')->nullable();
            $table->text('action')->nullable();
            $table->string('titik_koordinat')->nullable();
            $table->string('ratio')->nullable();
            $table->string('splitter')->nullable();
            $table->string('redaman_input')->nullable();
            $table->string('redaman_output')->nullable();
            $table->string('tehnisi_1');
            $table->string('tehnisi_2')->nullable();
            $table->string('tehnisi_3')->nullable();
            $table->string('tehnisi_4')->nullable();
            $table->string('tehnisi_5')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('foto_1')->nullable();
            $table->string('foto_2')->nullable();
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backbones');
    }
};
