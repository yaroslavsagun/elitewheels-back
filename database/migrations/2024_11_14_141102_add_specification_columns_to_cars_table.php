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
        Schema::table('cars', function (Blueprint $table) {
            $table->string('engine')->nullable();
            $table->float('time_to_100')->nullable();
            $table->integer('max_speed')->nullable();
            $table->integer('max_power')->nullable();
            $table->integer('power_per_liter')->nullable();
            $table->dropColumn('is_popular');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('engine');
            $table->dropColumn('time_to_100');
            $table->dropColumn('max_speed');
            $table->dropColumn('max_power');
            $table->dropColumn('power_per_liter');
            $table->boolean('is_popular')->default(false);
        });
    }
};
