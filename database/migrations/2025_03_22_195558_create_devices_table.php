<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipe_id')->constrained()->onDelete('cascade'); // Relasi dengan tipe
            $table->string('device_id')->unique(); // ID unik untuk perangkat
            $table->foreignId('category_dana_id')
                ->references('id')
                ->on('category_dana')
                ->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade'); // Relasi dengan kategori dana
            $table->text('qr')->nullable(); // QR code perangkat
            $table->boolean('isActive')->default(true); // Status perangkat aktif
            $table->string('sticker');
            $table->string('foto_depan')->nullable();
            $table->string('foto_belakang')->nullable();
            $table->string('foto_terpasang')->nullable();
            $table->string('foto_serial')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
