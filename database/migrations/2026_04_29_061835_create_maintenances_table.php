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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('jenis_kegiatan')->nullable();
            $table->string('nama_pel');
            $table->text('alamat_pel');
            $table->text('komplain');
            $table->text('action');
            $table->string('tehnisi_1');
            $table->string('tehnisi_2');
            $table->text('keterangan');
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
