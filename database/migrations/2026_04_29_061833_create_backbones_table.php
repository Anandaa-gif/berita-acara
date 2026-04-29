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
            $table->string('lokasi');
            $table->string('tiang_odp');
            $table->text('action');
            $table->string('titik_koordinat');
            $table->string('ratio');
            $table->string('splitter');
            $table->string('redaman_input');
            $table->string('redaman_output');
            $table->string('tehnisi_1');
            $table->string('tehnisi_2');
            $table->text('keterangan');
            $table->timestamps();
            $table->softDeletes();
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
