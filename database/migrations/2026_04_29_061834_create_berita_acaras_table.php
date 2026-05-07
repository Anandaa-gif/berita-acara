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
        Schema::create('berita_acaras', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->string('no_ktp');
            $table->string('email')->nullable();
            $table->string('no_hp');
            $table->text('alamat');
            $table->string('google_maps_link')->nullable();
            $table->date('tanggal_registrasi');
            $table->string('paket_berlangganan');
            $table->string('jenis_perangkat');
            $table->string('mac_address')->nullable();
            $table->string('serial_number')->nullable();
            $table->decimal('biaya_registrasi', 15, 2);
            $table->string('nama_teknisi_1');
            $table->string('nama_teknisi_2')->nullable();
            $table->string('foto_odp')->nullable();
            $table->string('foto_rumah')->nullable();
            $table->string('foto_pelanggan')->nullable();
            $table->longText('ttd_pelanggan')->nullable();
            $table->longText('ttd_petugas')->nullable();
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_acaras');
    }
};
