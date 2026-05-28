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
        Schema::create('message_logs', function (Blueprint $table) {
            $table->id();
            $table->string('gateway'); // 'telegram', 'whatsapp'
            $table->string('target')->nullable(); // phone number or chat_id
            $table->text('message')->nullable();
            $table->string('status'); // 'success', 'failed'
            $table->text('response')->nullable(); // Error message or API response
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_logs');
    }
};
