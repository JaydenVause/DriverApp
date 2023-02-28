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
        Schema::create('location_data_driving_instructor', function($table){

            $table->id();

            $table->foreignId('instructor_id')->constrained('users')->onDelete('cascade');

            $table->foreignId('location_data_id')->constrained('location_data')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_data_driving_instructor');
    }
};
