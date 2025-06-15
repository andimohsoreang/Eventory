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
        Schema::table('gedungs', function (Blueprint $table) {
            $table->string('zone_id')->nullable()->after('photo');
            $table->string('gedung_id')->nullable()->after('zone_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gedungs', function (Blueprint $table) {
            $table->dropColumn(['zone_id', 'gedung_id']);
        });
    }
};
