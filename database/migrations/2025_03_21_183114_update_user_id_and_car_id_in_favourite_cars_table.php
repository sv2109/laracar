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
        Schema::table('favourite_cars', function (Blueprint $table) {
            $table->dropForeign(['car_id']);
            $table->foreign('car_id')->references('id')->on('cars')
                ->cascadeOnDelete();

            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references('id')->on('users')
                ->cascadeOnDelete();
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('favourite_cars', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references('id')->on('users');

            $table->dropForeign(['car_id']);
            $table->foreign('car_id')->references('id')->on('cars');
        });
    }
};
