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
        Schema::create('gedungs', function (Blueprint $table) {
            $table->id(); // ID gedung
            $table->string('name'); // Nama gedung
            $table->string('photo')->nullable(); // Kolom untuk menyimpan path foto gedung
            $table->string('lokasi'); // Lokasi (misalnya alamat atau koordinat)
            $table->foreignId('parent_id')->nullable()->constrained('gedungs')->onDelete('cascade'); // Relasi ke gedung induk
            $table->timestamps(); // Created at dan updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gedungs');
    }
};
